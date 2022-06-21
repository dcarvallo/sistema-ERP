@extends('layouts.adminlayout')
@section('content')

@section('icono')
  <i class="nav-icon fas fa-receipt"></i>
@endsection

@section('vista', 'Reportes Contables')

@section('breadcrumb')  
  <li class="breadcrumb-item active">Reportes</li>
@endsection

<section class="content mb-4">
  <div class="card card-solid">
    <div class="card-body pt-1">
      
      <ul>
        <li>Balance General</li>
        <li>Estado de Resultados</li>
        <li>Estados Acumulados</li>
        <li>Evolucion del Patrimonio</li>
        <li>Estado de Flujo de Efectivo</li>
        <li>Sumas y Saldos</li>
        <li>Mayor de Cuentas</li>
        <li>Hoja de Costos</li>
        <li>Cuentas Corrientes</li>
        <li>Ejecucion Presupuestaria</li>
        <li>Comprobantes</li>
        <li>Actualizacion por inflacion</li>
        <li>Plan de Cuentas</li>
        <li>Centro de Costo</li>
        <li>Cuenta Corriente</li>
      </ul>
 
    </div>
  </div>
</section>

@endsection