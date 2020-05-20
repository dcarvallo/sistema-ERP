@extends('layouts.adminlayout')
@section('content')

<empleadoedit :usuario="{{ json_encode($usuario) }}"></empleadoedit>

@endsection