@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Ubicaciones')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Ubicaciones</li>
@endsection

@section('content')

  <section>
    <ubicaciones/>
  </section>
    
@endsection
