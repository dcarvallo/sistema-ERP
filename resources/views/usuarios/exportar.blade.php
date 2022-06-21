<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{public_path('css/app.css')}}">

  <title>Exportado</title>
</head>
<body>
    <h4 class="alert alert-danger">Usuarios</h4>
    <table  class="table table-bordered table-sm">
      <thead>
        <tr >
          <th>ID</th>
          <th>Nombre Completo</th>
          <th>Nombre de Usuario</th>
          <th>Email</th>
          <th>Activo</th>
          <th>Rol</th>
        </tr>
      </thead>
      <tbody>
        @foreach($datos as $usuario)
        <tr>
          <td>{{$usuario->id}}</td>
          <td>{{$usuario->name}}</td>
          <td>{{$usuario->username}}</td>
          <td>{{$usuario->email}}</td>
          <td>{{$usuario->activo ? 'Si':'No'}}</td>
          <td>
            @if($usuario->roles)
            <ul style="padding-left: 15px">
              @foreach($usuario->roles as $rol)
              <li>
                {{$rol->name}}
              </li>
              @endforeach
            </ul>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</body>
</html>
