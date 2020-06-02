<template>
<div class="container-fluid">

  <form @keydown.enter.prevent>

    <div class="row">
        <div class="col-md-6">
      <div class="card">
        <div class="card-header">
            <h5><strong> Rol </strong></h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nombre*</label>
                <input class="form-control" type="text" v-model="rol.name">
                <label v-if="errors.name" class="alert-danger">{{errors.name[0]}}</label>
            </div>
            <div class="form-group">
                <label>Slug (abreviacion)*</label>
                <input class="form-control" type="text" v-model="rol.slug">
                 <label v-if="errors.slug" class="alert-danger">{{errors.slug[0]}}</label>
            </div>
            <div class="form-group">
                <label>Descripcion*</label>
                <textarea class="form-control" type="text" v-model="rol.description"></textarea>
                 <label v-if="errors.description" class="alert-danger">{{errors.description[0]}}</label>
            </div>
            
          </div>
        
    </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
                <h5>Permisos Eseciales</h5>
            </div>
            <div class="card-body">
              <select class="form-control col-md-4" v-model="rol.special">
                  <option value=""> Personalizado </option>
                  <option value="all-access">Acceso Total</option>
                  <option value="no-access">Ningun Acceso</option>
              </select>
            </div>
          </div>
        </div>
    </div>
      

      <div class="card">
        <div class="card-header">
          <h5>Permisos</h5>
        </div>
        <div v-if="rol.special == ''" class="card-body">
          <label v-if="expand" @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Contraer todos</label>
          <label v-else @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Expandir todos</label>
          <div class="row">

               <div class="col-md-2 my-2" v-for="(categoria,index) in permisos" :key="index">
                  <label class="bg-cyan w-100 rounded px-1" @click.prevent="funcion(index)" :style="{cursor: 'pointer'}">
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
              <p v-if="rol.special == 'all-access'"> <i class="far fa-check-square"></i> Acceso total a el CRUD de los modulos</p>
              <p v-if="rol.special == 'no-access'"> <i class="far fa-check-square"></i> Ningun Acceso a los modulos</p>
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
        special: '',
      },
      test:[],
      expand: false,
      nombres: [],
      permiso: {
        slug: [],
      },
      categorias: Object.values(this.permisos),
      errors: [],
    }
  },
  created(){
     for(var k in this.permisos) {
        this.test.push(k);
      }
    console.log(this.rol.special);
  },
  methods:{
    expandirTodos()
    {
      if(this.expand)
      {
        this.nombres = this.test;
      }
      else
        this.nombres = [];
    },
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
      if(this.rol.special == '')
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
        this.rol.special = '';
        this.permiso.slug = [];
        toastsuccess.fire({
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.data;
        if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
          if(datos)
          {
            toasterror.fire({
            title: datos[1].title+' '+datos[1].message
          })
          }
      })
    }
  }
}
</script>