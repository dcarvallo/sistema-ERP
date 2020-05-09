<template>

   <div class="usuarios content-wrapper">
     <div class="container-fluid">
        <div class="tableFilters my-1">
            <div class="d-flex justify-content-between">
                <div class="control">
                    <div>
                        <select class="form-control" v-model="tableData.length" @change="getUsuarios()">
                            <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                        </select>
                    </div>
                </div>

                <input class="input w-25 form-control" type="text" v-model="tableData.search" placeholder="Buscar en la tabla"
                    @input="getUsuarios()">

            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="usuario in usuarios" :key="usuario.id">
                    <td>{{usuario.name}}</td>
                    <td>{{usuario.username}}</td>
                    <td>{{usuario.email}}</td>
                    <td v-if="usuario.activo">SI</td>
                    <td v-else>NO</td>
                    <td class="d-flex">
                      <form @submit.prevent>
                        <a class="btn btn-warning mx-2" @click="importardatousuario(usuario)">Importar de Dominio</a>
                      </form>
                        <a class="btn btn-danger" :href="'usuarios/'+usuario.id+'/edit'">Editar</a>
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
    </div>


</template>

<script>

import Datatable from './ColumUserdatabase.vue';
import Pagination from './Pagination.vue';
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
        
        this.getUsuarios();
    },
    data() {
        let sortOrders = {};
        let parametrostabla = {};
        let columns = [
            {label: 'Nombre', name: 'name' },
            {label: 'Nombre de usuario', name: 'username'},
            {label: 'Email', name: 'email'},
            {label: 'Activo', name: 'activo'},
            {label: 'Acciones', name: 'acciones'}
        ];
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            usuarios: [],
            columns: columns,
            sortKey: 'name',
            sortOrders: sortOrders,
            perPage: ['10', '20', '50'],
            tableData: {
                draw: 0,
                length: 10,
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
                    console.log(errors);
                });
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
          axios.put('importardatousuario/'+usuariosel.id)
          .then(res => {
            this.getUsuarios('/obtenerusuarios');
            toast.fire({
                icon: 'success',
                title: 'Datos importados correctamente'
            })
          })
          .catch(err => {
            location.reload();
          })
        }
    }
};
</script>