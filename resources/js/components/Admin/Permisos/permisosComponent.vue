<template>

   <div class="roles">
     <div class="container-fluid">
        <div class="tableFilters my-1">
            <div class="d-flex justify-content-between">
                <div class="control d-flex">
                    <div class="mr-3">
                      <select class="form-control" v-model="tableData.length" @change="getpermisos()">
                          <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                      </select>
                    </div>
                      <!-- <div class="w-auto">
                          <a class="btn btn-success" :href="'/permisos/create'">
                            <i class="far fa-plus-square"></i>
                            Crear
                          </a>
                      </div> -->
                  </div>

                <input class="input w-25 form-control" type="text" v-model="tableData.search" placeholder="Buscar en la tabla"
                    @input="getpermisos()">

            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody class="text-center">
                <tr v-for="permiso in permisos" :key="permiso.id">
                    <td class="col-2">{{permiso.category}}</td>
                    <td class="col-2">{{permiso.name}}</td>
                    <td class="col-8">{{permiso.description}}</td>
                    <td class="text-white">                        
                      <a class="btn btn-primary text-white" :href="'/permisos/'+permiso.id"><i class=" far fa-eye"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <div class="d-flex justify-content-end">
          <pagination :pagination="pagination"
                      @prev="getpermisos(pagination.prevPageUrl)"
                      @next="getpermisos(pagination.nextPageUrl)">
          </pagination>
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
        this.getpermisos();
    },
    data() {
        let sortOrders = {};
        let parametrostabla = {};
        let columns = [
            {label: 'Categoria', name: 'category'},
            {label: 'Nombre', name: 'name' },
            {label: 'Descripcion', name: 'description'},
            {label: 'Ver', name: 'ver'}
        ];
        var columnasPrincipales = columns.length - 1 ;
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            permisos: [],
            columns: columns,
            columnasPrincipales:columnasPrincipales,
            sortKey: 'category',
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
        getpermisos(url = '/obtenerpermisos') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    this.parametrostabla = data;
                    if (this.tableData.draw == data.draw) {
                        this.permisos = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        // eliminarpermiso(permisosid) {
        //     this.tableData.draw++;
        //     axios.delete('/permisos/'+permisoid, {params: this.tableData})
        //         .then(response => {
        //             let data = response.data;
        //             this.parametrostabla = data;
        //             if (this.tableData.draw == data.draw) {
        //                 this.permisos = data.data.data;
        //                 this.configPagination(data.data);
        //             }
        //         })
        //         .catch(errors => {
        //             console.log(errors);
        //         });
        // },
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
            this.getpermisos();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

    }
};
</script>