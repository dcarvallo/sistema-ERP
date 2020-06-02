<template>
<div>

  <form enctype="multipart/form-data" @keydown.enter.prevent>
  <div class="d-flex justify-content-between">
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Informacion</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Roles</a>
  </div>
</nav>
<div class="text-right">
      <button type="submit" class="btn btn-primary" @click.prevent="crearusuario">Guardar</button>
    </div>
  </div>
<hr>
<div class="tab-content" id="nav-tabContent">
    <div style="min-height:50vh" class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="card">
        <div class="card-header">
            <h5>Información de Usuario</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group border rounded">
                <div class="custom-control custom-switch">
                  <input style="cursor:pointer" type="checkbox" class="custom-control-input display-2" id="switch1" v-model="vincular">
                  <label style="cursor:pointer" class="custom-control-label" for="switch1">Vincular con empleado</label>
                  
                </div>
                <div v-if="vincular" class="form-group mb-0">
                    <input class="form-control mt-2 col-md-12" type="text" style="text-transform:uppercase" placeholder="Buscar empleado" v-model="dato">
                    <div class="col-md-11 position-relative">
                      <div class="position-absolute w-100">
                      <div v-show="dato!=''" :style="'cursor:pointer'" class="form-control border asdf" @click.prevent="seleccionempleado(empleado)" v-for="(empleado, index) in buscarempleado" :key="index">
                        
                        <label class="w-100 position-absolute" style="cursor:pointer" >
                          {{empleado.nombres}} {{empleado.apellidos}}, CI: {{empleado.ci}}
                        </label>
                      </div>
                      </div>
                  </div>
                      <span v-if="empselect">
                       <strong> Usuario vinculado con:</strong> {{empselect}}
                      </span>
                </div>
                <div v-else>{{empselect=''}}{{empleado_id=''}}</div>
              </div>

                <div class="form-group">
                <label for="nombres">Nombres*</label>
                <input type="text" class="form-control" name="nombres" v-model="usuario.nombres" placeholder="Nombres">
                <div v-if="errors.nombres" class="alert-danger">{{ errors.nombres[0] }}</div>
              </div>
              <div class="form-group">
                <label for="apellidos">Apellidos*</label>
                <input type="text" class="form-control" name="apellidos" v-model="usuario.apellidos" placeholder="Apellidos">
                <div v-if="errors.apellidos" class="alert-danger">{{ errors.apellidos[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="username">Nombre de Usuario*</label>
                <input type="text" class="form-control" name="username" v-model="usuario.username" placeholder="Nombre de usuario"/>
                <div v-if="errors.username" class="alert-danger">{{ errors.username[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" class="form-control" name="email" v-model="usuario.email" placeholder="email">
                <div v-if="errors.email" class="alert-danger">{{ errors.email[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="email">Activo*</label>
                <select class="form-control col-md-2" v-model="usuario.activo" name="activo">
                    <option value="1"  selected>Si</option>
                    <option value="0">No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="password">Password*</label>
                <input type="password" class="form-control" v-model="usuario.password" placeholder="password">
                <div v-if="errors.password" class="alert-danger">{{ errors.password[0] }}</div> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Fotografia</label>
                <div class="text-center">
                    <img :src="enlace" class="img" style="width: 15em" alt="Imagen de usuario">
                  </div>
                  <br>
                  <input type="file" @change="onFileChange" class="form-control" name="imagen" />
              </div>
              
            </div>
          </div>
        </div>
      </div>
        

    </div>
    <div style="min-height:50vh" class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="card">
        <div class="card-header">
          <h5>Roles</h5>
        </div>
        <div class="card-body">
            <ul>
              <li v-for="rol in roles" :key="rol.id">
                <label>
                  <input type="checkbox"  :id="rol.id" :value="rol.slug" v-model="rolesSeleccionados" :checked="rol.special == 'no-access'">
                  <span :for="rol.name">{{rol.name}}: </span>
                  <em>{{rol.description}}</em>
                </label>
              </li>
            </ul>
        </div>
      </div>
    </div>
    

</div>
  </form>
    
</div>
</template>

<script>
export default {
  props: ['roles', 'empleados'],
  data(){
    return{
      message: '',
      dato: '',
      empselect:'',
      empleado_id:'',
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
      vincular: false,
      errors: [],
      rolesSeleccionados: [],
    }
  },
  computed: {
    buscarempleado(){
      return this.empleados.filter((empleado) => empleado.apellidos.toLowerCase().includes(this.dato) || empleado.nombres.toLowerCase().includes(this.dato));
    },
  },
  methods:{
    seleccionempleado(emp){
      this.dato ='';
      this.empselect = emp.nombres+' '+emp.apellidos+' CI: '+emp.ci;
      this.empleado_id = emp.id;
      this.usuario.nombres = emp.nombres;
      this.usuario.apellidos = emp.apellidos;
    },
    onFileChange(e) {
      this.usuario.imagen = e.target.files[0];
      this.enlace = URL.createObjectURL(this.usuario.imagen );
    },
    crearusuario()
    {
      
      let formData = new FormData();
      formData.append('nombres', this.usuario.nombres);
      formData.append('apellidos', this.usuario.apellidos);
      formData.append('username', this.usuario.username);
      formData.append('email', this.usuario.email);
      formData.append('activo', this.usuario.activo);
      formData.append('password', this.usuario.password);
      formData.append('imagen', this.usuario.imagen);
      formData.append('roles', this.rolesSeleccionados);
      if(this.empleado_id != ''){
        formData.append('empleado_id', this.empleado_id);
      }
      axios.post('/users/store',formData)
      .then(res => {
        let datos = res.data;
        this.usuario = [];
        this.usuario.activo = 1;
        this.errors = [];
        this.rolesSeleccionados = [];
        this.dato ='';
        this.empleado_id = '';
        this.empselect = '';
        this.vincular=false;
        this.enlace = '/storage/usuariodef/avatar.png';
        toastsuccess.fire({
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        console.log(error)
        let datos = error.data;
        if(error.response.status == 422){
            this.errors = error.response.data.errors;
            toasterror.fire({
            title: 'Error, Revise formulario'
          })
          }
        if(datos){
            toasterror.fire({
            title: datos[1].title+' '+datos[1].message
          })
          }
          if(error.response.status == 500){
            this.errors = error.response.data.errors;
            toasterror.fire({
            title: 'Error, notificado a administrador'
          })
          }
      })
    }
  }
}
</script>

<style>
  .asdf:hover{
    background-color: #d8e0ea;
  }
</style>