@extends('layouts.adminlayout')

@section('icono')
  <i class="far fa-check-square"></i>
@endsection

@section('vista', 'Permisos')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Permisos /</li>
@endsection

@section('content')

    <section class="content mb-4">
      <div class="card card-solid">
        <div class="card-body pt-1">
          <permisos/>
        </div>
      </div>
    </section>

@endsection