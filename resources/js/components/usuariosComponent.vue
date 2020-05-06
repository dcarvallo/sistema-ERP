<template>
  <div>
    
<div class="content-wrapper">
  <div class="w-100 container-fluid">
  <table style="width:100%" id="datatable1" class="table table-striped table-bordered table-hover">
    <thead class="text-center">
      <th>#</th>
      <th>Nombre</th>
      <th>Usuario</th>
      <th>Email</th>
      <th>Activo</th>
      <th>Acciones</th>
    </thead>
    <tbody>
      <!-- {{! $contador = 1 }}
      @foreach($s as $user)
      <tr >
        <td class="text-center">{{$contador}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->username}}</td>
        <td>{{$user->email}}</td>
        <td class="text-center">{{$user->activo}}</td>
        <td class="text-center">
          <button class="btn btn-info">Importar datos</button>
          <button class="btn btn-warning">Editar</button>
        </td>
      </tr>
      {{ ! $contador += 1}}
      @endforeach -->

    </tbody>
  </table>
</div>
</div>

  </div>
</template>

<script>
export default {
  data(){
    return{
      
    }
  },
  props: ['objetous'],
  created(){
    console.log(objetos);
  }
  
}
</script>