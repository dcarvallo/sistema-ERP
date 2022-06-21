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
      <button type="submit" class="btn btn-primary" @click.prevent="crearusuario"><i class="far fa-save"></i> Guardar</button>
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
                <div class="custom-control custom-switch mb-1">
                  <input style="cursor:pointer" type="checkbox" class="custom-control-input display-2" id="switch1" v-model="vincular">
                  <label style="cursor:pointer" class="custom-control-label" for="switch1">Vincular con empleado</label>
                  
                </div>
                <div v-if="vincular" class="form-group mb-0">
                    <div class="col-md-11 position-relative">
                      <div class="position-absolute w-100">
                      </div>
                    </div>
                        <multiselect v-model="value"
                        :options= empleados
                        :searchable="true"
                        :placeholder="'Seleccione un empleado'" 
                        :selectLabel="''" 
                        :multiple="false"
                        track-by="id"
                        @select="seleccionempleado"
                        :custom-label="nombresApellidosCi"
                        :preserve-search="true" 
                        :selectedLabel="'Seleccionado'" 
                        :deselectLabel="''"
                        :noOptions="''"
                        >
                        <span slot="noResult">No existe empleado registrado.</span>
                        </multiselect>
                    <span v-if="empselect">
                      <strong> Usuario vinculado con:</strong> {{empselect}}
                    </span>
                </div>
                <div v-else>{{empselect=''}}{{empleado_id=''}}</div>
              </div>

                <div class="form-group">
                <label for="nombres">Nombres*</label>
                <input type="text" class="form-control" id="nombres" name="nombres" v-model="usuario.nombres" placeholder="Nombres" autofocus>
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
                <input type="password" class="form-control" name="password" v-model="usuario.password" placeholder="password">
                <div v-if="errors.password" class="alert-danger">{{ errors.password[0] }}</div> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Fotografía</label>
                <div class="text-center">
                    <img :src="enlace" class="img" style="width: 10em" alt="Imagen de usuario">
                  </div>
                  <br>
                  <input type="file" @change="onFileChange" class="form-control" name="imagen" accept="image/*"/>
                  <div v-if="errors.imagen" class="alert-danger">{{ errors.imagen[0] }}</div> 
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
          <label v-if="expand" @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Contraer todos</label>
          <label v-else @click="expand = !expand" :style="{cursor: 'pointer'}" @click.prevent="expandirTodos">Expandir todos</label>

          <div class="row">
              <div class="col-md-2 my-2" v-for="(categoria,index) in roles" :key="index">
                <label class="bg-cyan w-100 rounded px-1" @click.prevent="funcion(index)" :style="{cursor: 'pointer'}">
                  <i v-if="nombres.includes(index)" class="far fa-minus-square"></i>
                  <i v-else class="far fa-plus-square"></i>
                  <span class="bold">  {{index}} </span>
                </label>
                  <div v-for="elemento in categoria" :key="elemento.id"> 
                    <transition name="fade">
                      <label v-if="nombres.includes(elemento.category)"  :style="{cursor: 'pointer'}">
                        <input type="checkbox" :id="elemento.id" :value="elemento.name" v-model="rol.guard_name">
                        <span>{{elemento.name}}</span> 
                        </label>
                    </transition>
                  </div>
                </div> 
            </div>
        </div>
      </div>
    </div>
    

</div>
  </form>
    
</div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
  props: ['roles', 'empleados'],
  components: { Multiselect },
  data(){
    return{
      value: null,
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
      rol: {
        guard_name: [],
      },
      vincular: false,
      nombres: [],
      test:[],
      expand: true,
      errors: [],
    }
  },
  created() {
    for(var k in this.roles) {
        this.test.push(k);
      }
      this.nombres = this.test;
  },
  computed: {
    // buscarempleado(){
    //   return this.empleados.filter((empleado) => empleado.apellidos.toLowerCase().includes(this.dato) || empleado.nombres.toLowerCase().includes(this.dato));
    // },
  },
  methods:{
    nombresApellidosCi ({ nombres, ap_paterno, ap_materno, ci }) {
      return `${nombres} ${ap_paterno} ${ap_materno} - CI: ${ci}`
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
    seleccionempleado(datos){
      // this.dato ='';
      // this.empselect = datos.nombres+' '+datos.apellidos+' CI: '+datos.ci;
      this.usuario.nombres = datos.nombres;
      this.usuario.apellidos = datos.ap_paterno+' '+datos.ap_materno;
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
      formData.append('roles', this.rol.guard_name);
      if(this.value != null && this.vincular == true){
        formData.append('empleado_id', this.value.id);
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
            toast.fire({
              icon: datos[1].type,
              background: datos[1].background,
              title: 'Error en formulario, revise'
            })
          }
        if(datos){
            toasterror.fire({
            title: datos[1].title+' '+datos[1].message
          })
          }
          if(error.response.status == 500){
            toast.fire({
              icon: datos[1].type,
              background: datos[1].background,
              title: 'Error, contacte administrador'
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