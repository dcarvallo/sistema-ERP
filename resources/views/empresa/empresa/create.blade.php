@extends('layouts.adminlayout')
@section('css-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

  <div class="content-wrapper">

       <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Datos de Empresa</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('empresas.index')}}">Empresa</a></li>
              <li class="breadcrumb-item active">Crear Empresa</li>
            </ol>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
    <section class="content mb-4" id="app">
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body ">
     
        <form action="{{route('empresas.store')}}" method="post">
          @csrf
        <empresacreate/>
        </form>
     
        </div>
      </div>
    </section>

  </div>

@endsection