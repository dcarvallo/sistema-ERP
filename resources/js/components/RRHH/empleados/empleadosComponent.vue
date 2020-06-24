<template>

   <div>
     <div class="container-fluid">
          <div class="row justify-content-between">
            <div class=" d-flex align-items-center my-1">
                    <div class="mr-3">
                      <select class="form-control" v-model="tableData.length" @change="getEmpleados()">
                          <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                      </select>
                    </div>

                      <div v-if="can_crear" class="w-auto mr-1">
                          <a class="btn btn-success" href="/empleados/create">
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
                      @keyup.enter="getEmpleados()">
                  </div>
                  <div class="col pl-1">

                  <select class="form-control" v-model="tableData.searchColumn">
                      <option value="empleado_id" selected>Id Empleado</option>
                      <option value="nombres">Nombres</option>
                      <option value="apellidos">Apellidos</option>
                      <option value="ci">CI</option>
                      <option value="cargo">Cargo</option>
                      <option value="email">Email</option>
                      <option value="tipo_contrato">Tipo Contrato</option>
                      <option value="fecha_contrato">Fecha Contrato</option>
                  </select>
                  </div>
                </div>
               </fieldset>
          </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          
            <tbody>
                <tr v-for="(empleado) in empleados" :key="empleado.id">
                    <td style="width: 10%" >{{empleado.empleado_id}}</td>
                    <td style="width: 15%" >{{empleado.nombres}}</td>
                    <td style="width: 15%" >{{empleado.apellidos}}</td>
                    <td style="width: 10%" > {{empleado.ci}}</td>
                    <td style="width: 30%" > {{empleado.cargo.nombre}}</td>
                    <td style="width: 10%" > {{empleado.tipo_contrato}}</td>
                    <td style="width: 10%" > {{empleado.fecha_contrato}}</td>

                    <td class="text-center" v-if="can_ver" >
                        <a class="btn btn-primary text-white" :href="'/empleados/'+empleado.id"><i class="far fa-eye"></i></a>
                    </td>
                    <td class="text-center" v-if="can_editar" >
                        <a class="btn btn-warning" :href="'/empleados/'+empleado.id+'/edit'"><i class="far fa-edit"></i></a>
                    </td>
                    <td class="text-center" v-if="can_eliminar" >
                        <a class="btn btn-danger text-white" :id="empleado.id" @click="eliminarempleado(empleado.id)"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <div class="d-flex justify-content-end">
          <pagination :pagination="pagination"
              @prev="getEmpleados(pagination.prevPageUrl)"
              @next="getEmpleados(pagination.nextPageUrl)">
          </pagination>
        </div>
        

      <!-- Modal -->
      <div class="modal fade" id="modalexportar" tabindex="-1" role="dialog" aria-labelledby="modalexportar" aria-hidden="true">
        <div class="modal-dialog modal-sm"  role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalexportar">Exportar lista de empleados:</h5>
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
        this.getEmpleados();
    },
    props:['can_crear','can_ver', 'can_editar','can_eliminar'],
    data() {
        let sortOrders = {};
        let parametrostabla = {};
        let columns = [
            {label: 'ID Empleado', name: 'empleado_id' },
            {label: 'Nombres', name: 'nombres'},
            {label: 'Apellidos', name: 'apellidos'},
            {label: 'CI', name: 'ci'},            
            {label: 'Cargo', name: 'cargo'},           
            {label: 'Tipo de Contrato', name: 'tipo_contrato'},            
            {label: 'Fecha Contrato', name: 'fecha_contrato'},            
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
            empleados: [],
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
                searchColumn: 'empleado_id',
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
        getEmpleados(url = '/obtenerempleados') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    this.parametrostabla = data;
                    if (this.tableData.draw == data.draw) {
                        this.empleados = data.data.data;
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
        eliminarempleado(empleadoid) {
            
        modalconfirm.fire({
        title: '¿Está seguro que desea eliminar este empleado?',
        text: "El empleado ya no será visible en ninguna consulta, pero seguirá persistiendo en la base de datos como eliminado.",
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar',
        preConfirm: (login) => {
          return axios.delete('/empleados/'+empleadoid, {params: this.tableData})
                .then(response => {
                  let data = response.data;
                  this.getEmpleados();
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
          this.getEmpleados();
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
          this.getEmpleados();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

        importardatoempleado(empleadosel){
            let par = this.parametrostabla;
          axios.put('/importardatoempleado/'+empleadosel.id)
          .then(res => {
            this.getEmpleados('/obtenerempleados');
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