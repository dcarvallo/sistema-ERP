<template>
  <div class="form-row">
     <div class="col-md-6">
       <div class="card">
         <div class="card-header">
            <h5>Información Principal</h5>
         </div>
       <div class="card-body">
        <div class="form-group">
          <label for="nombre">Nombre de Empresa*</label>
          <input type="text" class="form-control" name="nombre" placeholder="Empresa xyz" v-model="nombre">
          <span v-if="errors.nombre" class="text-danger">{{errors.nombre[0]}}</span>
        </div>
        <div class="form-group">
          <label for="descripcion">Descripción*</label>
          <textarea type="text" class="form-control" name="descripcion" placeholder="Descripción" v-model="descripcion"></textarea>
          <span v-if="errors.descripcion" class="text-danger">{{errors.descripcion[0]}}</span>
        </div>
        <div class="form-group">
          <label for="rubro">Rubro*</label>
          <input type="text" class="form-control" name="rubro" placeholder="Rubro de la empresa" v-model="rubro">
          <span v-if="errors.rubro" class="text-danger">{{errors.rubro[0]}}</span>
        </div>
        <div class="form-group">
          <label for="mision">Misión</label>
          <textarea type="text" class="form-control" name="mision" placeholder="Misión" v-model="mision"></textarea>
        </div>
        <div class="form-group">
          <label for="vision">Visión</label>
          <textarea type="text" class="form-control" name="vision" placeholder="Visión" v-model="vision"></textarea>
        </div>
      </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
            <h5>Información de Contacto</h5>
         </div>
      <div class="card-body">
      <div class="form-group">
        <label for="nombre">Dirección*</label>
        <input type="text" class="form-control" name="direccion" placeholder="Nombre de la calle" v-model="direccion">
        <span v-if="errors.direccion" class="alert-danger">{{errors.direccion[0]}}</span>
      </div>
      <div class="form-group col-md-5 px-0">
        <label for="nombre">Teléfonos</label>
        <input type="text" class="form-control" name="telefono" placeholder="Teléfono" v-model="telefono">
      </div>
      <div class="form-group">
        <label for="nombre">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email" v-model="email">
      </div>
      <div class="form-group col-md-5 px-0">
        <label for="fecha_creacion">Fecha de Creación de la Empresa*</label>
        <input type="date" class="form-control" name="fecha_creacion" v-model="fecha_creacion">
        <span v-if="errors.fecha_creacion" class="alert-danger">{{errors.fecha_creacion[0]}}</span>
      </div>
      <div class="form-group col-md-5 px-0">
        <label for="fecha_creacion">Imagen de la Empresa</label>
        <input type="file" class="form-control" @change="imagene($event)" name="imagen_empresa">
      </div>
      </div>
      

    </div>
       </div>
    <button type="submit" class="btn btn-primary" @click.prevent="crearempresa()">Crear</button>
<!-- </form> -->
   
  </div>
</template>

<script>
export default {
  data() {
    return {
      nombre: '',
      descripcion: '',
      rubro: '',
      mision: '',
      vision: '',
      direccion: '',
      telefono: '',
      email: '',
      fecha_creacion: '',
      imagen_empresa: '',
      errors: [],
      
    }
  },
  methods: {
    crearempresa() {
      
      this.errors = [],
        axios.post('/empresas/store',
        {
          nombre: this.nombre,
          descripcion: this.descripcion,
          rubro: this.rubro,
          mision: this.mision,
          vision: this.vision,
          direccion: this.direccion,
          telefono: this.telefono,
          email: this.email,
          fecha_creacion: this.fecha_creacion,
          imagen_empresa: this.imagen_empresa
        }
        )
        .then(response => {
          let datos = response.data;
          
          toastsuccess.fire({
                title: 'Empresa creada: '+datos.nombre
            }),
         console.log(datos);
         window.location.href = '/empresas';
         
        }).catch(error => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors;
            console.log(this.errors);
          }
        });
    },
    // imagene(event) {
    //   this.imagen_empresa = event.target.files[0]
    //   console.log(this.imagen_empresa);
    // }

    imagene(e) {
      console.log(e.target.files[0]);
      let fileReader = new FileReader();
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = (e) => {
        this.imagen_empresa = e.target.result
      }

    console.log(this.imagen_empresa);

    },
  },
}
</script>