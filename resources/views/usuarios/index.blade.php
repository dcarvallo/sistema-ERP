@extends('layouts.adminlayout')

@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Usuarios /</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section>
    
    <usuarios></usuarios>
    
  </section>
  
  @endsection
  @section('js-footer')
  @if( Session::has("mensaje") )
  <script>
    
    var tipo = [
      '{{ Session::get('mensaje.type') }}',
      '{{ Session::get('mensaje.message') }}',
      '{{ Session::get('mensaje.title') }}'
    ];

    toast.fire({
      icon: tipo[0],
      text: tipo[1],
      title: tipo[2],
      // background: 'green',
    });
     
  </script>
  @endif
@endsection