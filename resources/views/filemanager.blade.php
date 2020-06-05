@extends('layouts.adminlayout')
@section('css-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/css/file-manager.css') }}">
@endsection

@section('icono')
  <i class="far fa-folder"></i>
@endsection

@section('vista', 'Administración de Archivos')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Archivos /</li>
@endsection

@section('content')

  <div style="height: 600px;">
    <div id="fm"></div>
  </div>

@endsection

@section('js-footer')
<script src="{{ asset('/js/file-manager.js') }}"></script>
@endsection