@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-user-tie"></i>
@endsection

@section('vista', 'Cargos')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Cargos</li>
@endsection

@section('content')

  <section>
    <cargos/>
  </section>
    
@endsection
