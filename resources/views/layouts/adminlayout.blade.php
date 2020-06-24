<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf_token" content="{{csrf_token()}}">

  <title>Sistema ERP</title>

  <link rel="stylesheet" href="/css/all.min.css">
  <link rel="stylesheet" href="/css/adminlte.min.css">
 <link rel="stylesheet" href="/css/app.css">
 
  @yield('css-head')
</head>

<body class="hold-transition sidebar-collapse sidebar-mini">
<div id="app" class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/limpiar" class="nav-link">Limpiar telescope</a>
      </li>
      @can('admin.archivos')
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/filemanager"  class="nav-link">Administrar Archivos</a>
      </li>
      @endcan
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments fa-2x"></i>
          <span class="badge badge-danger navbar-badge">4</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          {{-- @foreach() --}}
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <p>Pepe rillo</p>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Agregar foreach de mensajes de chats paginate(4).</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>Hace 2 horas</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          {{-- @endforeach --}}
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Otro brad
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Lammame cuando puedas...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 3 horas</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John connor
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Recibi tu mensaje bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 4 horas</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">La persona esta aqui</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Hace 4 horas</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell fa-2x"></i>

          <span class="badge badge-warning navbar-badge">9</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">9 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 3 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 2 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div> 
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <!-- Authentication Links -->
      @guest
          <li><a class="" href="{{ route('login') }}">Login</a></li>
      @else
        
        <li class="nav-item right-align dropdown">
          
          <a id="navbarDropdown" class="nav-link dropdown-toggle text-right py-1 mx-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <img src="{{ asset('storage/'.Auth::user()->fotografia)}}" class="img-circle img-fluid mr-1" style="width: 38px; height: 38px;" alt="user">
              
            <span class="caret"> {{ Auth::user()->username }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('perfil')}}">Perfil</a>
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
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="{{ asset('storage/'.$globalimagenempresa)}}" alt="" class="brand-image img-circl elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> {{$globalnombreempresa}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2 min-vh-100 ">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- @if(['permisos', 'Navegar-admin'],['permisos', 'Navegar-usuarios'],['permisos','Navegar-roles'],['permisos','Navegar-permisos']) --}}
          @if(Gate::check('permisos','Navegar-admin') || 
              Gate::check('permisos', 'Navegar-usuarios') ||
              Gate::check('permisos', 'Navegar-roles') ||
              Gate::check('permisos', 'Navegar-permisos')
          )
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('permisos', 'Navegar-usuarios')
              <li class="nav-item  {{ request()->is("route('users.index')") ? 'bg-blue' : ''}}">
                <a href="{{route('users.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-roles')
              <li class="nav-item  {{ request()->is("route('roles.index')") ? 'bg-blue' : ''}}">
                <a href="{{route('roles.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-permisos')
              <li class="nav-item  {{ request()->is("route('permisos.index')") ? 'bg-blue' : ''}}">
                <a href="{{route('permisos.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permisos</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-contactos')
              <li class="nav-item {{ request()->is('contactos') ? 'bg-blue' : ''}}">
                <a href="/contactos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contactos</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endif
          {{-- @canany('permisos', ['Navegar-empresas','Navegar-ubicaciones', 'Navegar-departamentos', 'Navegar-areas','Navegar-cargos']) --}}
          @if(Gate::check('permisos', 'Navegar-empresas') || 
              Gate::check('permisos', 'Navegar-ubicaciones') ||
              Gate::check('permisos', 'Navegar-departamentos') ||
              Gate::check('permisos', 'Navegar-areas') ||
              Gate::check('permisos', 'Navegar-cargos')
             )
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Estructura empresarial
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('permisos', 'Navegar-estructura')
              <li class="nav-item">
                <a href="{{ route('ubicaciones.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Estructura organizativa</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-empresas')
              <li class="nav-item">
                <a href="{{route('empresas.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empresa</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-ubicaciones')
              <li class="nav-item">
                <a href="{{ route('ubicaciones.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ubicaciones</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-departamentos')
              <li class="nav-item">
                <a href="{{route('departamentos.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Departamentos</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-areas')
              <li class="nav-item">
                <a href="{{route('areas.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Áreas</p>
                </a>
              </li>
              @endcan
              @can('permisos', 'Navegar-cargos')
              <li class="nav-item">
                <a href="{{route('cargos.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cargos</p>
                </a>
              </li>
              @endcan
            </ul>
            
          </li>
          @endif
          @can('permisos', 'Navegar-rrhh')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                RRHH
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contratación</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cargos</p>
                </a>
              </li>
              @can('permisos', 'Navegar-empleados')
              <li class="nav-item">
                <a href="{{route('empleados.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empleados</p>
                </a>
              </li>
              @endcan
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Planillas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vacaciones</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Asistencia </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Entrevistas </p>
                </a>
              </li>
            </ul>
            
          </li>
          @endcan
          @can('permisos', 'Navegar-contabilidad')
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-receipt"></i>
                <p>
                  Contabilidad
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Facturación</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('librodiario')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Libro diario</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cuentas x Pagar</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/empleados" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Cuentas x Cobrar</p>
                  </a>
                </li>
              </ul>
            
            </li>
            @endcan
            @can('permisos', 'Navegar-almacen')
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-box"></i>
                  <p>
                    Almacén
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inventario</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Compra</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/empleados" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Documentos</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Servicio de campo</p>
                    </a>
                  </li>
                </ul>
            
              </li>
              @endcan
              @can('permisos', 'Navegar-tesoreria')
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>
                      Tesoreria
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cajas</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dia</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/empleados" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Reportes</p>
                      </a>
                    </li>

                  </ul>
            
                </li>
                @endcan
                @can('permisos', 'Navegar-helpdesk')
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-life-ring"></i>
                      <p>
                        HelpDesk
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Incidencias</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Eventos</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Reportes</p>
                        </a>
                      </li>
                      
                    </ul>
            
                  </li>
                  @endcan
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header pt-2 pb-0">
      <div class="container-fluid">
        <div class="row mb-2"> 
          <div class="col-sm-6">
            <h3>
              @yield('icono')
              @yield('vista')
            </h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @yield('breadcrumb')
            </ol>
          </div>
        </div>
      </div>
    </section>

    @yield('')
    @yield('content')
  </div>

  
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <footer class="main-footer mb-4">
    <strong>Copyright &copy; 2020 <a href="#">Daniel Carvallo</a></strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/adminlte.js"></script>
<script src="{{asset('js/app.js')}}"> </script>

@yield('js-footer')

</body>
</html>
