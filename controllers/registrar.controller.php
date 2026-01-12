<?php
require "Validacao.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $validacao = Validacao::validar([
    'nome' => ['required'],
    'email' => ['required', 'email', 'confirmed', 'unique:usuarios'],
    'senha' => ['required', 'min:8', 'max:30', 'strong'],
  ], $_POST);

  if ($validacao->naoPassou('registrar')) {
    header('location: /login');
    exit();
  }

  $DB->query(
    query: 'insert into usuarios (email,senha, nome) values (:email,:senha, :nome)',
    params: [
      'nome' => $_POST['nome'],
      'email' => $_POST['email'],
      // 'email_confirmacao' => $_POST['email_confirmacao'],
      'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
    ]
  );
  flash()->push('mensagem', 'Registrado com sucesso');
  header("location: /login");
  exit();
}
header("location: /login");
exit();
