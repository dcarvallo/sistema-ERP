<template>
<div class="container-fluid">

  <form enctype="multipart/form-data">

    
      <div class="card">
        <div class="card-header">
            <h5>Rol</h5>
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
            <ul>
              <li v-for="per in permisos" :key="per.id">
                <label>
                  <input :for="per.name" type="checkbox" :id="per.id" :value="per.slug" v-model="permiso.slug">
                  <span >{{per.slug}} ({{per.name}}): </span>
                  <em>{{per.description}}</em>
                </label>
              </li>
            </ul>
            <!-- <ul>
              <li v-for="per in permisos" :key="per.id">
                <label >
                  <input :for="per.name" type="checkbox" v-if="per.slug.split('.', 1) == per.slug.split('.', 1)" :id="per.id" :value="per.slug" v-model="permiso.slug">
                  <span >{{per.slug.split('.', 1) }} ({{per.name}}): </span>
                  <em>{{per.description}}</em> 
                </label>
              </li>
            </ul> -->
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
      errors: [],
    }
  },
  created(){
    console.log(this.permiso);
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
