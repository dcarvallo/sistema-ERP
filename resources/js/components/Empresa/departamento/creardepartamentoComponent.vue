<template>
  <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body ">
    
      <form >
        
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Departamento</h5>
              </div>
            <div class="card-body">

              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control" name="nombre" v-model="departamento.nombre" placeholder="Nombre departamento">
                <label class="alert-danger py-0" v-if="errors.nombre" >{{errors.nombre[0]}}</label>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea type="text" class="form-control" name="descripcion" v-model="departamento.descripcion" placeholder="Descripción"></textarea>
                <label class="alert-danger py-0" v-if="errors.descripcion" >{{errors.descripcion[0]}}</label>
              </div>
              <div class="form-group">
                <label>Encargado del departamento</label>
               <multiselect v-model="departamento.encargado"
                :options= cargos
                :searchable="true" 
                :placeholder="'Seleccione una opcion'" 
                :selectLabel="''" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                label="nombre" 
                >
                <span slot="noResult">No existen cargos.</span>
                </multiselect>

              </div>
              <div class="form-group">
                <label for="ubicacion_id">Ubicacion*</label>
                
               <multiselect v-model="departamento.ubicacion_id"
                :options= ubicaciones
                :searchable="true" 
                :placeholder="'Seleccione una opcion'" 
                :selectLabel="''" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                label="nombre"
                >
                <span slot="noResult">No existe ubicacion.</span>
                </multiselect>
                <label class="alert-danger py-0" v-if="errors.ubicacion" >{{errors.ubicacion[0]}}</label>
              </div>

            </div>
          </div>
          <button type="submit" class="btn btn-primary" @click.prevent="creardepartamento">Crear</button>
        </div>
        
        </div>
      </form>
    
      </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
props: ['ubicaciones', 'cargos'],
 components: { Multiselect },
data() {
  return {
    value: null,
    errors:[],
    departamento: {
      nombre: '',
      descripcion: '',
      encargado: '',
      ubicacion_id: '',
    },
  }
},
created() {
},
methods: {
  creardepartamento()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('nombre', this.departamento.nombre);
      formData.append('descripcion', this.departamento.descripcion);
      if(this.departamento.encargado)
      {
        formData.append('encargado', this.departamento.encargado.nombre);
      }
      if(this.departamento.ubicacion_id)
      {
        formData.append('ubicacion', this.departamento.ubicacion_id.id);
      }
      axios.post('/departamentos/store',formData)
      .then(res => {
        let datos = res.data;
        this.departamento.nombre = '';
        this.departamento.descripcion = '';
        this.departamento = [];
        toastsuccess.fire({
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.response;
        if(error.response.status == 422){
            this.errors = error.response.data.errors;
            toasterror.fire({
            title: 'Error en formulario, revise'
          })
          }
          if(datos[1]){
            toasterror.fire({
              title: datos[1].title+' '+datos[1].message
          })
          }
      })
    }
},
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>