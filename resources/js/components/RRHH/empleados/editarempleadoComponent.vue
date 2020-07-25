<template>
<div>

  <form enctype="multipart/form-data" @keydown.enter.prevent>
  <div class="d-flex justify-content-between">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link border border-primary border-bottom-0 active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Informacion</a>
        <a class="nav-item nav-link border border-primary border-bottom-0" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Otros</a>
      </div>
    </nav>
    <div class="text-right">
      <button type="submit" class="btn btn-primary" @click.prevent="editarempleado"><i class="far fa-save"></i> Guardar</button>
    </div>
  </div>
<hr>
<div class="tab-content" id="nav-tabContent">
    <div style="min-height:50vh" class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="card">
        <div class="card-header">
            <h5>Información de empleado</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label for="empleado_id">ID de Empleado*</label>
                <input type="text" class="form-control" name="empleado_id" v-model="empleadomod.empleado_id" placeholder="Empleado id" autofocus>
                <div v-if="errors.empleado_id" class="alert-danger">{{ errors.empleado_id[0] }}</div> 
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="ap_paterno">Apellido Paterno*</label>
                  <input type="text" class="form-control" name="ap_paterno" v-model="empleadomod.ap_paterno" placeholder="Ap. Paterno">
                  <div v-if="errors.ap_paterno" class="alert-danger">{{ errors.ap_paterno[0] }}</div> 
                </div>
                <div class="col-md-6">
                  <label for="ap_materno">Apellido Materno*</label>
                  <input type="text" class="form-control" name="ap_materno" v-model="empleadomod.ap_materno" placeholder="Ap. Materno">
                  <div v-if="errors.ap_materno" class="alert-danger">{{ errors.ap_materno[0] }}</div> 
                </div>
              </div>
              <div class="form-group">
                <label for="nombres">Nombres*</label>
                <input type="text" class="form-control" name="nombres" v-model="empleadomod.nombres" placeholder="Nombres" >
                <div v-if="errors.nombres" class="alert-danger">{{ errors.nombres[0] }}</div>
              </div>
              <div class="form-group">
                <label for="nacionalidad">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad" v-model="empleadomod.nacionalidad" placeholder="nacionalidad">
                <div v-if="errors.nacionalidad" class="alert-danger">{{ errors.nacionalidad[0] }}</div>
              </div>
              <div class="form-group form-row">
                <div class="col-md-8">
                  <label for="ci">CI*</label>
                  <input type="text" class="form-control" name="ci" v-model="empleadomod.ci" placeholder="CI" />
                  <div v-if="errors.ci" class="alert-danger">{{ errors.ci[0] }}</div> 
                </div>
                <div class="col-md-4">
                  <label for="lugar_exp">Lugar exp</label>
                  <select v-model="empleadomod.lugar_exp" class="form-control">
                      <option value="CH">Chuquisaca</option>
                      <option value="CO">Cochabamba</option>
                      <option value="SC">Santa Cruz</option>
                      <option value="LP">La Paz</option>
                      <option value="TJ">Tarija</option>
                      <option value="PA">Pando</option>
                      <option value="OR">Oruro</option>
                      <option value="PO">Potosí</option>
                      <option value="BE">Beni</option>
                  </select>
                  <!-- <input type="text" class="form-control" v-model="empleadomod.lugar_exp" placeholder="Lugar expedicion"  name="lugar_exp"> -->
                  <div v-if="errors.lugar_exp" class="alert-danger">{{ errors.lugar_exp[0] }}</div> 
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-5">
                  <label for="fecha_nac">Fecha nac.*</label>
                  <input type="date" class="form-control" name="fecha_nac" v-model="empleadomod.fecha_nac" placeholder="fecha_nac">
                  <div v-if="errors.fecha_nac" class="alert-danger">{{ errors.fecha_nac[0] }}</div> 
                </div>
                <div class="col-md-7">
                  <label for="lugar_nac">Lugar nac.*</label>
                  <input type="text" class="form-control" name="lugar_nac" v-model="empleadomod.lugar_nac" placeholder="lugar_nac">
                  <div v-if="errors.lugar_nac" class="alert-danger">{{ errors.lugar_nac[0] }}</div> 
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="sexo">Sexo*</label>
                  <select class="form-control" v-model="empleadomod.sexo" name="sexo">
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                  </select>
                  <div v-if="errors.sexo" class="alert-danger">{{ errors.sexo[0] }}</div> 
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="estado_civil">Estado civil</label>
                <input type="text" class="form-control" name="estado_civil" v-model="empleadomod.estado_civil" placeholder="estado_civil">
                <div v-if="errors.estado_civil" class="alert-danger">{{ errors.estado_civil[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" name="direccion" v-model="empleadomod.direccion" placeholder="direccion">
                <div v-if="errors.direccion" class="alert-danger">{{ errors.direccion[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" v-model="empleadomod.telefono" placeholder="telefono">
                <div v-if="errors.telefono" class="alert-danger">{{ errors.telefono[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" v-model="empleadomod.email" placeholder="email">
                <div v-if="errors.email" class="alert-danger">{{ errors.email[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="religion">Religion</label>
                <input type="text" class="form-control" name="religion" v-model="empleadomod.religion" placeholder="religion">
                <div v-if="errors.religion" class="alert-danger">{{ errors.religion[0] }}</div> 
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="altura">Altura</label>
                  <input type="text" class="form-control" name="altura" v-model="empleadomod.altura" placeholder="altura">
                  <div v-if="errors.altura" class="alert-danger">{{ errors.altura[0] }}</div> 
                </div>
                <div class="col-md-4">
                  <label for="peso">Peso</label>
                  <input type="text" class="form-control" name="peso" v-model="empleadomod.peso" placeholder="peso">
                  <div v-if="errors.peso" class="alert-danger">{{ errors.peso[0] }}</div> 
                </div>
                <div class="col-md-4">
                  <label for="tipo_sangre">Tipo_sangre</label>
                  <input type="text" class="form-control" name="tipo_sangre" v-model="empleadomod.tipo_sangre" placeholder="tipo_sangre">
                  <div v-if="errors.tipo_sangre" class="alert-danger">{{ errors.tipo_sangre[0] }}</div> 
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_contrato">Fecha contrato*</label>
                <input type="date" class="form-control" name="fecha_contrato" v-model="empleadomod.fecha_contrato" placeholder="fecha_contrato">
                <div v-if="errors.fecha_contrato" class="alert-danger">{{ errors.fecha_contrato[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="tipo_contrato">Tipo contrato*</label>
                <input type="text" class="form-control" name="tipo_contrato" v-model="empleadomod.tipo_contrato" placeholder="tipo_contrato">
                <div v-if="errors.tipo_contrato" class="alert-danger">{{ errors.tipo_contrato[0] }}</div> 
              </div>

              <div class="form-group">
                <label>Cargo*</label>
                
               <multiselect v-model="empleadomod.cargo_id"
                :options= cargos
                :searchable="true" 
                id="cargo"
                :placeholder="'Seleccione Cargo'" 
                :selectLabel="''" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                label="nombre"
                >
                <span slot="noResult">No existe cargos.</span>
                </multiselect>
                <div class="alert-danger" v-if="errors.cargo_id" >{{errors.cargo_id[0]}}</div>
              </div>
              <!-- <div class="form-group">
                <label for="">Fotografia</label>
                <div class="text-center">
                    <img :src="enlace" class="img" style="width: 15em" alt="Imagen de empleado">
                  </div>
                  <br>
                  <input type="file" @change="onFileChange" class="form-control" name="imagen" accept="image/*"/>
                  <div v-if="errors.imagen" class="alert-danger">{{ errors.imagen[0] }}</div> 
              </div> -->
              <div class="form-group row justify-content-center border rounded bg-olive py-2 mx-2">
                <div class="col-md-12 text-center">
                  <h2 class="text-center" for="">Estado actual del empleado</h2>
                </div>
                <div class="col-md-4 col-auto justify-content-center">
                  <select class="form-control" v-model="empleadomod.estado" name="estado">
                    <option value="Alta">Alta</option>
                    <option value="Baja">Baja</option>
                  </select>
                  <div v-if="errors.estado" class="alert-danger">{{ errors.estado[0] }}</div> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        

    </div>
    
    <div style="min-height:50vh" class="tab-pane fade show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      test
    </div>

</div>
  </form>
    
</div>
</template>

<script>
import Multiselect from 'vue-multiselect'
export default {
  components: { Multiselect },
  props: ['cargos', 'empleado'],
  data(){
    return{
      value: null,
      empleadomod: this.empleado,
      enlace: '/storage/usuariodef/avatar.png',
      errors: [],
    }
  },
  created() {
    this.cargos.forEach((column) => {
    if(column.id == this.empleado.cargo_id){
      this.empleadomod.cargo_id = column;
    }
  });
  },
  methods:{
    onFileChange(e) {
      this.empleado.imagen = e.target.files[0];
      this.enlace = URL.createObjectURL(this.empleado.imagen );
    },
    editarempleado()
    {
      let formData = new FormData();
      formData.append('empleado_id', this.empleadomod.empleado_id);
      formData.append('nombres', this.empleadomod.nombres);
      formData.append('ap_paterno', this.empleadomod.ap_paterno);
      formData.append('ap_materno', this.empleadomod.ap_materno);
      formData.append('nacionalidad', this.empleadomod.nacionalidad);
      formData.append('ci', this.empleadomod.ci);
      formData.append('lugar_exp', this.empleadomod.lugar_exp);
      formData.append('direccion', this.empleadomod.direccion);
      formData.append('fecha_nac', this.empleadomod.fecha_nac);
      formData.append('lugar_nac', this.empleadomod.lugar_nac);
      formData.append('sexo', this.empleadomod.sexo);
      formData.append('estado_civil', this.empleadomod.estado_civil);
      formData.append('telefono', this.empleadomod.telefono);
      formData.append('email', this.empleadomod.email);
      formData.append('religion', this.empleadomod.religion);
      if(this.empleadomod.altura){
        formData.append('altura', this.empleadomod.altura);
      }
      if(this.empleadomod.peso){
        formData.append('peso', this.empleadomod.peso);
      }
      formData.append('tipo_sangre', this.empleadomod.tipo_sangre);
      formData.append('fotografia', this.empleadomod.fotografia);
      formData.append('fecha_contrato', this.empleadomod.fecha_contrato);
      formData.append('tipo_contrato', this.empleadomod.tipo_contrato);
      formData.append('estado', this.empleadomod.estado);
      if(this.empleadomod.cargo_id){
        formData.append('cargo_id', this.empleadomod.cargo_id.id);
      }
      formData.append('_method', 'put');
      axios.post('/empleados/'+this.empleadomod.id, formData)
      .then(res => {
        let datos = res.data;
        this.errors = [];
        toast.fire({
          icon: datos[1].type,
          background: datos[1].background,
          title: datos[1].title+' '+datos[1].message
        })
      })
      .catch(error => {
        let datos = error.data;
        if(datos){
          toast.fire({
            icon: datos[1].type,
            background: datos[1].background,
            title: 'Error, revise: '.error
          })
        }
        if(error.response.status == 422){
          this.errors = error.response.data.errors;
            toast.fire({
              icon: 'error',
              background: '#edc3c3',
              title: 'Error en formulario, revise'
            })
          }
          if(error.response.status == 500){
            toast.fire({
              icon: 'error',
              background: '#edc3c3',
              title: 'error contacte con administrador'
            })
          }
      })
    }
  }
}
</script>