<?php error_reporting(1);

?>
 <?php


    include_once'conexion_bd.php';

    $obj = new BD_PDO();

    if (isset($_POST['btninsertar'])) {
        if ($_POST['btninsertar'] == 'Registrar') {

            // Ruta donde se concentraran las imagenes
            $dir_subida = 'img/subidas/';
            // Obtenemos el nombre del archivo a subir
            $nombre_archivo = basename($_FILES['imagen']['name']);
            // Se prepara una variable con la ruta y el nombre del archivo para subirlo
            $fichero_subido = $dir_subida . $nombre_archivo;

            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) {
                //echo "El fichero es válido y se subió con éxito.\n";
                $obj->Ejecutar_Instruccion("insert into productos(nombre,imagen,descripcion,categoria) values('" . $_POST['nombre'] . "','" . $fichero_subido . "','" . $_POST['descripcion'] . "','" . $_POST['categoria'] . "')");
            } else {
                //$obj->Ejecutar_Instruccion("insert into programa_e(nombre,status,abrev,generacion) values('".$_POST['nombre']."','".$_POST['status']."','".$_POST['abreviacion']."','".$_POST['generacion']."')");        
                //     echo "No se pudo mover el archivo\n";
            }
        } elseif ($_POST['btninsertar'] == 'Modificar')

            if (($_FILES['imagen']['tmp_name'] != "")) {
                // Ruta donde se concentraran las imagenes
                $dir_subida = 'img/subidas/';
                // Obtenemos el nombre del archivo a subir
                $nombre_archivo = basename($_FILES['imagen']['name']);
                // Se prepara una variable con la ruta y el nombre del archivo para subirlo
                $fichero_subido = $dir_subida . $nombre_archivo;

                move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido);

                $obj->Ejecutar_Instruccion("update productos set nombre= '" . $_POST['nombre'] . "',imagen='" . $fichero_subido . "',descripcion= '" . $_POST['descripcion'] . "',categoria= '" . $_POST['categoria'] . "'   where id '" . $_POST['id'] . "'");
                       
            } else {
                $obj->Ejecutar_Instruccion("update productos set nombre= '" . $_POST['nombre'] . "',descripcion= '" . $_POST['descripcion'] . "',categoria= '" . $_POST['categoria'] . "'   where id '" . $_POST['id'] . "'");
                
            }
    }




    if (isset($_GET['id_eliminar'])) {
        $obj->Ejecutar_Instruccion("delete from productos where id='" . $_GET['id_eliminar'] . "'");
        
    } elseif (isset($_GET['id_modificar'])) {

        $prod_modificar = $obj->Ejecutar_Instruccion("select * from productos where id= '" . $_GET['id_modificar'] . "'");
         
    }

    $productos = $obj->Ejecutar_Instruccion("select * from productos where nombre like '%" . $_POST['txtbuscar'] . "%'");

    
?>