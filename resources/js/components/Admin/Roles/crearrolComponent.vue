<template>
<div class="container-fluid">

  <form enctype="multipart/form-data">

    
      <div class="card">
        <div class="card-header">
            <h5><strong> Rol </strong></h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nombre*</label>
                <input class="form-control" type="text" v-model="rol.name">
            </div>
            <div class="form-group">
                <label>Slug (abreviacion)*</label>
                <input class="form-control" type="text" v-model="rol.slug">
            </div>
            <div class="form-group">
                <label>Descripcion*</label>
                <input class="form-control" type="text" v-model="rol.description">
            </div>
            
          </div>
        

    </div>

    <div class="card">
      <div class="card-header">
          <h5>Permisos Eseciales</h5>
      </div>
      <div class="card-body">
        <div class="form-group">
                <label>
                  <input type="checkbox" :value="'all-access'" v-model="rol.special">
                  <span>Acceso Total</span>
                </label>
                <br>
                <label>
                  <input type="checkbox" :value="'no-access'" v-model="rol.special">
                  <span>Ningun Acceso</span>
                </label>
            </div>
      </div>
    </div>


      <div class="card">
        <div class="card-header">
          <h5>Permisos</h5>
        </div>
        <div class="card-body">
          <div class="row">

            

            <div class="col-md-2 my-2" v-for="(categoria,index) in permisos" :key="categoria.id" data-toggle="collapse" :data-target="'#'+index" :style="{cursor: 'pointer'}">
              <i class="far fa-plus-square"></i>
              {{index}}
              

              <li style="list-style:none" v-for="(elemento) in categoria" :key="elemento.id" :id="index" class="collapse">
                <label :style="{cursor: 'pointer'}">
                  <input type="checkbox" :id="elemento.id" :value="elemento.slug" v-model="permiso.slug">
                  <span>{{elemento.name}}</span>
                </label>
              </li>
            </div>



            <!-- <div class="col-md-2 my-2" v-for="(categoria,index) in permisos" :key="categoria.id" data-toggle="collapse" :data-target="'#'+index"  :style="{cursor: 'pointer'}">
              <i class="far fa-plus-square"></i>
              {{index}}
            </div>
              
              <div v-for="(categoria,index) in permisos" :key="categoria.id" :style="{cursor: 'pointer'}">
              
              
              <li style="list-style:none" v-for="(elemento) in categoria" :key="elemento.id" :id="index" class="collapse">
                <label :style="{cursor: 'pointer'}">
                  <input type="checkbox" :id="elemento.id" :value="elemento.slug" v-model="permiso.slug">
                  <span>{{elemento.name}}</span>
                </label>
              </li>
              </div> -->


          </div>
              
        </div>
      </div>
    
    <div class="text-right">
      <button type="submit" class="btn btn-primary" @click.prevent="crearrol">Guardar</button>
    </div>
  </form>
    
</div>
</template>

<script>

export default {
  props: ['permisos'],
  data(){
    return{
      rol: {
        name: '',
        slug: '',
        description: '',
        special: [],
      },
      permiso: {
        slug: [],
      },
      categorias: Object.values(this.permisos),
      errors: [],
    }
  },
  created(){
    console.log(Object.keys(this.permisos));
  },
  methods:{
    crearrol()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('name', this.rol.name);
      formData.append('slug', this.rol.slug);
      formData.append('description', this.rol.description);
      formData.append('special', this.rol.special);
      formData.append('permisos', this.permiso.slug);
      console.log(formData);
      axios.post('/roles/store',formData)
      .then(res => {
        let datos = res.data;
        this.rol = [];
        toast.fire({
          icon: datos[1].type,
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.data;
        if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
          toast.fire({
            icon: datos[1].type,
            title: datos[1].title+' '+datos[1].message
          })
      })
    }
  }
}
</script>

<style>
  /* @import "../node_modules/@syncfusion/ej2-base/styles/material.css";
  @import "../node_modules/@syncfusion/ej2-vue-navigations/styles/material.css";
  @import "../node_modules/@syncfusion/ej2-buttons/styles/material.css"; */
 .control_wrapper {
        display: block;
        max-width: 350px;
        max-height: 350px;
        margin: auto;
        overflow: auto;
        border: 1px solid #dddddd;
        border-radius: 3px;
    }
</style>