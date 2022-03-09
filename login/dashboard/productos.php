<?php require_once "vistas/parte_superior.php";
if (isset($_GET['id'])) {
    $_SESSION['id'] = $_GET['id'];
    if(isset($_GET['s_usuario'])){
        $_SESSION['s_usuario']=$_GET['s_usuario'];

      }
}



?>
<?php error_reporting(1);

?>
<?php


include_once 'bd/conexion_bd.php';

$obj = new BD_PDO();

$id_usu = $obj->Ejecutar_Instruccion("select id from usuarios where correo= '" . $_SESSION['s_usuario'] . "'");

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
            $obj->Ejecutar_Instruccion("insert into productos(nombre,imagen,descripcion,categoria,id_usu) values('" . $_POST['nombre'] . "','" . $fichero_subido . "','" . $_POST['descripcion'] . "','" . $_POST['categoria'] . "','" .  $id_usu[0]['id'] . "')");
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

            $obj->Ejecutar_Instruccion("update productos set nombre= '" . $_POST['nombre'] . "',imagen='" . $fichero_subido . "',descripcion= '" . $_POST['descripcion'] . "',categoria= '" . $_POST['categoria'] . "'   where id = '" . $_POST['id'] . "'");
        } else {
            $obj->Ejecutar_Instruccion("update productos set nombre= '" . $_POST['nombre'] . "',descripcion= '" . $_POST['descripcion'] . "',categoria= '" . $_POST['categoria'] . "'   where id = '" . $_POST['id'] . "'");
        }
}




if (isset($_GET['id_eliminar'])) {
    $obj->Ejecutar_Instruccion("delete from productos where id='" . $_GET['id_eliminar'] . "'");
    
} elseif (isset($_GET['id_modificar'])) {

    $prod_modificar = $obj->Ejecutar_Instruccion("select * from productos where id= '" . $_GET['id_modificar'] . "'");
}

$productos = $obj->Ejecutar_Instruccion("select * from productos where nombre like '%" . $_POST['txtbuscar'] . "%'");


?>
<!--INICIO del cont principal-->
<div class="container">
    <h1>Productos</h1>
    <!-- Confirmacion de Eliminacion-->
    <script type="text/javascript">
        function ConfirmDelete() {
            var respuesta = confirm("¿Estás seguro de querer eliminar este programa?");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }

        }

        function fileValidation() {
            var fileInput = document.getElementById('imagen');
            var filePath = fileInput.value;
            var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Por favor introduce un archivo que sea sólo de extensión: .jpeg/.jpg/.png/.gif');

                fileInput.value = '';
                return false;
            }

            return true;

        }
    </script>
    <?php

    // require 'bd/crudproductos.php';

    include_once 'bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id,nombre,imagen,descripcion,categoria FROM productos";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);

    $prod_modificar = '4'
    ?>
<a href="" id="registropro"></a>
<div class="container" align="center" id="modal" tabindex="-1" role="dialog">
        <div>




            <a href="" id="registrar"></a>
            <form action="productos.php#registrar" class="jumbotron" enctype="multipart/form-data" method="post">
                <div class="modal-body">
                    <div hidden class="row">
                        <label></label>
                        <input hidden type="text" id="id" name="id" value="<?php echo @$prod_modificar[0]['id'] ?>">
                        <br>
                    </div>
                    <div class="col-md-4">
                        <label for="nombre" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo @$prod_modificar[0]['nombre'] ?>">
                    </div>
                    <div class="col-md-4">
                        <img style=display:<?php
                                            if (isset($_GET['id_modificar'])) {
                                            } else {
                                                echo 'none';
                                            }             ?>; id="idimagen" src="<?php echo @$prod_modificar[0]['imagen']; ?>" height="250" width="250">

                        <br>
                        <br>
                    </div>
                    <div class="col-md-4">
                        <label for="imagen" class="col-form-label">Imagen:</label>
                        <input class="form-control" id="imagen" name="imagen" type="file" onchange="return fileValidation()" value="<?php echo $prod_modificar[0]['imagen'];?>">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion" class="col-form-label">Descripcion:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $prod_modificar[0]['descripcion']; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="categoria" class="col-form-label">Categoria:</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $prod_modificar[0]['categoria'];?>">
                    </div>
                </div>
                <div class="modal-footer">

                    <!-- <button type="submit" id="btnguardar" class="btn btn-success">Registrar</button> -->
                    <input type="submit" id="btninsertar" name="btninsertar" value="<?php if (isset($_GET['id_modificar'])) {
                                                                                        echo 'Modificar';
                                                                                    } else {
                                                                                        echo 'Registrar';
                                                                                    }             ?>" class="btn btn-success">

                </div>
            </form>
        </div>
    </div>
    <a href="" id="tabla"></a>
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-12">
                <button id="btnnuevop" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>
            </div> -->
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaproductos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Descripcion</th>
                                <th>Categoria</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                            ?>
                                <tr>
                                    <td><?php echo $dat['id'] ?></td>
                                    <td><?php echo $dat['nombre'] ?></td>
                                    <td><img src="<?php if (isset($dat['imagen'])) {
                                                        echo $dat['imagen'];
                                                    } else {
                                                        echo "img/subidas/sin.imagen.jpg";
                                                    }
                                                    ?>" height="100" width="200"></td>

                                    <td><?php echo $dat['descripcion'] ?></td>
                                    <td><?php echo $dat['categoria'] ?></td>
                                    <td align="text-center">
                                        <div class="btn-group"><a class="btn btn-primary btneditar" href="productos.php?id_modificar=<?php echo $dat['id']; ?>#registropro">Editar</a>
                                            <a class="btn btn-danger" href="productos.php?id_eliminar=<?php echo $dat['id']; ?>" onclick="return ConfirmDelete()">Borrar</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

 
                </div>
            </form>
        </div>
    </div> 
</div>



</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php" ?>