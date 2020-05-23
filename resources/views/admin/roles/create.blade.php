@extends('layouts.adminlayout')
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Roles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{route('roles.index')}}">Roles </a> </li>
              <li class="breadcrumb-item ">Crear Rol</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
      <crearrol :permisos="{{$permisos}}"/>
    </section>

@endsection