<?php
function view($viewName, $data = [], $template = 'app')
{
  extract($data);
  $view = $viewName;
  require "views/template/{$template}.php";
}
function dd(...$dump)
{
  dump($dump);
  exit();
}

function dump(...$dump)
{
  echo "<pre>";
  var_dump($dump);
  echo "</pre>";
}
function abort($code)
{
  http_response_code($code);
  view($code);
  die();
}

function flash()
{
  return new Flash;
}


function config($chave = null)
{
  $config = require 'config.php';
  if (strlen($chave) > 0) {
    return $config[$chave];
  }
  return $config;
}

function auth()
{
  if (!isset($_SESSION['auth'])) {
    return null;
  }
  return $_SESSION['auth'];
}

function old($key)
{
  if (isset($_SESSION['old']) && array_key_exists($key, $_SESSION['old'])) {
    $dado = $_SESSION['old'][$key];
    unset($_SESSION['old'][$key]);
    return $dado;
  }
  return '';
}
