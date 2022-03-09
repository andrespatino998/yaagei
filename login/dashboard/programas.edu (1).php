<?php error_reporting(1);

 ?>


<!DOCTYPE HTML>
<!--
	Justice by freehtml5.co
	Twitter: http://twitter.com/fh5co
	URL: http://freehtml5.co
-->
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	

	<title>Programas Educativos &mdash; UTNC</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

	<link rel="stylesheet" href="css/estilo.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	
	<!--FOOTER-->
	 <link rel="stylesheet" type="text/css" href="../2a/styles/main_styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
    <link rel="stylesheet" type="text/css" href="../2a/styles/responsive.css">
      
	
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400, 900" rel="stylesheet"> -->
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	    
	    
<script type="text/javascript">

function Validar()

{  
    var nombre = document.getElementById("nombre").value;
    var nombre_sin_e = nombre.trim();

    if (nombre_sin_e.length < 1) 
    {
           alert("El campo de nombre está vacío.");
           return false;
    }

    var status = document.getElementById("status").value;
    var status_sin_e = status.trim();

    if (status_sin_e.length < 1) 
    {
           alert("No se ha seleccionado un status");
           return false;
    }

    var abrev = document.getElementById("abreviacion").value;
    var abrev_sin_e = abrev.trim();

    if (abrev_sin_e.length < 1) 
    {
           alert("El campo de la abreviación está vacío.");
           return false;
    }

	 var  generacion= document.getElementById("generacion").value;
    if (generacion.length < 1) 
    {
           alert("El campo del año está vacío.");
           return false;
    }
        return true;
}

</script>



<!-- Confirmacion de Eliminacion-->
<script type="text/javascript">
    
function ConfirmDelete()
{
    var respuesta =confirm("¿Estás seguro de querer eliminar este programa?");
    if (respuesta==true) 
    {
       return true;
    }
    else
    {
      return false;
    }

}


</script>

<!-- Validación de campos alfanuméricos-->

<script type="text/javascript">
    
function Sololetras(e)
{
  var estatus = false;
   
  key = e.keyCode ||  e.which;
  tecla = String.fromCharCode(key).toLowerCase();


//alert(tecla);
letras =" abcdefghijklmnñopqrstuvwxyzáéíóú";
for (var i = 0; i < letras.length; i++) 
{
    if (tecla == letras[i])
    {
       estatus = true;
    }
}
return estatus;
}

</script>


<!-- Validación de campos numéricos-->

<script type="text/javascript">
    
function Solopuntocoma(e)
{
  var estatus = false;
   
  key = e.keyCode ||  e.which;
  tecla = String.fromCharCode(key).toLowerCase();


signos ="0123456789";
for (var i = 0; i < signos.length; i++) 
{
    if (tecla == signos[i])
    {
       estatus = true;
    }
}
return estatus;
}

</script>

<script type="text/javascript">

function fileValidation()
{
    var fileInput = document.getElementById('imagen');
    var filePath = fileInput.value;
    var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
    if (!allowedExtensions.exec(filePath))
    {
       alert('Por favor introduce un archivo que sea sólo de extensión: .jpeg/.jpg/.png/.gif');
     
    fileInput.value = '';
    return false;
    }
   
    return true;

}

</script>



<?php 


        require 'bd/conexion_bd.php';

        $obj = new BD_PDO();

if (isset ($_POST['btninsertar'])) 
{
    if ($_POST['btninsertar']=='Registrar') 
    {  

       // Ruta donde se concentraran las imagenes
        $dir_subida = 'img/subidas/';
        // Obtenemos el nombre del archivo a subir
        $nombre_archivo = basename($_FILES['imagen']['name']);
        // Se prepara una variable con la ruta y el nombre del archivo para subirlo
        $fichero_subido = $dir_subida . $nombre_archivo;
        
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)) 
        {
        //echo "El fichero es válido y se subió con éxito.\n";
            $obj->Ejecutar_Instruccion("insert into programa_e(nombre,status,abrev,generacion,Imagen) values('".$_POST['nombre']."','".$_POST['status']."','".$_POST['abreviacion']."','".$_POST['generacion']."','".$fichero_subido."')");             
        } 
        else 
        {
           $obj->Ejecutar_Instruccion("insert into programa_e(nombre,status,abrev,generacion) values('".$_POST['nombre']."','".$_POST['status']."','".$_POST['abreviacion']."','".$_POST['generacion']."')");        
    //     echo "No se pudo mover el archivo\n";
      }

     }
    


      elseif ($_POST['btninsertar']=='Modificar') 
      
        if (($_FILES['imagen']['tmp_name']!="")) 
        {
          // Ruta donde se concentraran las imagenes
          $dir_subida = 'img/subidas/';
          // Obtenemos el nombre del archivo a subir
          $nombre_archivo = basename($_FILES['imagen']['name']);
          // Se prepara una variable con la ruta y el nombre del archivo para subirlo
          $fichero_subido = $dir_subida . $nombre_archivo;
        
          move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido);
          
            $obj->Ejecutar_Instruccion("update programa_e set nombre= '".$_POST['nombre']."',status= '".$_POST['status']."',abrev= '".$_POST['abreviacion']."',generacion='".$_POST['generacion']."', Imagen='".$fichero_subido."' where id_pe= '".$_POST['id']."'");
        } 


            else 
           {
            $obj->Ejecutar_Instruccion("update programa_e set nombre= '".$_POST['nombre']."',status= '".$_POST['status']."',abrev= '".$_POST['abreviacion']."',generacion='".$_POST['generacion']."' where id_pe= '".$_POST['id']."'");
           }
           
    }
          
        
        

 if (isset ($_GET['id_eliminar']))
 {
   $obj-> Ejecutar_Instruccion("delete from programa_e where id_pe='".$_GET['id_eliminar']."'");
   header('location: ../productos.php');
   }

   elseif (isset($_GET['id_modificar'])) 
   {
     $prog_modificar = $obj-> Ejecutar_Instruccion("select * from programa_e where id_pe= '".$_GET['id_modificar']."'");
 }

    $programas = $obj-> Ejecutar_Instruccion("select * from programa_e where nombre like '%".$_POST['txtbuscar']."%'");


//var_dump("insert into programa_e(nombre,status,abrev,generacion,Imagen) values('".$_POST['nombre']."','".$_POST['status']."','".$_POST['abreviacion']."','".$_POST['generacion']."','".$fichero_subido."')");

 ?>


		
	<div class="gtco-loader"></div>
	<!--LINK DE ICONO-->
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'> 
	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400, 900" rel="stylesheet"> -->
	

	<div id="page">
	<nav class="gtco-nav" role="navigation">

		<div class="container">
			<div class="row">
			
			
			
			
				<div class="col-sm-2 col-xs-12">
					<div id="gtco-logo"><a href="../index.php" >	<i class="large material-icons" title="Inicio" style="font-size:56px">house</i><em></em></a></div>
				
				</div>
				<div class="col-xs-10 text-right menu-1 main-nav">
				    
					<ul>
			
			
				
						
						
						
						
						
						
						
						 <li><a href="#" style="font-size:16px" data-nav-section="registro">Registro</a></li>
						 <li><a href="#" style="font-size:16px" data-nav-section="listado">Búsqueda</a></li>
						 <!-- <li class="fas fa-user"></i><a  title="Cerrar sesión" style="font-size:16px" href="../cerrar_sesion.php">Cerrar sesión</a></li>';-->
						 <!-- <li><a href="cerrar_sesion.php" style="font-size:16px" >Cerrar sesión</a></li>-->
						<!-- <li><a href="#" data-nav-section="our-team">Our Team</a></li>-->
						<!-- <li class="btn-cta"><a href="index.php" data-nav-section="contact"><span>Ir a la página principal</span></a></li>-->
						<!-- For external page link -->
						<!-- <li><a href="http://freehtml5.co/" class="external">External</a></li> -->
					</ul>
				</div>
			</div>
			
		</div>
	</nav>



	<section id="gtco-hero" class="gtco-cover" style="background-image: url(images/fachada.jpg);"  data-section="home"  data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-center">
					<div class="display-t">
						<div class="display-tc">
							<h1 class="animate-box" data-animate-effect="fadeIn">Programas Educativos</h1>
							<!--<p class="gtco-video-link animate-box" data-animate-effect="fadeIn"><a href="https://vimeo.com/channels/staffpicks/93951774" class="popup-vimeo"><i class="icon-controller-play"></i></a></p>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
<br><br>	



<section id="gtco-about" data-section="registro">
</div>
<div align="center" class="container" id="registrar"> 
	
<form action="programas.edu.php#registrar" class="jumbotron" enctype="multipart/form-data" method="post" onsubmit="return Validar()">
	<h1>Registrar Programa</h1>

<div class="row">

<div hidden class="col-md-8 col-md-offset-2">
<label>ID </label>
<input hidden type="text" id="id" name="id" value="<?php echo @$prog_modificar[0]['id_pe'] ?>">
<br>
</div>


<div class="col-md-8 col-md-offset-2">
<label>Nombre</label>
<input  onkeypress="return Sololetras(event)"  class="form-control"  required  type="text" id="nombre" name="nombre" value="<?php echo @$prog_modificar[0]['nombre'] ?>">
<br>
</div><br><br>


<div class="col-md-4 col-md-offset-2">
<label>Status</label>
<select id="status" name="status" class="form-control" required>

<option value="">Seleccione</option>	
<option value="Activo" <?php if ($prog_modificar[0][2]=="Activo"){ echo "Selected"; } ?>>Activo</option>	
<option value="No Activo" <?php if ($prog_modificar[0][2]=="No Activo"){ echo "Selected"; } ?>>No Activo</option>	


</select>
</div>



<div class="col-md-4">
<label>Abreviación</label>
<input class="form-control" onkeypress="return Sololetras(event)" required  type="text" id="abreviacion" name="abreviacion" value="<?php echo @$prog_modificar[0]['abrev'] ?>">

<br>
</div>



<div class="col-md-4 col-md-offset-2">
<label>Año</label>
<input class="form-control" onkeypress="return Solopuntocoma(event)" required  type="number" id="generacion" name="generacion" value="<?php echo @$prog_modificar[0]['generacion'] ?>">
<br>
</div>




<div class="col-md-4">
<label for="input"><strong>Imagen</strong></label>
<div style="padding-left: 5%">
<input class="form-control" id="imagen" name="imagen" type="file" onchange="return fileValidation()" value="<?php echo @$prog_modificar[0]['Imagen'] ?>">
<div style="padding-left: 5%" align="center">
<p class="help-block text-danger"></p>
</div>
</div>
</div>


<!-- Imagen -->
<div class="col-md-8 col-md-offset-2">
<img  style= display:<?php 
	if (isset($_GET['id_modificar']))
	{
						
	}
	else
	{
							echo 'none';
	}			 ?>;


id="idimagen" src="<?php echo @$prog_modificar[0]['Imagen']; ?>" height="250" width="250">
			
<br>
<br>	
</div>	

       
<div class="col-md-4 col-md-offset-4">
<input type="submit" id="btninsertar" name="btninsertar" value="<?php 
						
						if (isset($_GET['id_modificar']))
						{
							echo 'Modificar';
						}
						else
						{
							echo 'Registrar';
						}			 ?>" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>

<br><br>



				</div>
			</form>
		</div>
	</div>
</div>
	<script src="js/formulario.js"></script>

<br><br>
<div class="container" id="buscar">
<div id="listado" data-section="listado">

<div class="divider-custom divider-light">
<div class="divider-custom-line"></div>
<!--<div class="divider-custom-icon"><i class="fas fa-star"></i></div>-->
<div class="divider-custom-line"></div>
</div>




<div align="center" class="jumbotron" >
<form action="programas.edu.php#buscar" method="post"><br>
<h1>Registros guardados</h1>
    

<label for="" class="control">Nombre a buscar</label>

<input type="text" id="txtbuscar" name="txtbuscar" style=" width:320px; height:35px;" class="" >

	<!--<div class="col-lg-2">
<select class="form-control" id="txtbuscarpor" name="txtbuscarpor">
<option value="nombre">Nombre del programas</option>
<option value="abrev">Abreviación</option>
				
    </select>
</div>-->

<input type="submit" id="btnbuscar" name="btnbuscar" value="Buscar"  class="btn btn-info">


<br><br>






<table class="table table-hover">


<tr>
    
    
    
      <td align="center" >ID</td>
      <td align="center">Nombre</td>
      <td align="center">Status</td>
      <td align="center">Abreviación</td>
      <td align="center">Año</td>
      <td align="center">Imagen</td>
      <td colspan="2" style="text-align: center;">Acción</td>
       
     
		
</tr>
<?php foreach ($programas as $registro) {	 ?>
<tr>

<td><?php echo $registro['id_pe']; ?></td>
<td><?php echo $registro['nombre']; ?></td>
<td><?php echo $registro['status']; ?></td>
<td><?php echo $registro['abrev']; ?></td>
<td><?php echo $registro['generacion']; ?></td>
<td><img src="<?php if(isset($registro['Imagen']))
{
$registro['Imagen'];
}
else
{
    echo "img/img/sin.imagen.jpg";
}
?>" height="100" width="200"></td>

   

		 

<td align="center"><a class="btn btn-danger" href="programas.edu.php?id_eliminar=<?php echo "{$registro['valor']} !"; ?> ?>#buscar" onclick="return ConfirmDelete()">Eliminar</a></td>
		<td align="center"><a class="btn btn-primary"  href="programas.edu.php?id_modificar=<?php echo $registro['id_pe'];?>#registrar">Modificar</a></td>
           </tr>  




</tr>
<?php } ?>
</table>
</div>
</div>  

	</form>

</div></div>
	</div></div>




<footer class="footer">
		<div class="container">
 
			<div class="footer_copyright" style="font-size: 15px">
					<span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                         Copyright  ©2020|<script>document.write(new Date().getFullYear());</script>  Universidad Tecnológica del Norte de Coahuila by 
                         <a href="https://www.utnc.edu.mx/" target="_blank">Alumnos TIADSM - Yulissa Rodriguez | Josué Cruz | Mireya Fiscal | Andrés Valerio.</a>

	<!--<div class="footer_social ml-sm-auto">
					<ul class="menu_social">
						
						<li class="menu_social_item"><a href="https://www.instagram.com/utnortecoahuila/#"><i class="fab fa-instagram"></i></a></li>
						<li class="menu_social_item"><a href="https://www.facebook.com/Utnortecoahuila#"><i class="fab fa-facebook-f"></i></a></li>
						
					</ul>
				</div>-->
			

		</div>
   <br>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

