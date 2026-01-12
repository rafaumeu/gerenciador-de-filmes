<?php
$path = parse_url($_SERVER["REQUEST_URI"])["path"];
$controller = str_replace("/", "", $path);
if (!$controller) $controller = 'index';
$controllerFile = "../controllers/{$controller}.controller.php";


if (!file_exists($controllerFile)) {
  abort(404);
}

require $controllerFile;
