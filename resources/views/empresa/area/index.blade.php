@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Áreas')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Áreas</li>
@endsection

@section('content')

  <section>
    <areas/>
  </section>
    
@endsection
