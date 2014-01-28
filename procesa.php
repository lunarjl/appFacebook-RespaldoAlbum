<link rel="stylesheet"  href="css/normalize.css">
<link rel="stylesheet"  href="css/styleRespaldo.css">
<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>


<?php 
//creado por jose luis luna rubio -probando solo eso-
require_once('../../src/facebook.php');

$config = array
  (
    'appId' => 'xxxxxx',
    'secret' => 'xxxxxx',
  );

$fb = new facebook($config);

$config = array
  (
    'appId' => 'xxxxxx',
    'secret' => 'xxxxxxxx',
  );
$facebook = new facebook($config);

$query=array(
 "locations"=>"SELECT aid, cover_pid, name, owner,photo_count FROM album WHERE owner=me()",
 "names"=>"SELECT src_big,aid FROM photo WHERE pid IN (SELECT cover_pid FROM #locations)");
 
$response=$facebook->api(array(
  'method' => 'fql.multiquery',
  'queries' => $query
));

$consultaGeneral="SELECT pic, name, locale, username, pic_big_with_logo FROM user WHERE uid =me()";
$dG=$facebook->api(array(
	'method' => 'fql.query',
	'query' => $consultaGeneral
	 ));

//$datosGenerales = $facebook -> api("/me");
//echo $registros;
//echo "cover_pid : ".$response[0]["fql_result_set"][0]["cover_pid"]."</br>";
//var_dump($response);
//echo "<pre>".print_r($response,true)."</pre>";
?>
<header>
		<div id="avatar">
			<img src="<?php echo $dG[0]['pic_big_with_logo'];?>" width="150px" alt="avatarUsuario">
		</div>
		<div id="barra">
			<p><?php echo $dG[0]["name"];?></br><?php echo $dG[0]["username"];?></br><?php echo $dG[0]["locale"];?></p>
			<p class="tituloAplicacion">Respaldo Album</p>
		</div>
	</header>	


	<section id="contPri">
		<div id="contAlbum">		
<?php 
$registros=count($response[0]["fql_result_set"])."</br>";
for ($i=0; $i <=$registros-1 ; $i++) { 
?>
		<article>
			<figure>
				<span class="icono">
					<a href="javascript: Enviar('verAlbum.php?id=<?php echo $response[0]['fql_result_set'][$i]['aid'];?>','baja<?php echo $i;?>');">
						<img   src="ima/guardar.png" alt="guardarNombreDelAlbum" width="50" height="50">
						<p ><?php echo $response[0]['fql_result_set'][$i]['photo_count'];?></p>
					</a>
				</span>
				<span class="iconoZip" id="baja<?php echo $i;?>">
					<!--<a href="">
						<img src="ima/zip.png" alt="guardarNombreDelAlbum" width="50" height="50">
					</a>
				-->
				</span>
	
				<img src="<?php echo $response[1]['fql_result_set'][$i]['src_big'];?>" alt="nombreDelAlbum" width="200" height="200" class="cover"/>
					<figcaption>
						<p><?php echo $response[0]['fql_result_set'][$i]['name'];?></p>
					</figcaption>
			</figure>
		</article>
<?php } ?>
		</div>
	</section>

	<section id="accionesPendientes">
		<div id="resultado">
			
		</div>
	</section>

	<footer>
		<p>chiwiscor 2014</p>			
	</footer>