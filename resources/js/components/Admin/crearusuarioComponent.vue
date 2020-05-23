<template>
    <form enctype="multipart/form-data">
          
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                   <h5>Información de Usuario</h5>
                </div>
              <div class="card-body">

                <div class="form-group">
                  <label for="nombres">Nombres*</label>
                  <input type="text" class="form-control" name="nombres" v-model="usuario.nombres" placeholder="Nombres">
                  <div v-if="errors.nombres" class="alert alert-danger">{{ errors.nombres[0] }}</div>
                </div>
                <div class="form-group">
                  <label for="apellidos">Apellidos*</label>
                  <input type="text" class="form-control" name="apellidos" v-model="usuario.apellidos" placeholder="Apellidos">
                  <div v-if="errors.apellidos" class="alert alert-danger">{{ errors.apellidos[0] }}</div> 
                </div>
                <div class="form-group">
                  <label for="username">Nombre de Usuario*</label>
                  <input type="text" class="form-control" name="username" v-model="usuario.username" placeholder="Nombre de usuario"/>
                  <div v-if="errors.username" class="alert alert-danger">{{ errors.username[0] }}</div> 
                </div>
                <div class="form-group">
                  <label for="email">Email*</label>
                  <input type="email" class="form-control" name="email" v-model="usuario.email" placeholder="email">
                  <div v-if="errors.email" class="alert alert-danger">{{ errors.email[0] }}</div> 
                </div>
                <div class="form-group">
                  <label for="email">Activo*</label>
                  <select class="form-control" v-model="usuario.activo" name="activo">
                      <option value="1"  selected>Si</option>
                      <option value="0">No</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="password">Password*</label>
                  <input type="password" class="form-control" v-model="usuario.password" placeholder="password">
                  <div v-if="errors.password" class="alert alert-danger">{{ errors.password[0] }}</div> 
                </div>

             </div>
            </div>
          </div>

          <div class="col-md-6">

            <div class="form-group">
              <div class="text-center">
                  <img :src="enlace" class="img" style="width: 15em" alt="Imagen de usuario">
                </div>
                <br>
                <input type="file" @change="onFileChange" class="form-control" name="imagen" />
            </div>

            <div class="card">
              <div class="card-header">
                <h5>Roles</h5>
              </div>
              <div class="card-body">
                  <ul>
                    <li v-for="rol in roles" :key="rol.id">
                      <label>
                        <input type="checkbox" :id="rol.id" :value="rol.slug" v-model="rolesSeleccionados">
                        <label :for="rol.name">{{rol.name}}: </label>
                        <em>{{rol.description}}</em>
                      </label>
                    </li>
                  </ul>
              </div>
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary" @click.prevent="crearusuario">Crear</button>
            </div>
          </div>
           
         </div>
        </form>
</template>

<script>
export default {
  props: ['roles'],
  data(){
    return{
      message: '',
      enlace: '/storage/usuariodef/avatar.png',
      usuario: {
        nombres: '',
        apellidos: '',
        username: '',
        activo: 1,
        email: '',
        password: '',
        imagen: '',
      },
      errors: [],
      rolesSeleccionados: [],
    }
  },
  methods:{
    onFileChange(e) {
      this.usuario.imagen = e.target.files[0];
      this.enlace = URL.createObjectURL(this.usuario.imagen );
    },
    crearusuario()
    {
      this.errors = [];
      this.rolesSeleccionados = [];
      let formData = new FormData();
      formData.append('nombres', this.usuario.nombres);
      formData.append('apellidos', this.usuario.apellidos);
      formData.append('username', this.usuario.username);
      formData.append('email', this.usuario.email);
      formData.append('activo', this.usuario.activo);
      formData.append('password', this.usuario.password);
      formData.append('imagen', this.usuario.imagen);
      formData.append('roles', this.rolesSeleccionados);
      console.log(formData);
      axios.post('/users/store',formData)
      .then(res => {
        let datos = res.data;
        this.usuario = [];
        this.enlace = '/storage/usuariodef/avatar.png';
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
