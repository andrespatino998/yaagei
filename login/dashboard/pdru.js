$(document).ready(function(){
    tablaproductos = $("#tablaproductos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "dat":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btneditar'>Editar</button><button class='btn btn-danger btnborrar'>Borrar</button></div></div>"  
        
    }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnnuevop").click(function(){
    $("#formproductos").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo producto");            
    $("#modalproductos").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnedita", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre = fila.find('td:eq(1)').text();
    imagen = fila.find('td:eq(2)').text();
    descripcion = fila.find('td:eq(3)').text();
    categoria = fila.find('td:eq(4)').text();
    
    $("#id").val(id);
    $("#nombre").val(nombre);
    $("#imagen").val(imagen);
    $("#descripcion").val(descripcion);
    $("#categoria").val(categoria);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Producto");            
    $("#modalproductos").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnborrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudproductos.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaproductos.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formproductos").submit(function(e){
    e.preventDefault();    
    nombre = $.trim($("#nombre").val());
    imagen = $.trim($("#imagen").val());
    descripcion = $.trim($("#descripcion").val());    
    categoria = $.trim($("#categoria").val());    
    $.ajax({
        url: "bd/crudproductos.php",
        type: "POST",
        dataType: "json",
        data: {nombre:nombre, imagen:imagen, descripcion:descripcion, categoria:categoria, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombre = data[0].nombre;
            imagen = data[0].imagen;
            descripcion = data[0].descripcion;
            categoria = data[0].categoria;
            if(opcion == 1){tablaproductos.row.add([id,nombre,imagen,descripcion,categoria]).draw();}
            else{tablaproductos.row(fila).data([id,nombre,imagen,descripcion,categoria]).draw();}            
        }        
    });
    $("#modalproductos").modal("hide");    
    
});    

});