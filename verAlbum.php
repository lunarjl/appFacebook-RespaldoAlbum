<?php
require_once("zipfile.php");
require_once('../../src/facebook.php');

include "pclzip.lib.php";


$config = array
  (
    'appId' => 'xxxxxxx',
    'secret' => 'xxxxxxxxxx',
  );

$fb = new facebook($config);

$consulta="SELECT  aid,src_big FROM photo WHERE aid='".$_GET["id"]."'";

$fql=$fb->api(array(
  'method'  => 'fql.query',
  'query'   =>  $consulta
));

function crearDirectorio($directorio)
{
  
  if (file_exists($directorio)) 
  {
    rmdir($directorio);     
    mkdir($directorio, 0755);
    
  }else
  {
    mkdir($directorio, 0755); 
    
  }

}

function recibe_imagen ($url_origen,$archivo_destino)
{ 
  $mi_curl = curl_init ($url_origen); 
  $fs_archivo = fopen ($archivo_destino, "w"); 
  curl_setopt ($mi_curl, CURLOPT_FILE, $fs_archivo); 
  curl_setopt ($mi_curl, CURLOPT_HEADER, 0); 
  curl_exec ($mi_curl); 
  curl_close ($mi_curl); 
  fclose ($fs_archivo); 
}

function listarArchivos( $path )
{
    $listadoArchivos=array();
    // Abrimos la carpeta que nos pasan como parámetro
    $dir = opendir($path);
    // Leo todos los ficheros de la carpeta
    while ($elemento = readdir($dir))
    {
        // Tratamos los elementos . y .. que tienen todas las carpetas
        if( $elemento != "." && $elemento != "..")
        {
            // Si es una carpeta
            if( is_dir($path.$elemento) )
            {
                // Muestro la carpeta
                //echo "<p><strong>CARPETA: ". $elemento ."</strong></p>";
            // Si es un fichero
            } else 
            {
                // Muestro el fichero
                //echo "<br />". $elemento;
                array_push($listadoArchivos,$path."/".$elemento);
            }
        }
    }
  return ($listadoArchivos);
}

function comprimepcl($archivosadd,$nombrezip)
{
      $archivo = new PclZip( $nombrezip.".zip" );

    /* Podemos especificar los archivos pasandolos como un arreglo */
    //$nuevos_archivos = array( "relleno1.txt" , "relleno2.txt" );

    /* Llamamos al metodo para agregar los $nuevos_archivos a vacio.zip */
    $agregar = $archivo->add( $archivosadd, PCLZIP_OPT_ADD_PATH , "bychiwiscor" );

    /* Gestionar error ocurrido (si $archivo->add() retorna cero a $agregar) */
    if ( !$agregar ) {
      echo "ERROR. Codigo: ".$archivo->errorCode()." ";
      echo "Nombre: ".$archivo->errorName()." ";
      echo "Descripcion: ".$archivo->errorInfo();
    } else {
      //echo "Archivos agregados exitosamente!";
        echo "
    <a href='".$nombrezip.".zip' target='_blank' alt='bajar'> 
      <img src='ima/zip.png'>
    </a>
    ";
    }

}

crearDirectorio($_GET["id"]);

for ($i=0; $i <=count($fql)-1; $i++) 
{ 
   recibe_imagen($fql[$i]["src_big"],$_GET["id"]."/fotografia".$i.".jpg");    
}
$listaArchivosCopiados=listarArchivos($_GET["id"]);
comprimepcl($listaArchivosCopiados,$_GET["id"]);
?>