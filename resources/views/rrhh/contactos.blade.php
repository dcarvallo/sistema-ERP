@extends('layouts.adminlayout')

@section('content')
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="far fa-address-book"></i> Contactos</h1>
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content" id="app">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body pb-0">
        <div class="row d-flex align-items-stretch">

          @foreach($usuarios as $usuario)
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            <div class="card bg-light">
              <div class="card-header text-muted border-bottom-0">
                Cargo: Digital Strategist
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b>{{ $usuario->name}}</b></h2>
                    <p class="text-muted text-sm"><b>Acerca de: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Email: {{$usuario->email}}</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono #: + 800 - 12 12 23 52</li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="{{asset('storage/'.$usuario->fotografia)}}" alt="" width="100px" height="100px" class="img-circle img-fuid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="#" class="btn btn-sm bg-teal">
                    <i class="fas fa-comments"></i>
                  </a>
                  <a href="#" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Ver perfil
                  </a>
                </div>
              </div>
            </div>
          </div>

          @endforeach

        </div>
      </div>
            <div class="d-flex my-3 justify-content-center">
    
              {{ $usuarios->links() }}
            </div>
            
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->

@endsection
