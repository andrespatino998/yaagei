<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$password = (isset($_POST['pass'])) ? $_POST['pass'] : '';
$privilegio = (isset($_POST['privilegio'])) ? $_POST['privilegio'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
//cifra la contraseña
$pass = hash($password);

switch ($opcion) {
    case 1: //alta
        $consulta = "INSERT INTO usuarios (nombre,correo,pass,privilegio) VALUES('$nombre', '$correo', '$pass','$privilegio') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre,correo,pass,privilegio FROM usuarios ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE usuarios SET nombre='$nombre', correo='$correo', pass='$pass',privilegio='$privilegio'  WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

      
        $resultado = $conexion->prepare('SELECT id, nombre, correo, pass, privilegio  FROM usuarios WHERE id='$id'');
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3: //baja
        $consulta = "DELETE FROM usuarios WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;


