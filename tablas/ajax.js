$(document).ready(function(){
    
    $("#insertar-imagen").submit(insertarImagen);
    
    function insertarImagen(evento){
        evento.preventDefault();
        var datos = new FormData($("#insertar-imagen")[0]);
        $("#respuesta").html("<img src='cargando.gif' height='200'>");
        
        $.ajax({
            url: 'insertar-imagen.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            success: function(datos){
                $("#respuesta").html(datos);
            }
        });
    }
});
