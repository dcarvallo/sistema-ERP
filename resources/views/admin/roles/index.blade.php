@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-user-tag"></i>
@endsection

@section('vista', 'Roles')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')

<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body ">

      <roles></roles>

    </div>
  </div>
</section>

@endsection