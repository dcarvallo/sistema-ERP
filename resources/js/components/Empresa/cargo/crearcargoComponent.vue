<template>

    <div class="card card-solid">
      <div class="card-body ">
    
      <form @keydown.enter.prevent>
        
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información del Cargo</h5>
              </div>
            <div class="card-body">

              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control" name="nombre" v-model="cargo.nombre" placeholder="Nombre cargo" autofocus>
                <label class="alert-danger py-0" v-if="errors.nombre" >{{errors.nombre[0]}}</label>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea type="text" class="form-control" name="descripcion" v-model="cargo.descripcion" placeholder="Descripción"></textarea>
                <label class="alert-danger py-0" v-if="errors.descripcion" >{{errors.descripcion[0]}}</label>
              </div>
              <div class="form-group">
                <label for="ubicacion_id">Area*</label>
                
               <multiselect v-model="cargo.area_id"
                :options= areas
                :searchable="true" 
                :placeholder="'Seleccione una opcion'" 
                :selectLabel="''" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                label="nombre"
                >
                <span slot="noResult">No existe area.</span>
                </multiselect>
                <label class="alert-danger py-0" v-if="errors.area" >{{errors.area[0]}}</label>
              </div>

            </div>
          </div>
          <button type="submit" class="btn btn-primary" @click.prevent="crearcargo">Crear</button>
        </div>
        
        </div>
      </form>
    
      </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
props: ['areas'],
 components: { Multiselect },
data() {
  return {
    value: null,
    errors:[],
    cargo: {
      nombre: '',
      descripcion: '',
      area_id: '',
    },
  }
},
created() {
},
methods: {
  crearcargo()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('nombre', this.cargo.nombre);
      formData.append('descripcion', this.cargo.descripcion);
      if(this.cargo.area_id)
      {
        formData.append('area', this.cargo.area_id.id);
      }
      axios.post('/cargos/store',formData)
      .then(res => {
        let datos = res.data;
        this.cargo = [];
        toastsuccess.fire({
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.response;
        console.log(error);
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