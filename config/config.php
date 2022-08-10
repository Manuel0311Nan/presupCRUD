<?php

require_once(dirname(__FILE__) . '/../src/functions.php');

//Información sobre la base de datos y conexión a la API
// define('DOMAIN', 'https://azkenservices.com/presupuestos');    //Enlace a la carpeta donde está alojada la plataforma
define('SERVER', 'localhost');                                                             //IP al servidor donde está alojada la plataforma. Por defecto localhost:3306
define('USER', 'root');                                                                 //Usuario de la base de datos. Será el nombre-de-la-empresa_nombre-evento
define('PASS', '');                                             //Contraseña de la base de datos. Igual para todas
define('DATABASE', 'presupuestos');                                                 //Contraseña de la base de datos. Igual para todas
// define('LINK_LOGO', DOMAIN . '/public/assets/img/logo.jpeg');                                                   //Logo
// define('IMAGE_BACKGROUND', DOMAIN . '/assets/img/background.png');                                                   //background
// define('FAVICON', 'https://azkenservices.com/wp-content/uploads/2021/08/cropped-as-isotipo-192x192.png');                                                   //favicon
//¿No sabes cómo obtener el md5(texto) para configurarlo en Plesk? Entra en el siguiente enlace: http://www.md5.cz/


//Ajustes del servidor de PHP
ini_set('display_errors', 1);                                                           //¿Hay un problema en PHP y necesitas visualizar el error? 0 para ocultar errores, 1 para mostrar errores
date_default_timezone_set('Europe/Madrid');                                             //Estableces la hora de madrid para las variables de fecha y hora del servidor. No modificar                                              

