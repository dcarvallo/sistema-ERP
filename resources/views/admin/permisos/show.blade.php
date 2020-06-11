@extends('layouts.adminlayout')

@section('icono')
  {{-- <i class="fas fa-user-tie"></i> --}}
@endsection

@section('vista', 'Ver Permiso')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('permisos.index')}}">Permisos</a></li>
  <li class="breadcrumb-item active">Mostrar Permiso</li>
@endsection

@section('content')

  <section class="content mb-4">
    
    <div class="card card-solid">
      <div class="card-body ">
    
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <h5>Información del Permiso</h5>
              </div>
            <div class="card-body">
              <div>
                <p class="mb-0">{{$permiso->name}}</p>
                <hr class="my-0">
                <label>Nombre </label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$permiso->description}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Descripción</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$permiso->category}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Categoria</label>
              </div>
              

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection