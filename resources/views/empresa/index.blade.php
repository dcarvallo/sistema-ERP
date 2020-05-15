@extends('layouts.adminlayout')
@section('css-head')
  <link rel="stylesheet" href="css/css.css">
  <link rel="stylesheet" href="css/animate.min.css">
@endsection
@section('content')

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Datos de Empresa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Empresa</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <section class="content" id="app">

        <!-- Default box -->
        <div class="row d-flex justify-content-lg-center">
          <div class="col-md-12">
        <div class="card  card-solid">
          <div class="card-body">
            <div class="contentempresa">
              <img src="/img/fondos/vintage-wallpaper.png" alt="">
              <div class="texto text-center d-flex flex-column text-white">
                  <h1 class="mb-4">Nombre: Empresa S-ERP</h1><br>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias dolore, dolorem facilis similique ipsum unde corporis quae numquam earum natus perferendis? Obcaecati enim dignissimos, voluptas, omnis aut nulla quis, modi natus sunt fuga unde consequuntur aliquid hic. Laboriosam, atque libero.</p>
              </div>
            </div>
            <div>
              <h4 class="bold">Rubro</h4>
              <p>Empresa de servicios tecnologicos</p>
            </div>
            <div >
              <h4 class="bold">Mision</h4>
              <p >Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore illum doloribus vero, quisquam architecto pariatur quidem nam qui fugiat iste dolor provident cum aut voluptate cupiditate temporibus, magni alias? Quisquam!</p>
            </div>
            <div >
              <h4 class="bold">Vision</h4>
              <p >Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit officia sapiente dolorem accusamus, eveniet quo voluptate deserunt velit nesciunt eum eligendi quod! Recusandae, in dolorum!</p>
            </div>
          </div>

          </div>
        </div>
      </div>
      </section>
  </div>

@endsection