<template>
<div class="container-fluid">

  <form @keydown.enter.prevent>

    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <h5><strong> Libro Diario </strong></h5>
            </div>
            <div class="card-body">
              <div class="row">
                  <div class="col-md-1">
                    <select class="form-control" name="" id="">
                      <option value="">Apunte</option>
                    </select>
                  </div>
                  <div class="col-md-4"></div>
                  <div class="col-md-4"></div>
              </div>
                
                <table class="table table-responsive-sm">
                  <thead>
                    <tr>
                      <th>Cuenta</th>
                      <th>Descripcion</th>
                      <th>Documento</th>
                      <th>Debe</th>
                      <th>Haber</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(librodiario, k) in librodiario" :key="k">
                      
                      <td style="width:30%">
                        <multiselect v-model="librodiario.cuenta"
                          :options= cuentas
                          :searchable="true"
                          :selectLabel="''" 
                          :multiple="false"
                          :placeholder="'Seleccione cuenta'"
                          :preserve-search="true" 
                          :custom-label="codigodescripcion"
                          :selectedLabel="'Seleccionado'" 
                          :deselectLabel="''"
                          :noOptions="''"
                          >
                          <span slot="noResult">No existe cuenta.</span>
                        </multiselect>
                      </td>
                      <td>
                          <input class="form-control" type="text" v-model="librodiario.descripcion" />
                      </td>
                      <td>
                          <input class="form-control" type="text" v-model="librodiario.documento" />
                      </td>
                      <td>
                         <input
                            :disabled="librodiario.haber ? true:false" 
                            class="form-control text-right"
                            v-model="librodiario.debe"
                            @keyup="cuadre"
                            step=".01"
                            v-currency="null"
                            value="0" 
                          >
                          <!-- <input value="0" :disabled="librodiario.haber ? true:false" class="form-control text-right" type="number" step=".01" @keyup="cuadre" v-model="librodiario.debe"/> -->
                      </td>
                      <td>
                        <input
                            :disabled="librodiario.debe ? true:false" 
                            class="form-control text-right"
                            v-model="librodiario.haber"
                            @keyup="cuadre"
                            step=".01"
                            v-currency= null
                            value="0" 
                          >
                          <!-- <input :disabled="librodiario.debe ? true:false" value="0" class="form-control text-right" type="number" step=".01" @keyup="cuadre" v-model="librodiario.haber" /> -->
                      </td>
                      <td scope="row" class="trashIconContainer">
                          <i class="far fa-trash-alt" @click="borrarfila(k, librodiario)"></i>
                      </td>
                    </tr>

                  </tbody>
                </table>

                <button type='button' class="btn btn-primary" @click="agregarfila">
                    <i class="fas fa-plus-circle"></i>
                    Agregar
                </button>
    
              <div class="text-right">
                <button type="submit" class="btn btn-primary" @click.prevent="crearlibrodiario">Guardar</button>
              <div>
                <span class="text-danger">{{sumaigual}}</span>
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
import VueCurrencyInput from 'vue-currency-input'

export default {
  props: ['cuentas'],
  components: { Multiselect },
  data(){
    return{
      librodiario: [{
          cuenta: '',
          descripcion: '',
          documento: '',
          debe: 0,
          haber: 0,
      }],
      sumaigual: '',
      errors: [],
    }
  },
  created(){
     this.agregarfila();
  },
  methods:{
    borrarfila(index, librodiario) {
        var idx = this.librodiario.indexOf(librodiario);
        if (idx > -1) {
            this.librodiario.splice(idx, 1);
        }
        this.cuadre();
    },
    agregarfila() {
        this.librodiario.push({
            cuenta: '',
            descripcion: '',
            documento: '',
            debe: 0,
            haber: 0,
        });
    },
    codigodescripcion ({ codigo_cta, descripcion}) {
        return `${codigo_cta} ${descripcion}` 
    },
    cuadre(){
          var sumadebe = 0;
          var sumahaber = 0;
          this.librodiario.forEach(function(fila, index){
          // console.log(fila);
            // if(fila.debe != "")
            // {
              sumadebe += parseFloat(fila.debe);
            // }
            // if(fila.haber != "")
            // {
              sumahaber += parseFloat(fila.haber);
            // }
          });
              console.log(sumadebe);
              console.log(sumahaber);
            if(sumahaber != sumadebe){
              console.log('no igala');
              this.sumaigual = 'el cuadre no iguala';
            }
            else
              this.sumaigual = '';
    },
    crearlibrodiario()
    {
      this.errors = [];
      let formData = new FormData();
      formData.append('name', this.rol.name);
      formData.append('description', this.rol.description);
      if(this.cuenta)
      {
        formData.append('category', this.cuenta);
      }

      let arraypermisos = [];
      this.permiso.name.forEach(function(elemento){
        arraypermisos.push(elemento[0]);
      });
      formData.append('permisos', arraypermisos);
      
      axios.post('/roles/store',formData)
      .then(res => {
        let datos = res.data;
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
          if(datos)
          {
            toast.fire({
              icon: datos[1].type,
              background: datos[1].background,
              title: datos[1].title+' '+datos[1].message
            })
          }
      })
    }
  }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>