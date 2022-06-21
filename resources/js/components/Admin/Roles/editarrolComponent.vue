<template>
<div class="container-fluid">

  <form @keydown.enter.prevent>

    <div class="row">
        <div class="col-md-6">
      <div class="card">
        <div class="card-header">
            <h5><strong>Editar Rol </strong></h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Nombre*</label>
                <input class="form-control" type="text" v-model="rolmod.name" autofocus>
                <label v-if="errors.name" class="alert-danger">{{errors.name[0]}}</label>
            </div>
            <div class="form-group">
                <label>Descripcion*</label>
                <textarea class="form-control" name="description" type="text" v-model="rolmod.description"></textarea>
                <label v-if="errors.description" class="alert-danger">{{errors.description[0]}}</label>
            </div>
            <div class="form-group">
              <div class="d-flex justify-content-between">
                <label class="mr-2"> Categoria*</label> 
              </div>
              
                <multiselect v-model="value"
                :options= categorias
                :searchable="true" 
                :placeholder="'Seleccione o agregue una opcion'" 
                :selectLabel="''" 
                :multiple="false"
                @tag="addTag"
                :taggable="true"
                :preserve-search="true" 
                tag-placeholder="Agregar como nueva categoria" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                >
                </multiselect>
                <label v-if="errors.category" class="alert-danger">{{errors.category[0]}}</label>
              </div>
          </div>
        
        </div>
      </div>
    </div>
      

      <div class="card">
        <div class="card-header">
          <h5>Permisos</h5>
        </div>
        <div class="card-body row">
              <div class="col-md-9">
              <label v-if="expand" @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Contraer todos</label>
              <label v-else @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Expandir todos</label>
          <div class="row">

               <div class="col-md-2 my-2" v-for="(categoria,index) in permisos" :key="index" > 
                  <label class="bg-cyan w-100 rounded px-1" @click.prevent="funcion(index)" :style="{cursor: 'pointer'}">
                    <i v-if="nombres.includes(index)" class="far fa-minus-square"></i>
                    <i v-else class="far fa-plus-square"></i>
                    <span class="bold">  {{index}} </span>
                  </label>
                    <div v-for="elemento in categoria" :key="elemento.id"> 
                      <transition name="fade">
                        <label v-if="nombres.includes(elemento.category)"  :style="{cursor: 'pointer'}">
                          <input type="checkbox" :id="elemento.id" :value="elemento.name" v-model="perseleccionaados">
                          <span>{{elemento.name}}</span> 
                          </label>
                      </transition>
                    </div>
                 </div> 
            </div>
          </div>
          <div class="col-md-3">
              <ul>
                <label >Seleccionados</label>
                <li v-for="(item, index) in perseleccionaados" :key="index">
                    <span>{{item}}</span> <br>
                  
                </li>
              </ul>

          </div>

              
        </div>
      </div>
    
    <div class="text-right">
      <button type="submit" class="btn btn-primary" @click.prevent="editarrol">Guardar</button>
    </div>
  </form>
    
</div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
  props: ['permisos','rol', 'permisosseleccionados','categorias'],
  components: { Multiselect },
  data(){
    return{
      rolmod: this.rol,
      nombres: [],
      test: [],
      expand: true,
      errors: [],
      nueva: false,
      value: this.rol.category,
      perseleccionaados:[],
    }
  },
  created(){
    if(this.rol.special == null){
      this.rol.special = '';
    }

    for(var k in this.permisos) {
        this.test.push(k);
      }

    for(let i=0; i< this.permisosseleccionados.length; i++)
    {
      this.perseleccionaados[i] = this.permisosseleccionados[i].name; 
    }

    this.nombres = this.test;
  },
  methods:{
    addTag(newTag) {
      this.categorias.push(newTag);
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
    editarrol()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('name', this.rolmod.name);
      formData.append('description', this.rolmod.description);
      if(this.nueva)
      {
        formData.append('category', this.rolmod.category);
      }else if(!this.nueva && this.value != null)
      {
        formData.append('category', this.value);
      }
      formData.append('permisos', this.perseleccionaados);
      formData.append('_method', 'put');
      axios.post('/roles/'+this.rol.id,formData)
      .then(res => {
        let datos = res.data;
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
          toast.fire({
            icon: datos[1].type,
            background: datos[1].background,
            title: datos[1].title+' '+datos[1].message
          })
      })
    }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>