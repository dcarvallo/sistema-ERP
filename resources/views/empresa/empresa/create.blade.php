@extends('layouts.adminlayout')
@section('css-head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('icono')
  <i class="far fa-building"></i>
@endsection

@section('vista', 'Crear empresa')

@section('breadcrumb')  
  <li class="breadcrumb-item"><a href="{{route('empresas.index')}}">Empresa</a></li>
  <li class="breadcrumb-item active">Crear empresa</li>
@endsection

@section('content')

    <section class="content mb-4" id="app">
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body ">
     
        <form action="{{route('empresas.store')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                   <h5>Información Principal</h5>
                </div>
              <div class="card-body">
               <div class="form-group">
                 <label for="nombre">Nombre de Empresa*</label>
                 <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Empresa xyz">
                 @error('nombre')<div class="alert-danger">{{ $message }}</div> @enderror
               </div>
               <div class="form-group">
                 <label for="descripcion">Descripción*</label>
                 <textarea type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" placeholder="Descripción">{{ old('descripcion') }}</textarea>
                 @error('descripcion')<div class="alert-danger">{{ $message }}</div> @enderror
               </div>
               <div class="form-group">
                 <label for="rubro">Rubro*</label>
                 <input type="text" class="form-control @error('rubro') is-invalid @enderror" name="rubro" value="{{ old('rubro') }}" placeholder="Rubro de la empresa">
                 @error('rubro')<div class="alert-danger">{{ $message }}</div> @enderror
               </div>
               <div class="form-group">
                <label for="nit">NIT*</label>
                <input type="number" class="form-control @error('nit') is-invalid @enderror" name="nit" value="{{ old('nit') }}" placeholder="NIT de la empresa">
                @error('nit')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
              <div class="form-group">
                <label for="propietario">Propietario*</label>
                <input type="text" class="form-control @error('propietario') is-invalid @enderror" name="propietario" value="{{ old('propietario') }}" placeholder="Propietario de la empresa">
                @error('propietario')<div class="alert-danger">{{ $message }}</div> @enderror
              </div>
               <div class="form-group">
                 <label for="mision">Misión</label>
                 <textarea type="text" class="form-control" @error('mision') is-invalid @enderror name="mision" placeholder="Misión">{{ old('descripcion') }}</textarea>
               </div>
               <div class="form-group">
                 <label for="vision">Visión</label>
                 <textarea type="text" class="form-control"@error('vision') is-invalid @enderror name="vision" placeholder="Visión">{{ old('descripcion') }}</textarea>
               </div>
             </div>
             </div>
           </div>
           <div class="col-md-6">
             <div class="card">
               <div class="card-header">
                   <h5>Información de Contacto</h5>
                </div>
             <div class="card-body">
             <div class="form-group">
               <label for="nombre">Dirección*</label>
               <input type="text" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ old('direccion') }}" placeholder="Nombre de la calle">
               @error('direccion')<div class="alert-danger">{{ $message }}</div> @enderror
             </div>
             <div class="form-group col-md-5 px-0">
               <label for="nombre">Teléfonos</label>
               <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" placeholder="Teléfono">
             </div>
             <div class="form-group">
               <label for="nombre">Email</label>
               <input type="text" class="form-control" @error('email') is-invalid @enderror name="email" value="{{ old('email') }}" placeholder="Email" >
               @error('email')<div class="alert-danger">{{ $message }}</div> @enderror
             </div>
             <div class="form-group col-md-5 px-0">
               <label for="fecha_creacion">Fecha de Creación de la Empresa*</label>
               <input type="date" class="form-control @error('fecha_creacion') is-invalid @enderror" name="fecha_creacion" value="{{ old('fecha_creacion') }}">
               @error('fecha_creacion')<div class="alert-danger">{{ $message }}</div> @enderror
             </div>
             <div class="form-group col-md-12 px-0">
               <label for="fecha_creacion">Imagen de la Empresa</label>
               <input type="file" class="form-control" @error('imagen_empresa') is-invalid @enderror name="imagen_empresa" value="{{ old('imagen_empresa') }}">
             </div>
             </div>
             
       
           </div>
              </div>
           <button type="submit" class="btn btn-primary">Crear</button>
       <!-- </form> -->
          
         </div>
          {{-- <empresacreate/> --}}
        </form>
     
        </div>
      </div>
    </section>


@endsection