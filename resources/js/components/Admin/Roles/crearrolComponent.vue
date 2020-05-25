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
        <div v-if="rol.special.length == 0" class="card-body">
          <div class="row">

               <div class="col-md-2 my-2" v-for="(categoria,index) in permisos" :key="index">
                  <label @click.prevent="funcion(index)" :style="{cursor: 'pointer'}">
                    <i v-if="nombres.includes(index)" class="far fa-minus-square"></i>
                    <i v-else class="far fa-plus-square"></i>
                    <span class="bold">  {{index}} </span>
                  </label>
                    <div v-for="elemento in categoria" :key="elemento.id"> 
                      <transition name="fade">
                        <label v-if="nombres.includes(elemento.category)"  :style="{cursor: 'pointer'}">
                          <input type="checkbox" :id="elemento.id" :value="elemento.slug" v-model="permiso.slug">
                          <span>{{elemento.name}}</span> 
                          </label>
                      </transition>
                    </div>
                 </div> 

          </div>
              
        </div>
        <div v-else class="card-body">
            <div v-for="especiales in rol.special" :key="especiales">
              <p v-if="especiales == 'all-access'"> Acceso Total</p>
              <p v-if="especiales == 'no-access'"> Ningun Acceso</p>
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
      nombres: [],
      permiso: {
        slug: [],
      },
      categorias: Object.values(this.permisos),
      errors: [],
    }
  },
  created(){
    console.log(this.rol.special);
  },
  methods:{
    funcion(el)
    {
      if(this.nombres.includes(el))
      {
          let index = this.nombres.indexOf(el);
          if (index > -1) {
            this.nombres.splice(index, 1);
          }
      }
      else{
          this.nombres.push(el)
      }
    },
    crearrol()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('name', this.rol.name);
      formData.append('slug', this.rol.slug);
      formData.append('description', this.rol.description);
      formData.append('special', this.rol.special);
      if(this.rol.special.length == 0)
      {
        formData.append('permisos', this.permiso.slug);
      }
      console.log(formData);
      axios.post('/roles/store',formData)
      .then(res => {
        let datos = res.data;
        this.nombres = [];
        this.rol.name = '';
        this.rol.slug = '';
        this.rol.description = '';
        this.rol.special = [];
        this.permiso.slug = [];
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