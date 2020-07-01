<template>
  <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body ">
    
      <form @keydown.enter.prevent>
        
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Área</h5>
              </div>
            <div class="card-body">

              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control" id="nombre" v-model="area.nombre" placeholder="Nombre area" autofocus>
                <label class="alert-danger py-0" v-if="errors.nombre" >{{errors.nombre[0]}}</label>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea type="text" class="form-control" id="descripcion" name="descripcion" v-model="area.descripcion" placeholder="Descripción"></textarea>
                <label class="alert-danger py-0" v-if="errors.descripcion" >{{errors.descripcion[0]}}</label>
              </div>
              <div class="form-group">
                <label>Encargado del area</label>
               <multiselect v-model="area.encargado"
                :options= cargos
                :searchable="true"
                :id="encargado"
                :placeholder="'Seleccione Cargo'" 
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
                <label>Departamento*</label>
                
               <multiselect v-model="area.departamento_id"
                :options= departamentos
                :searchable="true" 
                :id="departamento"
                :placeholder="'Seleccione Departamento'" 
                :selectLabel="''" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                label="nombre"
                >
                <span slot="noResult">No existe departamento.</span>
                </multiselect>
                <label class="alert-danger py-0" v-if="errors.departamento" >{{errors.departamento[0]}}</label>
              </div>

            </div>
          </div>
          <button type="submit" class="btn btn-primary" @click.prevent="creararea">Crear</button>
        </div>
        
        </div>
      </form>
    
      </div>
    </div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
props: ['departamentos', 'cargos'],
 components: { Multiselect },
data() {
  return {
    value: null,
    errors:[],
    area: {
      nombre: '',
      descripcion: '',
      encargado: null,
      departamento_id: null,
    },
  }
},
created() {
},
methods: {
  creararea()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('nombre', this.area.nombre);
      formData.append('descripcion', this.area.descripcion);
      if(this.area.encargado)
      {
        formData.append('encargado', this.area.encargado.nombre);
      }
      if(this.area.departamento_id)
      {
        formData.append('departamento', this.area.departamento_id.id);
      }
      axios.post('/areas/store',formData)
      .then(res => {
        let datos = res.data;
        this.area = [];
        if(datos[1])
        {
          toastsuccess.fire({
            title: datos[1].title+': '+datos[1].messagess
        })
        }
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