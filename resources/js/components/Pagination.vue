

<template>
    <nav class="pagination" v-if="!client">
        <span class="page-stats">Página {{pagination.from}} - {{pagination.to}} de {{pagination.total}}</span>
        <a v-if="pagination.prevPageUrl" class="btn btn-sm text-white btn-primary mx-1 pagination-previous" @click="$emit('prev');">
          Atras
        </a>
        <a class="btn btn-sm btn-primary text-white mx-1 pagination-previous" v-else :disabled="true">
           Atras
        </a>

        <a v-if="pagination.nextPageUrl" class="btn btn-sm text-white btn-primary pagination-next" @click="$emit('next');">
            Siguiente
        </a>
        <a class="btn btn-sm btn-primary text-white pagination-next" v-else :disabled="true">
            Siguiente
        </a>
    </nav>

    <nav class="pagination" v-else>
      <a v-if="pagination.prevPage" class="btn btn-sm mx-1 btn-primary pagination-previous" @click="$emit('prev');">
            Atras
        </a>
        <a class="btn btn-sm btn-primary mx-1 pagination-previous" v-else :disabled="true">
           Atras
        </a>
        
        <span class="page-stats">
            {{pagination.from}} - {{pagination.to}} de {{filtered.length}}
            <span v-if="filtered.length < pagination.total">
              (Filtrado de {{pagination.total}} total de entradas)
            </span>
        </span>
        

        <a v-if="pagination.nextPage" class="btn btn-sm btn-info pagination-next" @click="$emit('next');">
            Siguiente
        </a>
        <a class="btn btn-sm btn-info pagination-next" v-else :disabled="true">
            Siguiente
        </a>
    </nav>
</template>

<script>
    export default {
        props: ['pagination', 'client', 'filtered']
    }
</script>