<?php
require __DIR__ . '/../Validation.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $validation = Validation::validate([
    'name' => ['required'],
    'email' => ['required', 'email', 'confirmed', 'unique:users'],
    'password' => ['required', 'min:8', 'max:30', 'strong'],
  ], $_POST);

  if ($validation->fails('registrar')) {
    header('location: /login');
    exit();
  }

  $DB->query(
    query: 'insert into users (email,password, name) values (:email,:password, :name)',
    params: [
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'email_confirmation' => $_POST['email_confirmation'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]
  );
  flash()->push('mensagem', 'Registrado com sucesso');
  header("location: /login");
  exit();
}
header("location: /login");
exit();
