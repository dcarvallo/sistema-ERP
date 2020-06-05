<template>

   <div>
     <div>
        <div class="tableFilters my-1">
            <div class="d-flex justify-content-between">
                <div class="control d-flex">
                    <div class="mr-3">
                      <select class="form-control" v-model="tableData.length" @change="getUsuarios()">
                          <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                      </select>
                    </div>
                      <div class="w-auto mr-2">
                          <a class="btn btn-success" href="/users/create">
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
                
                <input class="input w-25 form-control" type="text" v-model="tableData.search" placeholder="Buscar"
                    @input="getUsuarios()">

            </div>

        <!-- <div class="px-0 offset-9 col-md-3" @mouseleave="expanded = false" >
          <div class="form-control d-flex justify-content-between" style="cursor:pointer"  @click="expanded = !expanded">
            <label style="cursor:pointer" > Filtrar columnas</label>
            <span><i class="fas fa-arrow-down"></i></span>
          </div>
          <div v-if="expanded" class="w-100 rounded position-absolute border-dark bg-white">
            <div class="form-control" v-for="(columnas, index) in columns" :key="index" style="cursor:pointer" >
            <label class="mb-0 w-100" style="cursor:pointer" >
             <input type="checkbox" :value="columnas.name" @click="filtro" v-model="checkbox" />
              {{columnas.label}}
            </label>
            </div>
          </div>
        </div> -->
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          
            <tbody>
                <tr v-for="(usuario) in usuarios" :key="usuario.id">
                    <td class="col-sm-4 py-2">{{usuario.name}}</td>
                    <td class="col-sm-3 py-2" >{{usuario.username}}</td>
                    <td class="col-sm-3 py-2" >{{usuario.email}}</td>
                    <td class="col-sm-1 py-2 text-center" v-if="usuario.activo">SI</td>
                    <td class="col-sm-1 py-2 text-center" v-else>NO</td>
                    <td class="py-2 text-center">
                      <!-- < form @submit.prevent>
                        <a class="btn btn-warning mx-2" @click="importardatousuario(usuario)">Importar de Dominio</a>
                      </form> -->
                        <a class="btn btn-info" :href="'/users/'+usuario.id"><i class="far fa-eye"></i></a>
                    </td>
                    <td>
                        <a class="btn btn-warning" :href="'/users/'+usuario.id+'/edit'"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                        <a class="btn btn-danger" :href="'/users/'+usuario.id+'/edit'"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <div class="d-flex justify-content-end">
          <pagination :pagination="pagination"
              @prev="getUsuarios(pagination.prevPageUrl)"
              @next="getUsuarios(pagination.nextPageUrl)">
          </pagination>
        </div>
        </div>

      <!-- Modal -->
      <div class="modal fade" id="modalexportar" tabindex="-1" role="dialog" aria-labelledby="modalexportar" aria-hidden="true">
        <div class="modal-dialog modal-sm"  role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalexportar">Exportar lista de usuarios:</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="col-md-6 offset-4">
                <form action="">
                  <div class="form-group"> 
                    <label>
                    <input type="checkbox" :value="exportar" v-model="exportar"> 
                    <span> PDF </span>  
                    </label>
                    </div>
                  <div class="form-group"> 
                    <label>
                      <input type="checkbox" :value="exportar" v-model="exportar"> 
                      <span> Excel</span> 
                    </label>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary">Generar</button>
            </div>
          </div>
        </div>
      </div>


    </div>

</template>

<script>

import Datatable from '../../ColumUserdatabase.vue';
import Pagination from '../../Pagination.vue';
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
        this.getUsuarios();
    },
    data() {
        let sortOrders = {};
        let parametrostabla = {};
        let columns = [
            {label: 'Nombre Completo', name: 'name' },
            {label: 'Nombre de usuario', name: 'username'},
            {label: 'Email', name: 'email'},
            {label: 'Activo', name: 'activo'},
            {label: 'Ver', name: 'ver'},
            {label: 'Editar', name: 'editar'},
            {label: 'Quitar', name: 'quitar'}
        ];
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            usuarios: [],
            exportar: [],
            checkbox: [
              'name',
              'username',
              'email',
              'activo',
              'acciones',
            ],
            expanded: false,
            columns: columns,
            sortKey: 'name',
            sortOrders: sortOrders,
            perPage: ['15', '30', '50'],
            tableData: {
                draw: 0,
                length: 15,
                search: '',
                column: 0,
                dir: 'asc',
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
        getUsuarios(url = '/obtenerusuarios') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    this.parametrostabla = data;
                    if (this.tableData.draw == data.draw) {
                        this.usuarios = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    toast.fire({
                        icon: 'error',
                        title: 'Error'
                    })
                });
        },
        filtro(){
          this.getUsuarios();
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
            this.getUsuarios();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

        importardatousuario(usuariosel){
            let par = this.parametrostabla;
          axios.put('/importardatousuario/'+usuariosel.id)
          .then(res => {
            this.getUsuarios('/obtenerusuarios');
            toast.fire({
                icon: 'success',
                title: 'Datos importados correctamente'
            })
          })
          .catch(err => {
              toast.fire({
                icon: 'error',
                title: 'Error'
            })
            location.reload();
          })
        }
    }
};
</script>