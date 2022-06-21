@extends('layouts.adminlayout')

@section('icono')
  <i class="fas fa-house-user"></i>
@endsection

@section('vista', 'Inicio')

@section('breadcrumb')  
  <li class="breadcrumb-item active"></li>
@endsection

@section('content')

<section>
  <div class="container-fluid">
    <div class="card">
      {{-- <div class="card-header">
      Inicio
      </div> --}}
      <div class="card-body min-vh-100">
        <div class="row">
          {{-- card --}}
          @can('permisos', 'Navegar-admin')
          <div class="col-md-3 py-2">
            <a href="{{route('admin.index')}}">
              <div class="card h-100">
                <div class="card-header">Admin</div>
                <div class="card-body">Modulos de Administracion</div>
                <div class="card-footer py-1 text-right">
                  <a class="badge badge-pill badge-warning border" href="#">
                    <i class="far fa-bell"></i>
                    <span class="px-1">2</span>
                  </a>
                </div>
              </div>
            </a>
          </div>
          @endcan
          {{-- endcard --}}
          @can('permisos', 'Navegar-empresas')
          <div class="col-md-3 py-2">
            <div class="card h-100">
              <div class="card-header">Estructura empresarial</div>
              <div class="card-body">Modulos de la empresa</div>
              <div class="card-footer py-1 text-right">
                <a class="badge badge-pill badge-warning border" href="#">
                  <i class="far fa-bell"></i>
                  <span class="px-1">2</span>
                </a>
              </div>
            </div>
          </div>
          @endcan

          @can('permisos', 'Navegar-rrhh')
          <div class="col-md-3 py-2">
            <div class="card h-100">
              <div class="card-header">RRHH</div>
              <div class="card-body">Modulos de Recursos humanos</div>
              <div class="card-footer py-1 text-right">
                <a class="badge badge-pill badge-warning border" href="#">
                  <i class="far fa-bell"></i>
                  <span class="px-1">2</span>
                </a>
              </div>
            </div>
          </div>
          @endcan

          @can('permisos', 'Navegar-contabilidad')
          <div class="col-md-3 py-2">
            <div class="card h-100">
              <div class="card-header">Contabilidad</div>
              <div class="card-body">Modulos de Contabilidad</div>
              <div class="card-footer py-1 text-right">
                <a class="badge badge-pill badge-warning border" href="#">
                  <i class="far fa-bell"></i>
                  <span class="px-1">2</span>
                </a>
              </div>
            </div>
          </div>
          @endcan

          @can('permisos', 'Navegar-almacen')
          <div class="col-md-3 py-2">
            <div class="card h-100">
              <div class="card-header">Almacen</div>
              <div class="card-body">Modulos de Almacenes</div>
              <div class="card-footer py-1 text-right">
                <a class="badge badge-pill badge-warning border" href="#">
                  <i class="far fa-bell"></i>
                  <span class="px-1">2</span>
                </a>
              </div>
            </div>
          </div>
          @endcan

          @can('permisos', 'Navegar-tesoreria')
          <div class="col-md-3 py-2">
            <div class="card h-100">
              <div class="card-header">Tesoreria</div>
              <div class="card-body">Modulos de tesoreria y cajas</div>
              <div class="card-footer py-1 text-right">
                <a class="badge badge-pill badge-warning border" href="#">
                  <i class="far fa-bell"></i>
                  <span class="px-1">2</span>
                </a>
              </div>
            </div>
          </div>
          @endcan

          @can('permisos', 'Navegar-helpdesk')
          <div class="col-md-3 py-2">
            <div class="card h-100  ">
              <div class="card-header">HelpDesk</div>
              <div class="card-body">Modulos de HelpDesk / soporte</div>
              <div class="card-footer py-1 text-right">
                <a class="badge badge-pill badge-warning border" href="#">
                  <i class="far fa-bell"></i>
                  <span class="px-1">2</span>
                </a>
              </div>
            </div>
          </div>
          @endcan

          <div class="col-md-3 py-2">
            <div class="card h-100  ">
              <div class="card-header">Contactos</div>
              <div class="card-body">Contacto de trabajadores</div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>  
</section>
@endsection
