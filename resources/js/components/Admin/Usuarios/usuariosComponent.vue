<template>

   <div>
        <div class="container-fluid">
          <div class="row justify-content-between">
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
          </div>

        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          
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
                        <a class="btn btn-sm btn-primary text-white" :href="'/users/'+usuario.id"><i class="far fa-eye"></i></a>
                    </td>
                    <td class="text-center" v-if="can_editar" >
                        <a class="btn btn-sm btn-warning" :href="'/users/'+usuario.id+'/edit'"><i class="far fa-edit"></i></a>
                    </td>
                    <td class="text-center" v-if="can_eliminar" >
                        <a class="btn btn-sm btn-danger text-white" :id="usuario.id" @click="eliminarusuario(usuario.id)"><i class="far fa-trash-alt"></i></a>
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
              <form action="/exportar-usuarios" method="get">
                <input type="hidden" name="_token" :value="csrf">
                    <div class="form-group d-flex justify-content-around"> 
                      <select class="form-control" name="exportar" v-model="exportar">
                        <option value="excel" selected>Excel </option>
                        <option value="pdf">PDF</option>
                      </select>
                    </div>
                    <hr>
                    <div class="form-group d-flex flex-column"> 
                      <label>
                        <input type="radio" checked name="exportarpagina" v-model="exportarpagina" value="actual" > 
                        <span> Página actual </span>
                      </label>
                      <label v-if="exportar != 'pdf'">
                        <input type="radio" name="exportarpagina" v-model="exportarpagina" value="todo"> 
                        <span> Todos los registros</span>
                      </label>
                    </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" @submit.prevent="generar">Generar</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
</template>

<script>

import Datatable from '../../ColumUserdatabase.vue';
import Pagination from '../../Pagination.vue';
  var csrf_token = $('meta[name="csrf-token"]').attr('content');
export default {
    components: { 
      datatable: Datatable, pagination: Pagination, 
    },
    created() {
        this.getUsuarios();
    },
    props:['can_crear','can_ver', 'can_editar','can_eliminar'],
    data() {
        let sortOrders = {};
        let parametrostabla = {};
        let columns = [
            {label: 'Nombre Completo', name: 'name' },
            {label: 'Nombre de usuario', name: 'username'},
            {label: 'Email', name: 'email'},
            {label: 'Activo', name: 'activo'},            
        ];
        const columnasPrincipales = columns.length - 1 ;
          columns.forEach((column) => {
             sortOrders[column.name] = -1;
          });
          columns.push({label: 'Rol', name: 'rol'});
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
            csrf: document.querySelector('meta[name="csrf_token"]').getAttribute('content'),
            usuarios: [],
            exportar: 'excel',
            seleccion: 'excel',
            exportarpagina: 'actual',
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
        eliminarusuario(usuarioid) {
            
        modalconfirm.fire({
        title: '¿Está seguro que desea eliminar este usuario?',
        text: "El usuario ya no será visible en ninguna consulta, pero seguirá persistiendo en la base de datos como eliminado.",
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar',
        preConfirm: (login) => {
          return axios.delete('/users/'+usuarioid, {params: this.tableData})
                .then(response => {
                  let data = response.data;
                  this.getUsuarios();
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
        exportardatos(){
          let formData = new FormData();
          if(this.exportar != '')
          {
            formData.append('exportar', this.exportar);
            formData.append('exportarpagina', this.exportarpagina);
            formData.append('tabledata', this.tableData.length);
            formData.append('pagination', this.pagination);
            axios.post('exportar-usuarios', formData)
            .then(res => {
              this.getUsuarios('/obtenerusuarios');
              toast.fire({
                  icon: 'success',
                  title: 'Información exportada correctamente'
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
          if(this.tableData.column <= this.columnasPrincipales)
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