<template>
<div>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Información</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Roles</a>
    </div>
  </nav>

<hr>
<div class="tab-content" id="nav-tabContent">
    <div style="min-height:50vh" class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
   <div class="row" >
      <div class="col-md-6">
          <div >
              <div class="card">
                <div class="card-header">
                  <h5>{{ usuariomod.nombres }} {{usuariomod.apellidos }} </h5>
                </div>
              <div class="card-body" id="usuarioedit">

                <div>
                  <p class="mb-0"> {{usuariomod.nombres}}  </p>
                  <hr class="my-0">
                  <label>Nombres</label>
                </div>
                <div>
                  <p class="mb-0"> {{usuariomod.apellidos}}  </p>
                  <hr class="my-0">
                  <label>Apellidos</label>
                </div>
                <div>
                  <p class="mb-0"> {{usuariomod.username}}  </p>
                  <hr class="my-0">
                  <label for="username">Nombre de usuario</label>
                </div>

                <div>
                  <p class="mb-0"> {{usuariomod.email ? usuariomod.email : 'N/A'}}  </p>
                  <hr class="my-0">
                  <label for="username">Email</label>
                </div>

                <div>
                  <p class="mb-0"> {{usuariomod.activo ? 'Si' : 'No'}}  </p>
                  <hr class="my-0">
                  <label for="username">Activo</label>
                </div>

                <div>
                  <p class="mb-0"> {{usuariomod.created_at}}  </p>
                  <hr class="my-0">
                  <label for="username">Fecha Creacion</label>
                </div>
                
 
                <div class="form-group col-md-12 px-0">
                  <label for="fotografia">Fotografia de usuario</label><br>
                  <div class="text-center">
                  <img :src="enlace" class="img" style="width: 15em" alt="Imagen de usuario">
                  </div>
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
                  <li v-for="(rol, index) in rolesusuario" :key="index">
                    {{rol.name}}
                  </li>
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
      usuariomod: this.usuario,
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

  },
  
}
</script>