<template>
<div>
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Información</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Roles</a>
    </div>
  </nav>

<hr>
<div class="tab-content" id="nav-tabContent">
    <div style="min-height:50vh" class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
   <div class="row" >
      <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h5>Informacion General</h5>
                </div>
              <div class="card-body">
                <div>
                  <p class="mb-0"> {{empleado.empleado_id ? empleado.empleado_id : 'N/A'}}  </p>
                  <hr class="my-0">
                  <label>Empleado id</label>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <p class="mb-0"> {{empleado.ap_paterno ? empleado.ap_paterno : 'N/A'}}  </p>
                    <hr class="my-0">
                    <label>Apellido Paterno</label>
                  </div>
                  <div class="col-md-6">
                    <p class="mb-0"> {{empleado.ap_materno ? empleado.ap_materno : 'N/A'}}  </p>
                    <hr class="my-0">
                    <label>Apellido Materno</label>
                  </div>
                </div>
                <div>
                  <p class="mb-0"> {{empleado.nombres ? empleado.nombres : 'N/A'}}  </p>
                  <hr class="my-0">
                  <label>Nombres</label>
                </div>
                <div>
                  <p class="mb-0"> {{empleado.nacionalidad ? empleado.nacionalidad : 'N/A'}}  </p>
                  <hr class="my-0">
                  <label>Nacionalidad</label>
                </div>
                <div class="row">
                  <div class="col-md-7">
                    <p class="mb-0"> {{empleado.ci ? empleado.ci : 'N/A'}}  </p>
                    <hr class="my-0">
                    <label>CI</label>
                  </div>
                  <div class="col-md-5">
                    <p class="mb-0"> {{empleado.lugar_exp ? empleado.lugar_exp : 'N/A'}}  </p>
                    <hr class="my-0">
                    <label>Lugar Expedicion</label>
                  </div>
                </div>
                
                <div>
                  <p class="mb-0"> {{empleado.fecha_nac ? empleado.fecha_nac : 'N/A'}}  </p>
                  <hr class="my-0">
                  <label for="username">Fecha nacimiento</label>
                </div>

                <div>
                  <p class="mb-0"> {{empleado.lugar_nac ? empleado.lugar_nac : 'N/A'}}  </p>
                  <hr class="my-0">
                  <label for="username">Lugar Nacimiento</label>
                </div>

                <div>
                  <p class="mb-0"> {{empleado.sexo ? empleado.sexo : 'N/A'}}  </p>
                  <hr class="my-0">
                  <label for="username">Sexo</label>
                </div>
                
                
             </div>
            </div>
           
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h5>Información Específica</h5>
            </div>
          <div class="card-body">
            <div>
              <p class="mb-0"> {{empleado.estado_civil ? empleado.estado_civil : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="username">Estado Civil</label>
            </div>
            <div>
              <p class="mb-0"> {{empleado.telefono ? empleado.telefono : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="username">Teléfono</label>
            </div>
            <div>
              <p class="mb-0"> {{empleado.direccion ? empleado.direccion : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="direccion">Dirección</label>
            </div>
            <div>
              <p class="mb-0"> {{empleado.email ? empleado.email : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="username">Email</label>
            </div>
            <div>
              <p class="mb-0"> {{empleado.religion ? empleado.religion : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="username">Religion</label>
            </div>
            <div class="row">
              <div class="col-md-4">
                <p class="mb-0"> {{empleado.altura ? empleado.altura : 'N/A'}}  </p>
                <hr class="my-0">
                <label for="username">Altura</label>
              </div>
              <div class="col-md-4">
                <p class="mb-0"> {{empleado.peso ? empleado.peso : 'N/A'}}  </p>
                <hr class="my-0">
                <label for="username">Peso</label>
              </div>
              <div class="col-md-4">
                <p class="mb-0"> {{empleado.tipo_sangre ? empleado.tipo_sangre : 'N/A'}}  </p>
                <hr class="my-0">
                <label for="username">Tipo Sangre</label>
              </div>
            </div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h5>Información empleado</h5>
            </div>
          <div class="card-body">
            <div>
              <p class="mb-0"> {{empleado.fecha_contrato ? empleado.fecha_contrato : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="username">Fecha_contrato</label>
            </div>
            <div>
              <p class="mb-0"> {{empleado.tipo_contrato ? empleado.tipo_contrato : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="username">Tipo Contrato</label>
            </div>
            <div>
              <p class="mb-0"> {{empleado.cargo_id ? empleado.cargo.nombre : 'N/A'}}  </p>
              <hr class="my-0">
              <label for="username">Cargo</label>
            </div>
            <div class="form-group col-md-12 px-0">
              <label for="fotografia">Fotografía de empleado</label><br>
              <div class="text-center">
              <img :src="empleado.fotografia" class="img" style="width: 15em" alt="Imagen de empleado">
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>



    </div>



  </div>
  </div>
</template>

<script>

export default {
  props: ['empleado'],
  data(){
    return{

    }
  },
  
}
</script>