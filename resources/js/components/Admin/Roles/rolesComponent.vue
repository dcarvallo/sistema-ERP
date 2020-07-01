<template>

   <div>
        <div class="container-fluid">
          <div class="row justify-content-between">
            <div class=" d-flex align-items-center my-1">
              <div class="mr-3">
                <select class="form-control" v-model="tableData.length" @change="getroles()">
                    <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                </select>
              </div>
                <div v-if="can_crear" class="w-auto mr-1">
                  <a class="btn btn-success" :href="'/roles/create'">
                    <i class="far fa-plus-square"></i>
                    Crear
                  </a>
                </div>
                <div class="w-auto">
                  <a class="btn btn-primary" href="" data-toggle="modal" data-target="#modalexportar">
                    <i class=" fas fa-file-download"></i>
                    Exportar
                  </a>
                </div>
              </div>

            <fieldset class="border p-1">
              <legend class="w-auto my-0" ><span class="my-0 text-sm"> Buscar por</span></legend>
              <div class="row d-flex align-items-stretch">
                <div class="col pr-1">
                <input class="input form-control" autofocus type="text" v-model="tableData.search" placeholder="Escriba"
                    @keyup.enter="getroles()">
                </div>
                <div class="col pl-1">
                <select class="form-control" v-model="tableData.searchColumn">
                    <option value="name" selected> Nombre </option>
                    <option value="description">Descripcion</option>
                    <option value="category">Categoria</option>
                </select>
                </div>
              </div>
            </fieldset>
          </div>

        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="rol in roles" :key="rol.id">
                    <td style="width: 30%">{{rol.name}}</td>
                    <td style="width: 45%">{{rol.description}}</td>
                    <td style="width: 25%">{{rol.category}}</td>
                    <td v-if="can_ver" class=" text-center" >                        
                      <a class="btn btn-primary text-white" :href="'/roles/'+rol.id"><i class=" far fa-eye"></i></a>
                    </td>
                    <td v-if="can_editar" class="text-center" >
                      <a class="btn btn-warning" :href="'/roles/'+rol.id+'/edit'"><i class="far fa-edit"></i></a>
                    </td>
                    <td v-if="can_eliminar" class="text-center" >
                      <a class="btn text-white btn-danger" @click="eliminarrol(rol.id)"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <div class="d-flex justify-content-end">
          <pagination :pagination="pagination"
                      @prev="getroles(pagination.prevPageUrl)"
                      @next="getroles(pagination.nextPageUrl)">
          </pagination>
        </div>
        </div>



</template>

<script>

import Datatable from '../../ColumUserdatabase.vue';
import Pagination from '../../Pagination.vue';
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
      this.getroles();
    },
    props:['can_crear','can_ver', 'can_editar','can_eliminar'],
    data() {
      let sortOrders = {};
      let parametrostabla = {};
      let columns = [
          {label: 'Nombre', name: 'name' },
          {label: 'Descripcion', name: 'description'},
          {label: 'Categoria', name: 'category'}
      ];
      var columnasPrincipales = columns.length - 1 ;
      columns.forEach((column) => {
          sortOrders[column.name] = -1;
      });
      if(this.can_ver){
        columns.push({label: 'Ver', name: 'ver'});
      }
      if(this.can_editar){
        columns.push({label: 'Editar', name: 'editar'});
      }
      if(this.can_eliminar){
        columns.push({label: 'Eliminar', name: 'eliminar'});
      }
      return {
        roles: [],
        columns: columns,
        columnasPrincipales:columnasPrincipales,
        sortKey: 'name',
        sortOrders: sortOrders,
        perPage: ['15', '30', '50'],
        tableData: {
            draw: 0,
            length: 15,
            search: '',
            column: 0,
            dir: 'asc',
            searchColumn:'name',
        },
        pagination: {
            lastPage: '',
            currentPage: '',
            total: '',
            lastPageUrl: '',
            nextPageUrl: '',
            prevPageUrl: '',
            from: '',
            to: ''
        },
      }
    },
    methods: {
      getroles(url = '/obtenerroles') {
        this.tableData.draw++;
        axios.get(url, {params: this.tableData})
        .then(response => {
          let data = response.data;
          this.parametrostabla = data;
          if (this.tableData.draw == data.draw) {
            this.roles = data.data.data;
            this.configPagination(data.data);
          }
        })
        .catch(errors => {
          console.log(errors);
        });
      },
      eliminarrol(rolid) {
            
        modalconfirm.fire({
        title: '¿Está seguro que desea quitar este rol?',
        text: "El registro ya no se utilizará en ninguna consulta, pero seguirá persistiendo en la base de datos como eliminado.",
        confirmButtonText: 'Si, quitar',
        cancelButtonText: 'Cancelar',
        preConfirm: (login) => {
          return axios.delete('/roles/'+rolid, {params: this.tableData})
            .then(response => {
              let data = response.data;
              this.getroles();
              toastsuccess.fire({
                title: data.title+' '+data.message
              })
            })
            .catch(errors => {
                console.log(errors);
            });
          },
          allowOutsideClick: () => !swal.isLoading()
          }).then((result) => {
            if (result.value) {
              swal.fire(
                'Quitado!',
                'Se ha quitado el rol.',
                'success'
              )
            }
          })
        },
        configPagination(data) {
          this.pagination.lastPage = data.last_page;
          this.pagination.currentPage = data.current_page;
          this.pagination.total = data.total;
          this.pagination.lastPageUrl = data.last_page_url;
          this.pagination.nextPageUrl = data.next_page_url;
          this.pagination.prevPageUrl = data.prev_page_url;
          this.pagination.from = data.from;
          this.pagination.to = data.to;
        },
        sortBy(key) {
          this.sortKey = key;
          this.sortOrders[key] = this.sortOrders[key] * -1;
          this.tableData.column = this.getIndex(this.columns, 'name', key);
          this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
          if(this.tableData.column <= this.columnasPrincipales)
          this.getroles();
        },
        getIndex(array, key, value) {
          return array.findIndex(i => i[key] == value)
        },

    }
};

</script>