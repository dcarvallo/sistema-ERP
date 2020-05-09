@extends('layouts.adminlayout')
@section('content')

<usuariosedit :usuario="{{ json_encode($usuario) }}"></usuariosedit>

@endsection