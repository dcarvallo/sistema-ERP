@extends('layouts.adminlayout')

@section('icono')
  <i class="far fa-check-square"></i>
@endsection

@section('vista', 'Permisos')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Permisos /</li>
@endsection

@section('content')

    <section>
      <permisos
      />
    </section>

@endsection