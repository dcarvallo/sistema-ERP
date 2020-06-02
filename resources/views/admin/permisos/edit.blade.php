@extends('layouts.adminlayout')
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Permisos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="{{route('permisos.index')}}">Permisos </a> </li>
              <li class="breadcrumb-item ">Editar Permiso</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
    <editarpermiso :permiso=" {{$permiso}} "/>
    </section>

@endsection