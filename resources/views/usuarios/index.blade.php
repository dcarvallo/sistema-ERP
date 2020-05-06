@extends('layouts.adminlayout')

@section('content')

<usuarios objectous="{{json_encode($usuarios)}}"></usuarios>

@section('css-head')
<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection
@section('js-footer')
  
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script>
  $(document).ready(function() {
    $('#datatable1').DataTable({
          "language": {
              "lengthMenu": "Mostrar _MENU_ registros por página",
              "zeroRecords": "Sin registros ",
              "info": "Mostrando página _PAGE_ of _PAGES_",
              "infoEmpty": "No hay registros disponibles",
              "search":"Buscar",
              "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Siguiente",
                "previous":   "Anterior"
            },
              "infoFiltered": "(filtrado de _MAX_ registros en total)"
          }
        });
  });
</script>
@endsection
<script>
  export default{
    data(){

    },
    methods:{
      editarNota(nota){
      const params = {nombre: nota.nombre, descripcion: nota.descripcion};
      axios.put(`/notas/${nota.id}`, params)
        .then(res=>{
          this.modoEditar = false;
          const index = this.notas.findIndex(item => item.id === nota.id);
          this.notas[index] = res.data;
        })
    },
    }
  }
</script>

@endsection