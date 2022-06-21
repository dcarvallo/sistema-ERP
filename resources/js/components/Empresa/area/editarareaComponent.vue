<template>
   <div class="card card-solid">
      <div class="card-body ">
    
      <form >
        
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Área</h5>
              </div>
            <div class="card-body">

              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control" name="nombre" v-model="area_mod.nombre" placeholder="Nombre Area" autofocus>
                <label class="alert-danger py-0" v-if="errors.nombre" >{{errors.nombre[0]}}</label>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea type="text" class="form-control" name="descripcion" v-model="area_mod.descripcion" placeholder="Descripción"></textarea>
                <label class="alert-danger py-0" v-if="errors.descripcion" >{{errors.descripcion[0]}}</label>
              </div>
              <div class="form-group">
                <label>Encargado del area</label>
               <multiselect v-model="area_mod.encargado"
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
                <label for="ubicacion_id">Departamento*</label>
                
               <multiselect v-model="area_mod.departamento_id"
                :options= departamentos
                :searchable="true" 
                :placeholder="'Seleccione una opcion'" 
                :selectLabel="''" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                label="nombre"
                >
                <span slot="noResult">No existe departamento.</span>
                </multiselect>
              </div>
              <label class="alert-danger py-0" v-if="errors.departamento" >{{errors.departamento[0]}}</label>

            </div>
          </div>
          <button type="submit" class="btn btn-primary" @click.prevent="editararea">Guardar</button>
        </div>
        
        </div>
      </form>
    
      </div>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
export default {
props: ['departamentos', 'cargos', 'area'],
 components: { Multiselect },
data() {
  return {
    errors:[],
    area_mod: this.area,
  }
},
created() {
  this.cargos.forEach((column) => {
    if(column.nombre == this.area.encargado){
      this.area_mod.encargado = column;
    }
  });

  this.departamentos.forEach((column) => {
    if(column.id == this.area.departamento_id){
      this.area_mod.departamento_id = column;
    }
  });
},
methods: {
  editararea()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('nombre', this.area_mod.nombre);
      formData.append('descripcion', this.area_mod.descripcion);
      if(this.area_mod.encargado)
      {
        formData.append('encargado', this.area_mod.encargado.nombre);
      }
      if(this.area_mod.departamento_id)
      {
        formData.append('departamento', this.area_mod.departamento_id.id);
      }
      formData.append('_method', 'put');
      axios.post('/areas/'+this.area_mod.id,formData)
      .then(res => {
        let datos = res.data;
        toast.fire({
          icon: datos[1].type,
          background: datos[1].background,
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.response;
        console.log(error);
        if(error.response.status == 422){
            this.errors = error.response.data.errors;
            toast.fire({
              icon: datos[1].type,
              background: datos[1].background,
              title: 'Error en formulario, revise'
            })
          }
          if(datos[1]){

            toast.fire({
              icon: datos[1].type,
              background: datos[1].background,
              title: datos[1].title+' '+datos[1].message
            })
          }
      })
    }
},
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>