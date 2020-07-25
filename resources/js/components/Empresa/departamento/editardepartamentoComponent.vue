<template>
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
                <input type="text" class="form-control" name="nombre" v-model="depa_mod.nombre" placeholder="Nombre departamento" required autofocus>
                <label class="alert-danger py-0" v-if="errors.nombre" >{{errors.nombre[0]}}</label>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea type="text" class="form-control" name="descripcion" v-model="depa_mod.descripcion" placeholder="Descripción"></textarea>
                <label class="alert-danger py-0" v-if="errors.descripcion" >{{errors.descripcion[0]}}</label>
              </div>
              <div class="form-group">
                <label>Encargado del departamento</label>
               <multiselect v-model="depa_mod.encargado"
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
                
               <multiselect v-model="depa_mod.ubicacion_id"
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
          <button type="submit" class="btn btn-primary" @click.prevent="editardepartamento">Guardar</button>
        </div>
        
        </div>
      </form>
    
      </div>
    </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
export default {
props: ['ubicaciones', 'cargos', 'departamento'],
 components: { Multiselect },
data() {
  return {
    errors:[],
    depa_mod: this.departamento,
  }
},
created() {
  this.cargos.forEach((column) => {
    if(column.nombre == this.departamento.encargado){
      this.depa_mod.encargado = column;
    }
  });

  this.ubicaciones.forEach((column) => {
    if(column.id == this.departamento.ubicacion_id){
      this.depa_mod.ubicacion_id = column;
    }
  });
},
methods: {
  editardepartamento()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('nombre', this.depa_mod.nombre);
      formData.append('descripcion', this.depa_mod.descripcion);
      if(this.depa_mod.encargado)
      {
        formData.append('encargado', this.depa_mod.encargado.nombre);
      }
      if(this.depa_mod.ubicacion_id)
      {
        formData.append('ubicacion', this.depa_mod.ubicacion_id.id);
      }
      formData.append('_method', 'put');
      axios.post('/departamentos/'+this.depa_mod.id,formData)
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