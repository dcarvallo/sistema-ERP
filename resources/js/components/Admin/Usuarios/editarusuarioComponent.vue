<template>
<div>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Informacion</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Roles</a>
    </div>
  </nav>

<hr>
<div class="tab-content" id="nav-tabContent">
    <div style="min-height:50vh" class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
   <div class="row" >
      <div class="col-md-6">
      <form enctype="multipart/form-data" @keydown.enter.prevent>
          <div >
              <div class="card">
                <div class="card-header">
                  <h5>{{ usuariomod.nombres }} {{usuariomod.apellidos }} </h5>
                </div>
              <div class="card-body" id="usuarioedit">

                <div class="form-group">
                  <label for="nombres">Nombres</label>
                  <input type="text" class="form-control " name="nombres" v-model="usuariomod.nombres" placeholder="Nombres" autofocus>
                  <div v-if="errors.nombres" class="alert-danger">{{ errors.nombres[0] }}</div>
                </div>
                <div class="form-group">
                  <label for="apellidos">Apellidos</label>
                  <input type="text" class="form-control " name="apellidos" v-model="usuariomod.apellidos" placeholder="Apellidos">
                  <div v-if="errors.apellidos" class="alert-danger">{{ errors.apellidos[0] }}</div>
                </div>
                <div class="form-group">
                  <label for="username">Nombre de Usuario</label>
                  <input type="text" class="form-control " name="username" v-model="usuariomod.username"  placeholder="Nombre de usuario"/>
                  <div v-if="errors.username" class="alert-danger">{{ errors.username[0] }}</div>
                </div>

                
                <div class="form-group col-md-3 px-0">
                  <label for="email">Activo</label>
                  <select class="form-control" v-model="usuariomod.activo" name="activo">
                      <option value="1" >Si</option>
                      <option value="0" >No</option>
                  </select>
                </div>
                

                <div class="form-group col-md-12 px-0">
                  <label for="fotografia">Fotografia de usuario</label><br>
                  <div class="text-center">
                  <img :src="enlace" class="img" style="width: 15em" alt="Imagen de usuario">
                  </div>
                  <br>
                  <input type="file" @change="onFileChange" class="form-control" name="imagen" accept="image/*"/>
                  <div v-if="errors.imagen" class="alert-danger">{{ errors.imagen[0] }}</div>
                </div>
                
          <div class="text-right">
            <button type="submit" class="btn btn-primary" @click.prevent="editarusuarioprin">Guardar</button>
        </div>
             </div>
            </div>
           
       <!-- </form> -->
         </div>
        </form>
        </div>
          <div class="col-md-6">

            <div class="row"> 

            <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Editar correo</h5>
              </div>
              <div class="card-body">
            <form >
              <div class="form-group">
                  <div class="d-flex">

                    <input type="email" class="form-control col-md-10 mr-2" v-model="usuario.email" placeholder="email">
                    <button class="btn btn-sm btn-primary text-white col-md-2" @click.prevent="updateemail">{{botonmail}}</button>
                   
                  </div>
                  <p class="alert alert-danger" v-if="errors.email">{{errors.email[0]}}</p>
                  
                </div>
            </form>

              </div>
            </div>  
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5>Restablecer password</h5>
                </div>
                <div class="card-body">
                  <form>
                  <div class="form-group">
                  <div class="d-flex">
                  <input type="password" class="form-control col-md-10 mr-2" v-model="usuario.password" name="password"  placeholder="Password">
                  <button class="btn btn-sm btn-primary text-white col-md-2" @click.prevent="updatepass">{{botonpass}}</button>
                  </div>
                  <span class="text-success">Minimo de 6 caracteres </span>
                  <p v-if="errors.password" class="alert alert-danger">{{errors.password[0]}}</p>
                 
                </div>
                  </form>
                </div>
              </div>
            </div>
            

        </div>
      </div>
    </div>
    </div>

    <div style="min-height:50vh" class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5>Roles</h5>
                </div>
                <div class="card-body">
                  <form>
                  <!-- <ul>
                    <li v-for="rol in roles" :key="rol.id">
                      <label>
                        <input type="checkbox" :value="rol.name" v-model="rolesSeleccionados">
                        <span>{{rol.name}}</span>
                        <em>{{rol.description}}</em>
                      </label>
                    </li>
                  </ul> -->
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
                                <input type="checkbox" :id="elemento.id" :value="elemento.name" v-model="rolesSeleccionados">
                                <span>{{elemento.name}}</span> 
                                </label>
                            </transition>
                          </div>
                      </div> 
                    </div>
                  <br>
                  <div class="text-right">
                    <button class="btn btn-primary" @click.prevent="updaterol">Guardar</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
    </div>


    </div>




  </div>
</template>

<script>

export default {
  props: ['usuario','roles','rolesusuario'],
  data(){
    return{
      botonmail: 'Guardar',
      botonpass: 'Guardar',
      expand: false,
      nombres: [],
      test:[],
      errors: [],
      enlace: '/storage/'+this.usuario.fotografia,
      usuariomod:{
        nombres: this.usuario.nombres,
        apellidos: this.usuario.apellidos,
        username: this.usuario.username,
        activo: this.usuario.activo,
        imagen: '',
      },
      rolesSeleccionados: [],
    }
  },
  created(){
    
    for(let i=0; i< this.rolesusuario.length; i++)
    {
      this.rolesSeleccionados[i] = this.rolesusuario[i].name; 
    }
    for(var k in this.roles) {
        this.test.push(k);
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
    onFileChange(e) {
      this.usuariomod.imagen = e.target.files[0];
      this.enlace = URL.createObjectURL(this.usuariomod.imagen );
    },
    updateemail() {
      this.errors = [];
        axios.put('/users/um/'+this.usuario.id, 
        { 
         email: this.usuario.email
        }
        )
        .then(response => {
          let datos = response.data;
          this.usuario.password = '';
          toastsuccess.fire({
                title:  datos[1].title+' '+datos[1].message
            })
        }).catch(error => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
        });


    },
    updatepass() {
      this.errors = [];
        axios.put('/users/up/'+this.usuario.id,
        {
          password: this.usuario.password
        }
        )
        .then(response => {
          let datos = response.data;
          this.usuario.password = '';
          toastsuccess.fire({
                title:  datos[1].title+' '+datos[1].message
            })
        }).catch(error => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
        });
    },
    editarusuarioprin() {
      this.errors = [];
      let formData = new FormData();
      formData.append('nombres', this.usuariomod.nombres);
      formData.append('apellidos', this.usuariomod.apellidos);
      formData.append('username', this.usuariomod.username);
      formData.append('activo', this.usuariomod.activo);
      formData.append('imagen', this.usuariomod.imagen);
      formData.append('_method', 'put');
      
      axios.post('/users/'+this.usuario.id, 
      formData
        )
        .then(response => {
          let datos = response.data;
          this.usuariomod.password = '';
          toastsuccess.fire({
                title:  datos[1].title+' '+datos[1].message
            })
        }).catch(error => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
        });


    },
    updaterol() {
      // let rolessel = this.rolesSeleccionados;
      let formData = new FormData();
      formData.append('roles', this.rolesSeleccionados);
      formData.append('_method', 'put');
      this.errors = [];
        axios.post('/users/ur/'+this.usuario.id,
        formData
        )
        .then(response => {
          let datos = response.data;
          this.usuario.password = '';
          toastsuccess.fire({
                title:  datos[1].title+' '+datos[1].message
            })
        }).catch(error => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
        });
    },

  },
  
}
</script>