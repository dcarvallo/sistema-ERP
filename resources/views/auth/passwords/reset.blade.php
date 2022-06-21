@extends('layouts.adminlayout')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cambiar Contraseña</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Cambiar Contraseña</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content mb-4" id="app">
  <div class="card card-solid">
    <div class="card-body ">
      <form method="POST" action="{{ route('password.update') }}">
          @csrf

          <div class="form-group row">
            <label for="actual" class="col-md-4 col-form-label text-md-right">Contraseña actual</label>

            <div class="col-md-6">
              <input id="actual" type="password" class="form-control @error('password') is-invalid @enderror" name="actual" required autocomplete="new-password">

              @error('actual')
                <span class="alert-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
                
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">Nueva contraseña</label>

            <div class="col-md-6">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="nuevo" required autocomplete="new-password">

              @error('nuevo')
                <span class="alert-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar nueva contraseña</label>

            <div class="col-md-6">
              <input id="password-confirm" type="password" class="form-control" name="nuevo_confirmation" required autocomplete="new-password">
              @error('nuevo_confirmation')
                <span class="alert-danger" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror

            </div>
          </div>

          <div class="form-group text-right row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                Cambiar contraseña
              </button>
            </div>
          </div>
      </form>
    </div>
  </div>
</section>
@endsection
