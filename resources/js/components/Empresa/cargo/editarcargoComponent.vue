<template>
   <div class="card card-solid">
      <div class="card-body ">
    
      <form >
        
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Cargo</h5>
              </div>
            <div class="card-body">

              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control" name="nombre" v-model="cargo_mod.nombre" placeholder="Nombre Area">
                <label class="alert-danger py-0" v-if="errors.nombre" >{{errors.nombre[0]}}</label>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea type="text" class="form-control" name="descripcion" v-model="cargo_mod.descripcion" placeholder="Descripción"></textarea>
                <label class="alert-danger py-0" v-if="errors.descripcion" >{{errors.descripcion[0]}}</label>
              </div>
              <div class="form-group">
                <label for="ubicacion_id">Area*</label>
                
               <multiselect v-model="cargo_mod.area_id"
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
              </div>

            </div>
          </div>
          <button type="submit" class="btn btn-primary" @click.prevent="editarcargo">Guardar</button>
        </div>
        
        </div>
      </form>
    
      </div>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
export default {
props: ['cargo', 'areas'],
 components: { Multiselect },
data() {
  return {
    errors:[],
    cargo_mod: this.cargo,
  }
},
created() {

  this.areas.forEach((column) => {
    if(column.id == this.cargo.area_id){
      this.cargo_mod.area_id = column;
    }
  });
},
methods: {
  editarcargo()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('nombre', this.cargo_mod.nombre);
      formData.append('descripcion', this.cargo_mod.descripcion);
      formData.append('area_id', this.cargo_mod.area_id.id);
      formData.append('_method', 'put');
      axios.post('/cargos/'+this.cargo_mod.id,formData)
      .then(res => {
        let datos = res.data;
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