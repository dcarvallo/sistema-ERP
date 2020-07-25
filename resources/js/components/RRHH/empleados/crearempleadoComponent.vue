<template>
<div>

  <form enctype="multipart/form-data" @keydown.enter.prevent>
  <div class="d-flex justify-content-between">
    <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link border border-dark border-bottom-0 active" id="informacion-tab" data-toggle="tab" href="#informacion" role="tab" aria-controls="informacion" aria-selected="true">Información personal</a>
        <a class="nav-item nav-link border border-dark border-bottom-0" id="familiares-tab" data-toggle="tab" href="#familiares" role="tab" aria-controls="familiares" aria-selected="false">Familiares</a>
        <a class="nav-item nav-link border border-dark border-bottom-0" id="curriculum-tab" data-toggle="tab" href="#curriculum" role="tab" aria-controls="curriculum" aria-selected="false">Curriculum</a>
        <a class="nav-item nav-link border border-dark border-bottom-0" id="historico-tab" data-toggle="tab" href="#historico" role="tab" aria-controls="historico" aria-selected="false">Histórico</a>
      </div>
    </nav>
    <div class="text-right">
      <button type="submit" class="btn btn-primary" @click.prevent="crearempleado"><i class="far fa-save"></i> Guardar</button>
    </div>
  </div>
<hr>
<div class="tab-content" id="nav-tabContent">
    <div style="min-height:50vh" class="tab-pane fade show active" id="informacion" role="tabpanel" aria-labelledby="informacion-tab">
      <div class="card">
        <div class="card-header">
            <h5>Información de empleado</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">

              <div class="form-group">
                <label for="empleado_id">ID de Empleado <span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" name="empleado_id" v-model="empleado.empleado_id" placeholder="Empleado id"  autofocus>
                <div v-if="errors.empleado_id" class="alert-danger">{{ errors.empleado_id[0] }}</div> 
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="ap_paterno">Apellido Paterno <span class="text-danger">(*)</span></label>
                  <input type="text" class="form-control" name="ap_paterno" v-model="empleado.ap_paterno" placeholder="Ap. Paterno" >
                  <div v-if="errors.ap_paterno" class="alert-danger">{{ errors.ap_paterno[0] }}</div> 
                </div>
                <div class="col-md-6">
                  <label for="ap_materno">Apellido Materno <span class="text-danger">(*)</span></label>
                  <input type="text" class="form-control" name="ap_materno" v-model="empleado.ap_materno" placeholder="Ap. Materno" >
                  <div v-if="errors.ap_materno" class="alert-danger">{{ errors.ap_materno[0] }}</div> 
                </div>
              </div>
              <div class="form-group">
                <label for="nombres">Nombres <span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" name="nombres" v-model="empleado.nombres" placeholder="Nombres" >
                <div v-if="errors.nombres" class="alert-danger">{{ errors.nombres[0] }}</div>
              </div>
              <div class="form-group">
                <label for="nacionalidad">Nacionalidad</label>
                <input type="text" class="form-control" name="nacionalidad" v-model="empleado.nacionalidad" placeholder="nacionalidad">
                <div v-if="errors.nacionalidad" class="alert-danger">{{ errors.nacionalidad[0] }}</div>
              </div>
              <div class="form-group form-row">
                <div class="col-md-8">
                  <label for="ci">CI <span class="text-danger">(*)</span></label>
                  <input type="text" class="form-control" name="ci" v-model="empleado.ci" placeholder="CI" />
                  <div v-if="errors.ci" class="alert-danger">{{ errors.ci[0] }}</div> 
                </div>
                <div class="col-md-4">
                  <label for="lugar_exp">Lugar exp</label>
                  <select v-model="empleado.lugar_exp" class="form-control">
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
                  <!-- <input type="text" class="form-control" v-model="empleado.lugar_exp" placeholder="Lugar expedicion"  name="lugar_exp"> -->
                  <div v-if="errors.lugar_exp" class="alert-danger">{{ errors.lugar_exp[0] }}</div> 
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-5">
                  <label for="fecha_nac">Fecha nac. <span class="text-danger">(*)</span></label>
                  <input type="date" class="form-control" name="fecha_nac" v-model="empleado.fecha_nac" placeholder="fecha_nac" >
                  <div v-if="errors.fecha_nac" class="alert-danger">{{ errors.fecha_nac[0] }}</div> 
                </div>
                <div class="col-md-7">
                  <label for="lugar_nac">Lugar nac. <span class="text-danger">(*)</span></label>
                  <input type="text" class="form-control"  name="lugar_nac" v-model="empleado.lugar_nac" placeholder="lugar_nac" >
                  <div v-if="errors.lugar_nac" class="alert-danger">{{ errors.lugar_nac[0] }}</div> 
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="sexo">Sexo <span class="text-danger">(*)</span></label>
                  <select class="form-control" v-model="empleado.sexo" >
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
                <input type="text" class="form-control" name="estado_civil" v-model="empleado.estado_civil" placeholder="estado_civil">
                <div v-if="errors.estado_civil" class="alert-danger">{{ errors.estado_civil[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" name="direccion" v-model="empleado.direccion" placeholder="direccion">
                <div v-if="errors.direccion" class="alert-danger">{{ errors.direccion[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" v-model="empleado.telefono" placeholder="telefono">
                <div v-if="errors.telefono" class="alert-danger">{{ errors.telefono[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" v-model="empleado.email" placeholder="email">
                <div v-if="errors.email" class="alert-danger">{{ errors.email[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="religion">Religión</label>
                <input type="text" class="form-control" name="religion" v-model="empleado.religion" placeholder="religion">
                <div v-if="errors.religion" class="alert-danger">{{ errors.religion[0] }}</div> 
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                  <label for="altura">Altura</label>
                  <input type="text" class="form-control" name="altura" v-model="empleado.altura" placeholder="altura">
                  <div v-if="errors.altura" class="alert-danger">{{ errors.altura[0] }}</div> 
                </div>
                <div class="col-md-4">
                  <label for="peso">Peso</label>
                  <input type="text" class="form-control" name="peso" v-model="empleado.peso" placeholder="peso">
                  <div v-if="errors.peso" class="alert-danger">{{ errors.peso[0] }}</div> 
                </div>
                <div class="col-md-4">
                  <label for="tipo_sangre">Tipo_sangre</label>
                  <input type="text" class="form-control" name="tipo_sangre" v-model="empleado.tipo_sangre" placeholder="tipo_sangre">
                  <div v-if="errors.tipo_sangre" class="alert-danger">{{ errors.tipo_sangre[0] }}</div> 
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="fecha_contrato">Fecha contrato <span class="text-danger">(*)</span></label>
                <input type="date" class="form-control" name="fecha_contrato" v-model="empleado.fecha_contrato" placeholder="fecha_contrato" >
                <div v-if="errors.fecha_contrato" class="alert-danger">{{ errors.fecha_contrato[0] }}</div> 
              </div>
              <div class="form-group">
                <label for="tipo_contrato">Tipo contrato <span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" name="tipo_contrato" v-model="empleado.tipo_contrato" placeholder="tipo_contrato" >
                <div v-if="errors.tipo_contrato" class="alert-danger">{{ errors.tipo_contrato[0] }}</div> 
              </div>
              <div class="form-group">
                <label>Cargo <span class="text-danger">(*)</span></label>
                <!-- <div :class="{ 'invalid': isInvalid }"> -->
               <multiselect v-model="empleado.cargo_id"
                :options= cargos
                :searchable="true" 
                id="cargo"
                :allow-empty="false"
                :placeholder="'Seleccione Cargo'" 
                :selectLabel="''" 
                :selectedLabel="'Seleccionado'" 
                :deselectLabel="''"
                :noOptions="''"
                label="nombre"
                >
                <span slot="noResult">No existe cargos.</span>
                </multiselect>
                <!-- </div> -->
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
              
            </div>
          </div>
          <p class="text-danger"> (*) Campos obligatorios  </p>
        </div>
      </div>
        

    </div>
    
      <div style="min-height:50vh" class="tab-pane fade show" id="familiares" role="tabpanel" aria-labelledby="familiares-tab">
        <div class="card">
          <div class="card-header">
              <h5>Familiares de empleado</h5>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h4>Padre</h4>
                <div class="form-group">
                  <label for="nombres">Nombre <span class="text-danger">(*)</span></label>
                  <input type="text" class="form-control" name="nombres" v-model="empleado.nombres" placeholder="Nombres" >
                  <div v-if="errors.nombres" class="alert-danger">{{ errors.nombres[0] }}</div>
                </div>
                <h4>Madre</h4>
                <div class="form-group">
                  <label for="nombres">Nombre <span class="text-danger">(*)</span></label>
                  <input type="text" class="form-control" name="nombres" v-model="empleado.nombres" placeholder="Nombres" >
                  <div v-if="errors.nombres" class="alert-danger">{{ errors.nombres[0] }}</div>
                </div>
              </div>
              <div class="col-md-6">
                <h4>Conyugue</h4>
                <div class="form-group">
                  <label for="nombres">Nombre <span class="text-danger">(*)</span></label>
                  <input type="text" class="form-control" name="nombres" v-model="empleado.nombres" placeholder="Nombres" >
                  <div v-if="errors.nombres" class="alert-danger">{{ errors.nombres[0] }}</div>
                </div>
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
export default {
  components: { Multiselect },
  props: ['cargos'],
  data(){
    return{
      value: null,
      enlace: '/storage/usuariodef/avatar.png',
      empleado: {
        empleado_id: '',
        nombres: '',
        ap_paterno: '',
        ap_materno: '',
        nacionalidad: '',
        ci: '',
        lugar_exp: '',
        direccion: '',
        fecha_nac: null,
        lugar_nac: '',
        sexo: '',
        estado_civil: '',
        telefono: '',
        email: '',
        religion: '',
        altura: '',
        peso: '',
        tipo_sangre: '',
        fotografia: '',
        fecha_contrato: null,
        tipo_contrato: '',
        cargo_id: 0,
      },
      familiares: {
        nombres_padre: '',
        apellidos_padre: '',
        direccion_padre: '',
        telefono_padre: '',
        nombres_madre: '',
        apellidos_madre: '',
        direccion_madre: '',
        telefono_madre: '',
        nombres_conyugue: '',
        apellidos_conyugue: '',
        ocupacion_conyugue: '',
        direccion_conyugue: '',
        telefono_conyugue: '',
      },
      errors: [],
    }
  },
  created() {
    
  },
  methods:{
    onFileChange(e) {
      this.empleado.imagen = e.target.files[0];
      this.enlace = URL.createObjectURL(this.empleado.imagen );
    },
    crearempleado()
    {
      let formData = new FormData();
      formData.append('empleado_id', this.empleado.empleado_id);
      formData.append('nombres', this.empleado.nombres);
      formData.append('ap_paterno', this.empleado.ap_paterno);
      formData.append('ap_materno', this.empleado.ap_materno);
      formData.append('nacionalidad', this.empleado.nacionalidad);
      formData.append('ci', this.empleado.ci);
      formData.append('lugar_exp', this.empleado.lugar_exp);
      formData.append('direccion', this.empleado.direccion);
      formData.append('fecha_nac', this.empleado.fecha_nac);
      formData.append('lugar_nac', this.empleado.lugar_nac);
      formData.append('sexo', this.empleado.sexo);
      formData.append('estado_civil', this.empleado.estado_civil);
      formData.append('telefono', this.empleado.telefono);
      formData.append('email', this.empleado.email);
      formData.append('religion', this.empleado.religion);
      formData.append('altura', this.empleado.altura);
      formData.append('peso', this.empleado.peso);
      formData.append('tipo_sangre', this.empleado.tipo_sangre);
      formData.append('fotografia', this.empleado.fotografia);
      formData.append('fecha_contrato', this.empleado.fecha_contrato);
      formData.append('tipo_contrato', this.empleado.tipo_contrato);
      if(this.empleado.cargo_id){
        formData.append('cargo_id', this.empleado.cargo_id.id);
      }
      axios.post('/empleados/store',formData)
      .then(res => {
        let datos = res.data;
        this.empleado = [];
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