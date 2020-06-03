<template>

   <div>
     <div class="container-fluid">
        <div class="tableFilters my-1">
            <div class="d-flex justify-content-between">
                <div class="control d-flex">
                    <div class="mr-3">
                        <select class="form-control" v-model="tableData.length" @change="getUbicaciones()">
                            <option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
                        </select>
                    </div>
                    <div class="w-auto">
                          <a class="btn btn-success" href="/ubicaciones/create">Crear Ubicacion</a>
                      </div>
                </div>

                <input class="input w-25 form-control" type="text" v-model="tableData.search" placeholder="Buscar en la tabla"
                    @input="getUbicaciones()">

            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr class="text-center" v-for="ubicacion in ubicaciones" :key="ubicacion.id">
                    <td>{{ubicacion.nombre}}</td>
                    <td>{{ubicacion.descripcion}}</td>
                    <td>{{ubicacion.locacion}}</td>
                    <td>{{ubicacion.empresa.nombre}}</td>
                    <td style="width: 10px">
                        <a class="btn btn-warning" :href="'/ubicaciones/'+ubicacion.id+'/edit'"><i class="far fa-edit"></i></a>
                    </td>
                    <td style="width: 10px">
                        <a class="btn btn-danger" :href="'/ubicaciones/'+ubicacion.id+'/edit'"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <div class="d-flex justify-content-end">
          <pagination :pagination="pagination"
                      @prev="getUbicaciones(pagination.prevPageUrl)"
                      @next="getUbicaciones(pagination.nextPageUrl)">
          </pagination>
        </div>
        </div>
    </div>


</template>

<script>

import Datatable from '../ColumUserdatabase.vue';
import Pagination from '../Pagination.vue';
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
        this.getUbicaciones();
    },
    data() {
        let sortOrders = {};
        let parametrostabla = {};
        let columns = [
            {label: 'Nombre', name: 'nombre' },
            {label: 'Descripcion', name: 'descripcion'},
            {label: 'Locacion', name: 'locacion'},
            {label: 'Empresa', name: 'empresa'},
            {label: 'Editar', name: 'editar'},
            {label: 'Eliminar', name: 'eliminar'}
        ];
        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            ubicaciones: [],
            columns: columns,
            sortKey: 'nombre',
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
        getUbicaciones(url = '/obtenerubicaciones') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    this.parametrostabla = data;
                    if (this.tableData.draw == data.draw) {
                        this.ubicaciones = data.data.data;
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
            this.getUbicaciones();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
    }
};
</script>