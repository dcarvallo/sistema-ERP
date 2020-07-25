@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Crear Ubicación')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('ubicaciones.index')}}">Ubicaciones</a></li>
  <li class="breadcrumb-item active">Crear Ubicación</li>
@endsection

@section('content')

  <section class="content mb-4">
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body ">
    
      <form action="{{route('ubicaciones.store')}}" method="post">
        @csrf
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Ubicación</h5>
              </div>
            <div class="card-body">

              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Ubicacion xyz">
                @error('nombre')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción*</label>
                <textarea type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Descripción">{{ old('descripcion') }}</textarea>
                @error('descripcion')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="locacion">Locación*</label>
                <input type="text" class="form-control @error('locacion') is-invalid @enderror" name="locacion" value="{{ old('locacion') }}" placeholder="Locacion">
                @error('locacion')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>

            </div>
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
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
      showConfirmButton: false,
      position: 'top',
      background: '#e1f6d0',
      icon: variable.type,
      title: variable.title+' '+variable.message,
      timer: 5000,
      onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
      }
    })
    </script>
  @endif
@endsection