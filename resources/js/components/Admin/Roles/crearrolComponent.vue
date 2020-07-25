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
                <input class="form-control" type="text" name="name" v-model="rol.name" autofocus>
                <label v-if="errors.name" class="alert-danger">{{errors.name[0]}}</label>
            </div>
            <div class="form-group">
                <label>Descripcion*</label>
                <textarea class="form-control" type="text" name="description" v-model="rol.description"></textarea>
                 <label v-if="errors.description" class="alert-danger">{{errors.description[0]}}</label>
            </div>
            <div class="form-group">
              <label class="mr-2"> Categoria*</label> 
              
                <multiselect v-model="value"
                :options= categorias
                :searchable="true"
                :placeholder="'Seleccione o agregue una opcion'" 
                :selectLabel="''" 
                id="categoria"
                :multiple="false"
                @tag="addTag"
                :taggable="true"
                :preserve-search="true" 
                tag-placeholder="Agregar como nueva categoria" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                >
                {{value}}
                </multiselect>
                <label v-if="errors.category" class="alert-danger">{{errors.category[0]}}</label>
              </div>
 
          </div>  
      </div>


      </div>
        <!-- <div class="col-md-6">
          <div class="card">
            <div class="card-header">
                <h5>Permisos Eseciales</h5>
            </div>
            <div class="card-body text-center">
              <select class="form-control col-md-4" v-model="rol.special">
                  <option value=""> Personalizado </option>
                  <option value="all-access">Acceso Total</option>
                  <option value="no-access">Ningun Acceso</option>
              </select>
            </div>
          </div>
        </div> -->
    </div>
      

      <div class="card">
        <div class="card-header">
          <h5>Permisos</h5>
        </div>
        <div v-if="rol.special == ''" class="card-body row">
          <div class="col-md-9">
          <label v-if="expand" @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Contraer todos</label>
          <label v-else @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Expandir todos</label>
          <div class="row">

            <div class="col-md-3 my-2" v-for="(categoria,index) in permisos" :key="index">
              <label class="bg-cyan w-100 rounded px-1" @click.prevent="funcion(index)" :style="{cursor: 'pointer'}">
                <i v-if="nombres.includes(index)" class="far fa-minus-square"></i>
                <i v-else class="far fa-plus-square"></i>
                <span class="bold">  {{index}} </span>
              </label>
              <div v-for="elemento in categoria" :key="elemento.id"> 
                <transition name="fade">
                  <label v-if="nombres.includes(elemento.category)" :style="{cursor: 'pointer'}">
                    <input type="checkbox" :id="elemento.id" :value="[elemento.name,elemento.description]" v-model="permiso.name">
                    <span>{{elemento.name}}</span> 
                  </label>
                </transition>
              </div>
            </div> 

          </div>
          </div>
          <div class="col-md-3">

            <ul>
            <label> Permisos seleccionados</label>
              <li v-for="(item, index) in permiso.name" :key="index">
                
                  <strong>{{item[0]}}</strong> <br/> 
                    <span> {{item[1]}}</span>
                
              </li>
            </ul>
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
import Multiselect from 'vue-multiselect'
export default {
  props: ['permisos', 'categorias'],
  components: { Multiselect },
  data(){
    return{
      value: null,
      rol: {
        name: '',
        description: '',
        category: '',
        special: '',
      },
      test:[],
      expand: true,
      nombres: [],
      permiso: {
        name: [],
      },
      errors: [],
    }
  },
  created(){
     for(var k in this.permisos) {
        this.test.push(k);
      }
    this.nombres = this.test;
  },
  methods:{
    addTag(newTag) {
      // this.categorias.push(newTag);
      this.value =(newTag);
    },
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
      formData.append('description', this.rol.description);
      if(this.value)
      {
        formData.append('category', this.value);
      }

      let arraypermisos = [];
      this.permiso.name.forEach(function(elemento){
        arraypermisos.push(elemento[0]);
      });
      formData.append('permisos', arraypermisos);
      
      console.log(formData);
      axios.post('/roles/store',formData)
      .then(res => {
        let datos = res.data;
        this.nombres = [];
        this.rol.name = '';
        this.rol.description = '';
        this.rol.category = '';
        this.permiso.name = [];
        toast.fire({
          icon: datos[1].type,
          background: datos[1].background,
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
            toast.fire({
              icon: datos[1].type,
              background: datos[1].background,
              title: datos[1].title+' '+datos[1].message
            })
          }
      })
    }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
  .asdf:hover{
    background-color: #d8e0ea;
  }
</style>