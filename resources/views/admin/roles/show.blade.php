@extends('layouts.adminlayout')

@section('icono')
  {{-- <i class="fas fa-user-tie"></i> --}}
@endsection

@section('vista', 'Ver Rol')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
  <li class="breadcrumb-item active">Mostrar Rol</li>
@endsection

@section('content')

  <section class="content mb-4">
    
    <div class="card card-solid">
      <div class="card-body ">
    
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <h5>Información del Rol</h5>
              </div>
            <div class="card-body">
              <div>
                <p class="mb-0">{{$role->name}}</p>
                <hr class="my-0">
                <label>Nombre </label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$role->description}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Descripción</label>
              </div>
              <br>
              <div>
                <p class="mb-0">{{$role->category}}</p>
                <hr class="my-0">
                <label class="" for="nombre">Categoria</label>
              </div>
              <hr>
              <div>
                <label class="" for="nombre">Permisos</label>
                <ul>
                  @foreach($permisos as $permiso)  
                    <li><strong>{{$permiso->name}}</strong>    - {{$permiso->description}}</li>
                  @endforeach
                </ul>
              </div>

            </div>
          </div>
        </div>
          
        </div>
    
      </div>
    </div>
  </section>

@endsection