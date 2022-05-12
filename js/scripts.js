$(document).ready(function(){

    $('#TblCateg').DataTable( {
        "order": [[ 1, "asc" ]]
    } );

    $('#TblRedes').DataTable( {
        "order": [[ 1, "asc" ]]
    } );

    $('#TblLocutores').DataTable( {
        "order": [[ 1, "asc" ]]
    } );

    $('#TblVideos').DataTable( {
        "order": [[ 1, "asc" ]]
    } );


    $('select#id_secretaria').on("change", function(){

        var id_secretaria = $("select[name=id_secretaria]").val(); 
        $.post("carrega_departamentos.php",{id_secretaria:id_secretaria},function(data){$("#depto").html(data);});
    }); 


});


