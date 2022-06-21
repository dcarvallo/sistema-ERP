<template>

   <div>
        <div class="container-fluid">
          <!-- <div class="row justify-content-between">
            <div class="d-flex align-items-center my-1">
              <div class="mr-3">
                <select class="form-control" v-model="tableData.length" @change="getUsuarios()">
                  <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                </select>
              </div>
                <div v-if="can_crear" class="w-auto mr-1">
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
            <fieldset class="border p-1">
              <legend class="w-auto my-0" ><span class="my-0 text-sm"> Buscar por</span></legend>
              <div class="row d-flex align-items-stretch">
                <div class="col pr-1">
                <input class="input form-control" autofocus type="text" v-model="tableData.search" placeholder="Buscar"
                    @keyup.enter="getUsuarios()">
                </div>
                <div class="col pl-1">
                  <select class="form-control" v-model="tableData.searchColumn">
                      <option value="name">Nombre Completo</option>
                      <option value="username">Nombre de usuario</option>
                      <option value="email">Email</option>
                  </select>
                </div>
              </div>
            </fieldset>
          </div> -->

        </div>
        <!-- <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          
            <tbody>
                <tr v-for="(usuario) in usuarios" :key="usuario.id">
                    <td style="width: 30%" >{{usuario.name}}</td>
                    <td style="width: 20%" >{{usuario.username}}</td>
                    <td style="width: 20%" >{{usuario.email}}</td>
                    <td style="width: 10%"  class="text-center" v-if="usuario.activo">SI</td>
                    <td style="width: 10%" class="text-center bg-info" v-else>NO</td>
                    <td v-if="usuario.roles" style="width: 20%" >
                        <ul>
                          <li v-for="(roles, index) in usuario.roles" :key="index" >
                              {{roles.name}}
                          </li>
                        </ul>
                    </td>
                    <td v-else> - </td>
                    <td style="width: 10%" class="text-center" v-if="can_ver" >
                        <a class="btn btn-primary text-white" :href="'/users/'+usuario.id"><i class="far fa-eye"></i></a>
                    </td>
                    <td class="text-center" v-if="can_editar" >
                        <a class="btn btn-warning" :href="'/users/'+usuario.id+'/edit'"><i class="far fa-edit"></i></a>
                    </td>
                    <td class="text-center" v-if="can_eliminar" >
                        <a class="btn btn-danger text-white" :id="usuario.id" @click="eliminarusuario(usuario.id)"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        
        <div class="d-flex justify-content-end">
          <pagination :pagination="pagination"
              @prev="getUsuarios(pagination.prevPageUrl)"
              @next="getUsuarios(pagination.nextPageUrl)">
          </pagination>
        </div> -->

      <div id="toolbar">
          <a class="btn btn-success" href="/users/create"> <i class="far fa-plus-square"></i> Crear</a>
      </div>
      <bootstrap-table :options="myOptions" :data="usuarios" :columns="myColumns"/>

  


      <!-- Modal -->
      <!-- <div class="modal fade" id="modalexportar" tabindex="-1" role="dialog" aria-labelledby="modalexportar" aria-hidden="true">
        <div class="modal-dialog modal-sm"  role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalexportar">Exportar lista de usuarios:</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="">
                    <div class="form-group d-flex justify-content-around"> 
                      <label>
                        <input type="checkbox" value="pdf" v-model="exportar"> 
                        <span> PDF <i class="far fa-2x fa-file-pdf"></i> </span>  
                      </label>
                      <label>
                        <input type="checkbox" value="excel" v-model="exportar"> 
                        <span> Excel <i class="far fa-2x fa-file-excel"></i></span> 
                      </label>
                      </div>
                      <hr>
                    <div class="form-group d-flex flex-column"> 
                      <label>
                        <input type="radio" value="actual" v-model="exportarpagina"> 
                        <span> Pagina actual </span>
                      </label>
                      <label>
                        <input type="radio" value="todo" v-model="exportarpagina"> 
                        <span> Todos los registros</span>
                      </label>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" @click.prevent="exportardatos">Generar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div> -->
    </div>

</template>

<script>

// import Datatable from '../../ColumUserdatabase.vue';
// import Pagination from '../../Pagination.vue';
import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js';
export default {
    components: { 
      // datatable: Datatable, pagination: Pagination, 
      'bootstrap-table': BootstrapTable 
    },
    created() {
        this.getUsuarios();
        console.log(BootstrapTable.params);
        // this.usuarios = this.losusuarios;
    },
    props:['can_crear','can_ver', 'can_editar','can_eliminar'],
    data() {
      const ver = this.can_ver;
      const editar = this.can_editar;
      const eliminar = this.can_eliminar;
        let sortOrders = {};
        let parametrostabla = {};

        return {
            usuarios: [],
            myOptions: {
              search: false,
              pagination: true,
              sidePagination: 'server',
              showColumns: true,
              showPrint: true,
              showExport: true,
              filterControl: true,
              toolbar: '#toolbar',
            },
            myColumns: [
              {field:'name', title: 'Nombre Completo', sortable: true, filterControl: 'input'},
              {field:'username', title: 'Nombre de Usuario', sortable: true, filterControl: 'input'},
              {field:'email', title: 'Email', sortable: true, filterControl: 'input'},
              {
                field: 'activo',
                title: 'Activo',
                align: 'center',
                width: '15px',
                filterControl: 'select',
                formatter: function(e, value, row){
                  return e ? 'Si':'No'   
                },
              },
              {
                field: 'roles',
                title: 'Rol',
                sortable: true,
                align: 'center',
                filterControl: 'input',
                formatter: function(e, value, row){
                 let lista = [];
                 e.forEach(element => {
                    lista.push(element.name);
                 });
                 return lista;
                },
              },
              {
                field: 'action',
                title: 'Acciones',
                align: 'center',
                width: '140px',
                formatter: function(e, value, row){
                  var botones = '';
                  if(ver){
                    botones += '<button class="btn btn-sm btn-primary mr-1 show"><i class="fas fa-eye"></i></button>';
                  }
                  if(editar){
                    botones += '<button class="btn btn-sm btn-warning mr-1 edit"><i class="fas fa-edit"></i></button>';
                  }
                  if(eliminar){
                    botones += '<button class="btn btn-sm btn-danger mr-1 destroy"><i class="fas fa-trash"></i></button>';
                  }
                  return botones;
                },
                events: {
                  'click .show': function(e, value, row){
                      return window.location.assign('users/'+row.id);
                  },
                  'click .edit': function(e, value, row){
                      return window.location.assign('users/'+row.id+'/edit');
                  },
                  'click .destroy': function(e, value, row){
                    modalconfirm.fire({
                    title: '¿Está seguro que desea eliminar este usuario?',
                    text: "El usuario ya no será visible en ninguna consulta, pero seguirá persistiendo en la base de datos como eliminado.",
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: 'Cancelar',
                    preConfirm: (login) => {
                      return axios.delete('/users/'+row.id)
                            .then(response => {
                              let data = response.data;
                              // this.getUsuarios();
                              bootstrapTable('refresh');
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
                  }
                }
              }
            ],
            sortKey: 'name',
            sortOrders: sortOrders,
            perPage: ['15', '30', '50'],
            tableData: {
                draw: 0,
                length: 15,
                search: '',
                column: 0,
                dir: 'asc',
                searchColumn: 'name',
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
            axios.get(url)
                .then(response => {
                  let data = response.data;
                  // console.log(response.data.data);
                      this.usuarios = data.data;
                    
                })
                .catch(errors => {
                    toast.fire({
                        icon: 'error',
                        title: 'Error'
                    })
                });
        },
    }
};
</script>