<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  </style>
<table  style="border: 1px solid black;">
  <thead>
    <tr style="border: 1px solid black;">
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
            @foreach($usuario->roles as $rol)
              <li>
                {{$rol->name}}
              </li>
            @endforeach
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>