
<template>
<div>
    <table class="table table-bordered table-responsive-sm table-striped my-2">
        <thead class="table-dark">
            <tr style="cursor:pointer"  class="text-center">
                <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)">
                    {{column.label}}
                    
                    <label class=" mb-0" v-if="sortKey === column.name && sortOrders[column.name]">
                      <i v-if="sortOrders[column.name] == 1" style="cursor:pointer" class="fas fa-arrow-up"></i>
                      <i v-if="sortOrders[column.name] == -1" style="cursor:pointer" class="fas fa-arrow-down"></i>
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
    }
    
</script>
<style>
  table.table-bordered > tbody > tr > td{
    border:1px solid rgb(153, 153, 153);
  }
  table.table-bordered > thead > tr > th{
    border:1px solid rgb(177, 177, 177);
  }
</style>