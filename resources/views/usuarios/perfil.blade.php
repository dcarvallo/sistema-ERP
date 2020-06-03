@extends('layouts.adminlayout')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Perfil de Usuario</li>
            </ol>
          </div>
        </div>
        @if(Session::has('resetpass'))
          <div class="d-flex justify-content-end">
            <div class="rounded alert-success col-md-3">
              <p class="lead">
                {{Session::get('resetpass')}}
              </p>
            </div>
          </div>
        @endif
      </div>
    </section>

    
    <section class="content">
      <div class="container-fluid">
        
        
        
      <perfil :usuario="{{$usuario}}"/>
      
      </div>
    </section>

@endsection