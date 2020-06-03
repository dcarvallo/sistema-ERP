
<template>
<div>

    <table class="table table-bordered table-responsive-sm  data-table my-2">
        <thead class="table-dark">
            <tr style="cursor:pointer"  class="text-center">
                <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'">
                    {{column.label}}
                    <label class=" mb-0" v-if="sortKey === column.name ">
                      <i v-if="sortOrders[column.name] > 0" class="fas fa-arrow-up"></i>
                      <i v-else class="fas fa-arrow-down"></i>
                    </label>
                </th> 
            </tr>
        </thead>
        <slot></slot>
    </table>
</div>
</template>

<script>
    export default {
      props: ['columns', 'sortKey', 'sortOrders'],
      data() {
        return {
          data3:[]
        }
      },
      // created() {
      //   let checkboxfil = this.checkboxfil;
      //   this.columns.forEach(function(datos){
      //     if(checkboxfil.includes(datos.name))
      //     {
      //       data3.push(datos);
      //     }
      //   });
       
      //   // console.log(data3);
      // },

    }
    
</script>
