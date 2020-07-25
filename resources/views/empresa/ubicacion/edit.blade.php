@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Editar Ubicación')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('ubicaciones.index')}}">Ubicaciones</a></li>
  <li class="breadcrumb-item active">Editar Ubicación</li>
@endsection

@section('content')

  <section class="content mb-4" id="app">
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body ">
    
      <form action="{{route('ubicaciones.update', $ubicacion->id)}}" method="post">
        @csrf
        {{method_field('put')}}
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Ubicacion</h5>
              </div>
            <div class="card-body">
                 
              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$ubicacion->nombre}}" placeholder="Ubicacion xyz">
                @error('nombre')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="descripcion">Descripcion*</label>
                <textarea type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Descripción">{{$ubicacion->descripcion}}</textarea>
                @error('descripcion')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="locacion">Locacion*</label>
                <input type="text" class="form-control @error('locacion') is-invalid @enderror" name="locacion" value="{{$ubicacion->locacion}}" placeholder="Locacion">
                @error('locacion')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>

            </div>
          </div>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        
        </div>
      </form>
    
      </div>
    </div>
  </section>

@endsection

@section('js-footer')
  @if(Session::has('toast'))
  <script>
    var variable = {!! json_encode(Session::get('toast')) !!}
    swal.fire({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      icon: variable.type,
      background: '#e1f6d0',
      title: variable.title+' '+variable.message,
      timerProgressBar: true,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
      }
    })
    </script>
  @endif
@endsection