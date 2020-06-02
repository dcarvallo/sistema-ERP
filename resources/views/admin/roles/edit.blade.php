@extends('layouts.adminlayout')
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Roles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{route('roles.index')}}">Roles </a> </li>
              <li class="breadcrumb-item ">Editar Rol</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
    <editarrol :rol="{{ $rol }}" :permisos=" {{json_encode($permisos)}} " :permisosseleccionados="{{$rol->permissions}}"/>
    </section>

@endsection