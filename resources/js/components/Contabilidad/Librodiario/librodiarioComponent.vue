<template>

   <div>
     <div class="container-fluid">
          <div class="row justify-content-between">
            <div class=" d-flex align-items-center my-1">
                    <div class="mr-3">
                      <select class="form-control" v-model="tableData.length" @change="getLibrodiario()">
                          <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                      </select>
                    </div>

                      <div v-if="can_crear" class="w-auto mr-1">
                          <a class="btn btn-success" href="/librodiarios/create">
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

                  <input class="form-control" autofocus type="text" v-model="tableData.search" placeholder="Buscar"
                      @keyup.enter="getLibrodiario()">
                  </div>
                  <div class="col pl-1">

                  <select class="form-control" v-model="tableData.searchColumn">
                      <option value="nro_asiento">Nro Asiento</option>
                      <option value="fecha">Fecha</option>
                      <option value="tipo_asiento">Tipo Asiento</option>
                      <option value="notas">Notas</option>
                  </select>
                  </div>
                </div>
               </fieldset>
          </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          
            <tbody>
                <tr v-for="(librodiario) in librodiarios" :key="librodiario.id">
                    <td style="width: 15%" >{{librodiario.nro_asiento}}</td>
                    <td style="width: 15%" >{{librodiario.fecha}}</td>
                    <td style="width: 30%" > {{librodiario.tipo_asiento}}</td>
                    <td style="width: 40%" > {{librodiario.notas}}</td>

                    <td class="text-center" v-if="can_ver" >
                        <a class="btn btn-primary text-white" :href="'/librodiarios/'+librodiario.id"><i class="far fa-eye"></i></a>
                    </td>
                    <td class="text-center" v-if="can_editar" >
                        <a class="btn btn-warning" :href="'/librodiarios/'+librodiario.id+'/edit'"><i class="far fa-edit"></i></a>
                    </td>
                    <td class="text-center" v-if="can_eliminar" >
                        <a class="btn btn-danger text-white" :id="librodiario.id" @click="eliminarlibrodiario(librodiario.id)"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <div class="d-flex justify-content-end">
          <pagination :pagination="pagination"
              @prev="getLibrodiario(pagination.prevPageUrl)"
              @next="getLibrodiario(pagination.nextPageUrl)">
          </pagination>
        </div>
        

      <!-- Modal -->
      <div class="modal fade" id="modalexportar" tabindex="-1" role="dialog" aria-labelledby="modalexportar" aria-hidden="true">
        <div class="modal-dialog modal-sm"  role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalexportar">Exportar lista de librodiarios:</h5>
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
                    <i class="far fa-2x fa-file-pdf"></i>
                    </label>
                    </div>
                  <div class="form-group"> 
                    <label>
                      <input type="checkbox" :value="exportar" v-model="exportar"> 
                      <span> Excel</span> 
                      <i class="far fa-2x fa-file-excel"></i>
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
        this.getLibrodiario();
    },
    props:['can_crear','can_ver', 'can_editar','can_eliminar'],
    data() {
        let sortOrders = {};
        let parametrostabla = {};
        let columns = [
            {label: 'Nro Asiento', name: 'nro_asiento'},
            {label: 'Fecha', name: 'fecha'},
            {label: 'Tipo Asiento', name: 'tipo_asiento'},            
            {label: 'Notas', name: 'notas'},
        ];
        const columnasPrincipales = columns.length - 1 ;
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
            librodiarios: [],
            exportar: [],
            expanded: false,
            columns: columns,
            columnasPrincipales:columnasPrincipales,
            sortKey: '',
            sortOrders: sortOrders,
            perPage: ['15', '30', '50'],
            tableData: {
                draw: 0,
                length: 15,
                search: '',
                column: 0,
                dir: 'asc',
                searchColumn: 'codigo_cta',
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
        getLibrodiario(url = '/obtenerlibrodiarios') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    this.parametrostabla = data;
                    if (this.tableData.draw == data.draw) {
                        this.librodiarios = data.data.data;
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
        eliminarlibrodiario(librodiarioid) {
            
        modalconfirm.fire({
        title: '¿Está seguro que desea eliminar este librodiario?',
        text: "El librodiario ya no será visible en ninguna consulta, pero seguirá persistiendo en la base de datos como eliminado.",
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar',
        preConfirm: (login) => {
          return axios.delete('/librodiarios/'+librodiarioid, {params: this.tableData})
                .then(response => {
                  let data = response.data;
                  this.getLibrodiario();
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
        filtro(){
          this.getLibrodiario();
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
          this.getLibrodiario();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

        importardatolibrodiario(librodiariosel){
            let par = this.parametrostabla;
          axios.put('/importardatolibrodiario/'+librodiariosel.id)
          .then(res => {
            this.getLibrodiario('/obtenerlibrodiarios');
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