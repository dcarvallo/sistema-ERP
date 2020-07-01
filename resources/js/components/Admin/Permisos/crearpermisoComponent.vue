<template>
<div class="container-fluid">

  <form  @keydown.enter.prevent>

      <div class="card">
        <div class="card-header">
            <h5><strong> Permiso </strong></h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nombre*</label>
                <input class="form-control" type="text" v-model="permiso.name" autofocus>
                <label class="alert-danger" v-if="errors.name" >{{errors.name[0]}}</label>
            </div>
            <div class="form-group">
                <label>Descripcion*</label>
                <textarea class="form-control" type="text" v-model="permiso.description"></textarea>
                <label class="alert-danger" v-if="errors.description" >{{errors.description[0]}}</label>
            </div>

            <div class="form-group">
                <label>Categoria*</label>
                 <input class="form-control" type="text" v-model="permiso.category">
                <label class="alert-danger" v-if="errors.category" >{{errors.category[0]}}</label>
            </div>
            
          </div>
        
    </div>
      
    
    <div class="text-right">
      <button type="submit" class="btn btn-primary" @click.prevent="crearpermiso">Guardar</button>
    </div>
  </form>
    
</div>
</template>

<script>

export default {
  props: ['permisos'],
  data(){
    return{
      permiso: {
        name: '',
        description: '',
        category: '',
      },
      errors: [],
    }
  },
  created(){
    
  },
  methods:{
    crearpermiso()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('name', this.permiso.name);
      formData.append('description', this.permiso.description);
      formData.append('category', this.permiso.category);
      axios.post('/permisos/store',formData)
      .then(res => {
        let datos = res.data;
        this.permiso.name = '';
        this.permiso.description = '';
        this.permiso.category = '';
        toastsuccess.fire({
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.data;
        console.log(error.response);
        if(error.response.status == 422){
            this.errors = error.response.data.errors;
            toasterror.fire({
            title: 'Error en formulario, revise'
          })
          }
          if(datos){

            toasterror.fire({
              title: datos[1].title+' '+datos[1].message
          })
          }
      })
    }
  }
}
</script>