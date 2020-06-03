@extends('layouts.adminlayout')
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="far fa-check-square"></i> Permisos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Permisos</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
      <permisos />
    </section>

@endsection