$(document).on("ready",gogo);

function obtiene_http_request()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = obtiene_http_request();

function ajax(id,ide,url)
{

         var mi_aleatorio=parseInt(Math.random()*99999999);
   var vinculo=url+"?id="+id+"&rand="+mi_aleatorio;
    miPeticion.open("GET",vinculo,true);
    miPeticion.onreadystatechange=miPeticion.onreadystatechange=function()
      {
              if (miPeticion.readyState==4)
                {
          if (miPeticion.status==200)
                  {
                    var http=miPeticion.responseText;
                    document.getElementById(ide).innerHTML= http;
                   }
                }
      }
  miPeticion.send(null);
}


function probar()
{
  alert("o.o");
}






/*probando otro script de terceros*/

var conexion;
function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}
function consultar(valor)
{
    conexion=crearXMLHttpRequest();
    conexion.onreadystatechange = procesarEventos;
    conexion.open('GET', 'verAlbum.php?id=' + valor, true);
    conexion.send(null);
}

function procesarEventos()
{
  var detalles = document.getElementById("baja0");
  if(conexion.readyState == 4)
  {
    detalles.innerHTML = conexion.responseText;
  } 
  else 
  {
    detalles.innerHTML = 'Cargando...';
  }
}
/*

var conexion;
function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}
function consultar(valor)
{
    conexion=crearXMLHttpRequest();
    conexion.onreadystatechange = procesarEventos;
    conexion.open('GET', 'meses.php?num=' + valor, true);
    conexion.send(null);
}

function procesarEventos()
{
  var detalles = document.getElementById("resultado");
  if(conexion.readyState == 4)
  {
    detalles.innerHTML = conexion.responseText;
  } 
  else 
  {
    detalles.innerHTML = 'Cargando...';
  }
}
*/


function ajaxFunction() {
  var xmlHttp;
  
  try {
   
    xmlHttp=new XMLHttpRequest();
    return xmlHttp;
  } catch (e) {
    
    try {
      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      return xmlHttp;
    } catch (e) {
      
    try {
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        return xmlHttp;
      } catch (e) {
        alert("Tu navegador no soporta AJAX!");
        return false;
      }}}
}




function Enviar(_pagina,capa) {
    document.getElementById(capa).innerHTML="<img src='ima/cargando.gif' width='50px' height='50px'>";
    var ajax;
    ajax = ajaxFunction();
    ajax.open("POST", _pagina, true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function() {
    if (ajax.readyState==1){
      document.getElementById(capa).innerHTML = " Aguarde por favor...";
           }
    if (ajax.readyState == 4) {
       
                
                document.getElementById(capa).innerHTML=ajax.responseText; 
         }}
       
  ajax.send(null);
} 
