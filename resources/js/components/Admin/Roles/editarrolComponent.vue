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
                <input class="form-control" type="text" v-model="rolmod.name">
            </div>
            <div class="form-group">
                <label>Slug (abreviacion)*</label>
                <input class="form-control" type="text" v-model="rolmod.slug">
            </div>
            <div class="form-group">
                <label>Descripcion*</label>
                <textarea class="form-control" type="text" v-model="rolmod.description"></textarea>
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
              <select class="form-control col-md-4" v-model="rolmod.special">
                  <option value=""> Personalizado </option>
                  <option value="all-access" :selected="rolmod.special=='all-access'">Acceso Total</option>
                  <option value="no-access" :selected="rolmod.special=='no-access'">Ningun Acceso</option>
              </select>
            </div>
          </div>
        </div>
    </div>
      

      <div class="card">
        <div class="card-header">
          <h5>Permisos</h5>
        </div>
        <div v-if="rolmod.special == ''" class="card-body">
              <!-- <i class="far fa-plus-square"></i> -->
              <label v-if="expand" @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Contraer todos</label>
              <label v-else @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Expandir todos</label>
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
                          <input type="checkbox" :id="elemento.id" :value="elemento.slug" v-model="perseleccionaados">
                          <span>{{elemento.name}}</span> 
                          </label>
                      </transition>
                    </div>
                 </div> 

          </div>
              
        </div>
        <div v-else class="card-body">
              <p v-if="rolmod.special == 'all-access'"> <i class="far fa-check-square"></i> Acceso total a el CRUD de los modulos</p>
              <p v-if="rolmod.special == 'no-access'"> <i class="far fa-check-square"></i> Ningun Acceso a los modulos</p>
        </div>
      </div>
    
    <div class="text-right">
      <button type="submit" class="btn btn-primary" @click.prevent="editarrol">Guardar</button>
    </div>
  </form>
    
</div>
</template>

<script>

export default {
  props: ['permisos','rol', 'permisosseleccionados'],
  data(){
    return{
      rolmod: this.rol,
      nombres: [],
      test: [],
      expand: false,
      categorias: Object.values(this.permisos),
      errors: [],
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
      this.perseleccionaados[i] = this.permisosseleccionados[i].slug; 
    }

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
    editarrol()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('name', this.rolmod.name);
      formData.append('slug', this.rolmod.slug);
      formData.append('description', this.rolmod.description);
      formData.append('special', this.rolmod.special);
      formData.append('_method', 'put');
      if(this.rolmod.special == '')
      {
        formData.append('permisos', this.perseleccionaados);
      }
      console.log(formData);
      axios.post('/roles/'+this.rol.id,formData)
      .then(res => {
        let datos = res.data;
        toastsuccess.fire({
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.data;
        console.log(error);
        if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
          toasterror.fire({
            title: datos[1].title+' '+datos[1].message
          })
      })
    }
  }
}
</script>