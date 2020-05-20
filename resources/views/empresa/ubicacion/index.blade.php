@extends('layouts.adminlayout')
@section('content')

    <div>
        <ubicaciones/>
    </div>

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