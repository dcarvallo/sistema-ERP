<template>
  <div>
    
  

  </div>
</template>

<script>
 export default {
    el:'#otro',
    data() {
      return {
        // Our data object that holds the Laravel paginator data
        laravelData: {},
      }
    },

    created(){
      axios.get('/usuarios').then(res=>{
        this.notas = res.data;
      })
    },

    methods: {
      
    }

}
</script>