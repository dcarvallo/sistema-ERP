
<template>
<div>

    <table class="table table-bordered table-responsive-sm table-striped my-2">
        <thead class="table-dark">
            <tr style="cursor:pointer"  class="text-center">
                <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'">
                    {{column.label}}
                    
                    <label class=" mb-0" v-if="sortKey === column.name">
                      <i style="cursor:pointer"  v-if="sortOrders[column.name] > 0" class="fas fa-arrow-up"></i>
                      <i style="cursor:pointer"  v-else class="fas fa-arrow-down"></i>
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
