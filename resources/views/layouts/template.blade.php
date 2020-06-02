<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistema ERP</title>

  <!-- Bootstrap core CSS -->
  {{-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="/css/all.min.css">
  <link href="/css/sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/app.css">
</head>

<body>
<div id="app">

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <a href="/admin" class="brand-link">
          <img style="width: 40px" src="{{ asset('storage/'.$globalimagenempresa)}}" alt="" class="brand-image img-circl elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light"> {{$globalnombreempresa}}</span>
        </a>  
      </div>
      <div class="list-group list-group-flush">
          <a class="nav-link" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            Link with href
            <i class="right fas fa-angle-left"></i>
          </a>
        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
          </div>
        </div>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a href="#" class="btn btn-outline-secondary navbar-toggler" id="menu-toggle">
        <div class="">
            
            <i class="fas fa-bars"></i>
          </div>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContnt">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item ">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              @guest
                <li><a class="" href="{{ route('login') }}">Login</a></li>
              @else
                
                <li class="nav-item dropdown">
                  
                  <a id="navbarDropdown" class="nav-link dropdown-toggle text-we text-right py-1 mx-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('storage/'.Auth::user()->fotografia)}}" class="img mr-1" style="width: 40px" alt="Logo">
                      
                      <span class="caret"> {{ Auth::user()->username }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="">Perfil</a>
                    <a class="dropdown-item" href=""
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      Salir
                    </a>
                          
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
              @endguest
            </li>
            
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
  </div>


</div>

  <script src="/js/jquery.min.js"></script>

  <script src="{{asset('js/app.js')}}"> </script>
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>