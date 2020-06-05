@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-house-user"></i>
@endsection

@section('vista', 'Inicio')

@section('breadcrumb')  
  <li class="breadcrumb-item active"></li>
@endsection

@section('content')

<section>
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        Home
      </div>
      <div class="card-body">
        <h5 class="card-title">Title</h5>
        <p class="card-text">Content</p>
      </div>
    </div>
  </div>  
</section>
@endsection
