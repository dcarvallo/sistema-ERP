@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-user-tie"></i>
@endsection

@section('vista', 'Ver Cargo')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('cargos.index')}}">Cargo</a></li>
  <li class="breadcrumb-item active">Mostrar Cargo</li>
@endsection

@section('content')

  <section class="content mb-4">
    
    <div class="card card-solid">
      <div class="card-body ">
    
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Cargo</h5>
              </div>
            <div class="card-body">
              <div>
                <p class="mb-0">{{$cargo->nombre}}</p>
                <hr class="my-0">
                <label><strong>Nombre</strong> </label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$cargo->descripcion}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Descripción</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$cargo->area->nombre}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Área</label>
              </div>
              

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection