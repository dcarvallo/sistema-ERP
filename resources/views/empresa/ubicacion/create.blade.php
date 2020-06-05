@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-search-location"></i> 
@endsection

@section('vista', 'Crear Ubición')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('ubicaciones.index')}}">Ubicaciones</a></li>
  <li class="breadcrumb-item active">Crear Ubicacion</li>
@endsection

@section('content')

  <section class="content mb-4" id="app">
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body ">
    
      <form action="{{route('ubicaciones.store')}}" method="post">
        @csrf
        <div class="form-row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h5>Información de Ubicacion</h5>
              </div>
            <div class="card-body">
              {{-- @if($empresas != null) --}}

              <div class="form-group">
                <label for="nombre">Nombre*</label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Ubicacion xyz">
                @error('nombre')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="descripcion">Descripcion*</label>
                <textarea type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Descripción">{{ old('descripcion') }}</textarea>
                @error('descripcion')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="locacion">Locacion*</label>
                <input type="text" class="form-control @error('locacion') is-invalid @enderror" name="locacion" value="{{ old('locacion') }}" placeholder="Locacion">
                @error('locacion')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              
              {{-- @endif --}}

            </div>
          </div>
          <button type="submit" class="btn btn-primary">Crear</button>
        </div>
          
      <!-- </form> -->
        
        </div>
        {{-- <empresacreate/> --}}
      </form>
    
      </div>
    </div>
  </section>

@endsection