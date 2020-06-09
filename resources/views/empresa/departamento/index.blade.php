@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Departamentos')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Departamentos</li>
@endsection

@section('content')

  <section>
    <departamentos/>
  </section>
    
@endsection
