@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-users"></i>
@endsection

@section('vista', 'Usuarios')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Usuarios /</li>
@endsection

@section('content')

  <section class="content mb-4">
    <div class="card card-solid">
      <div class="card-body ">
   
        <usuarios></usuarios>
   
      </div>
    </div>
  </section>
  
@endsection