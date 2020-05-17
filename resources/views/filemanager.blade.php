@extends('layouts.adminlayout')
@section('css-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/css/file-manager.css') }}">
@endsection
@section('content')

  <div class="content-wrapper">
    <div style="height: 600px;">
      <div id="fm"></div>
    </div>
  </div>

@endsection

@section('js-footer')
<script src="{{ asset('/js/file-manager.js') }}"></script>
@endsection