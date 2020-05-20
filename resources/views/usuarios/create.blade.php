@extends('layouts.adminlayout')
@section('content')

  <div class="content-wrapper">

       <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Usuarios</h1>
        </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
              <li class="breadcrumb-item active">Crear Usuario</li>
            </ol>
          </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
    <section class="content mb-4" id="app">
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body ">
     
        <form action="{{route('users.store')}}" method="post">
          @csrf
          <div class="form-row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                   <h5>Información de Usuario</h5>
                </div>
              <div class="card-body">
                {{-- @if($empresas != null) --}}

                <div class="form-group">
                  <label for="name">Nombre Completo*</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nombre Completo">
                  @error('name')<div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                  <label for="username">Nombre de Usuario*</label>
                  <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  placeholder="Nombre de usuario"/>
                  @error('username')<div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email*</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email">
                  @error('email')<div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                  <label for="email">Activo*</label>
                  <select class="form-control" name="activo">
                      <option value="1" selected>Si</option>
                      <option value="0">No</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="password">Password*</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password">
                  @error('password')<div class="alert alert-danger">{{ $message }}</div> @enderror
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

  </div>

@endsection