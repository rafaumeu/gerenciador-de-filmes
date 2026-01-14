<?php
require __DIR__ . "/../Validation.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $validation = Validation::validate([
    'email' => ['required', 'email'],
    'password' => ['required']
  ], $_POST);

  if ($validation->fails('login')) {
    header('location: /login');
    exit();
  }

  $user = $DB->query(
    query: "select * from users where email = :email",
    class: User::class,
    params: [
      'email' => $email,
    ]
  )->fetch();
  if ($user && password_verify($password, $user->password)) {
    $_SESSION['auth'] = $user;
    flash()->push('mensagem', 'Seja bem-vindo(a) ' . $user->name . '!');
    header("location: /");
    exit();
  } else {
    flash()->push('validations_login', ["Usuário ou senha incorretos"]);
  }
}
view('login');
false;
