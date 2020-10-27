<?php

  session_start();
  ob_start();

  define('PATH', realpath('.'));
  define('SUBFOLDER', subfolder($_SERVER['SCRIPT_NAME']));
  define('URL', url($_SERVER['HTTP_HOST'], $_SERVER['SCRIPT_NAME']));

  function subfolder($script_name){
    return dirname($_SERVER['SCRIPT_NAME']) === '\\' || dirname($script_name) == '/' ? 0 : 1;
  }

  function route($request){
    $request = explode("?", $request);
    $request = explode('/', $request[0]);

    foreach ($request as $val)
      if(!empty($val))
        $route [] = $val;

    if(SUBFOLDER == true)
      array_shift($route);

    if(!isset($route[0]))
      $route[0] = 'index';

    return $route;
  }

  function url($host, $script){

    $protocol = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : "http";
    $script   = dirname($script) == "\\" || dirname($script) == '/'
      ? '/'
      : dirname($script) . '/';

    return $protocol . '://' . $host . $script;
  }

  require_once(PATH . '/app/init.php');

?>
