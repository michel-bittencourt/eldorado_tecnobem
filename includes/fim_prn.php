
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./plugins/jszip/jszip.min.js"></script>
<script src="./plugins/pdfmake/pdfmake.min.js"></script>
<script src="./plugins/pdfmake/vfs_fonts.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<script src="./dist/js/funcoes.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "language": {
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "search": "Busca:",
        "emptyTable":     "Não existem dados para exibir",
        "infoEmpty":      "Mostrando 0 até 0 de 0 registros",
        "infoFiltered":   "(filtered from _MAX_ total entries)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Exibindo _MENU_ registros",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "zeroRecords":    "Registros não encontrados",
        "paginate": {
          "first":      "Primeiro",
          "last":       "Último",
          "next":       "Próximo",
          "previous":   "Anterior"
        },
        "aria": {
            "sortAscending":  ": Ordem ascendente",
            "sortDescending": ": Ordem descendente"
        }         
      }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "language": {
        "info": "Mostrando página _PAGE_ de _PAGES_",
        "search": "Busca:",
        "emptyTable":     "Não existem dados para exibir",
        "infoEmpty":      "Mostrando 0 até 0 de 0 registros",
        "infoFiltered":   "(filtered from _MAX_ total entries)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Exibindo _MENU_ registros",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "zeroRecords":    "Registros não encontrados",
        "paginate": {
          "first":      "Primeiro",
          "last":       "Último",
          "next":       "Próximo",
          "previous":   "Anterior"
        },
        "aria": {
            "sortAscending":  ": Ordem ascendente",
            "sortDescending": ": Ordem descendente"
        }         
      }
    });
  });
</script>
</body>
</html>
<?php 
mysqli_close($conn)
?>



