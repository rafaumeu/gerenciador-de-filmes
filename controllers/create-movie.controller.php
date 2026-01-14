<?php
require __DIR__ . '/../Validation.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("Location: /movies");
  exit();
}

if (!auth()) {
  abort(403);
}

$user_id = auth()->id;
$title = $_POST['title'];
$director = $_POST['director'];
$description = $_POST['description'];
$year = $_POST['year'];

$validation = Validation::validate([
  "title" => ["required", "min:3", "max:255"],
  "director" => ["required", "min:3", "max:255"],
  "description" => ["required", "min:3"],
  "year" => ["required", "min:4", "max:4"],
  "duration" => ["required", "min:1"],
  "genre" => ["required", "min:3", "max:255"],
], data: $_POST);

if ($validation->fails('movie')) {
  $_SESSION['old'] = $_POST;
  header('location: /my-movies');
  exit();
}


$novoNome = md5(rand());
$extensao = pathinfo($_FILES['poster']['name'], PATHINFO_EXTENSION);
$poster = "images/$novoNome.$extensao";
move_uploaded_file($_FILES['poster']['tmp_name'], __DIR__ . "/../public/$poster");
$DB->query(
  query: "insert into movies(title, director, description, year, user_id, poster, duration, genre) values(:title, :director, :description, :year, :user_id, :poster, :duration, :genre)",
  params: compact("title", "director", "description", "year", "user_id", "poster", "duration", "genre")
);
flash()->push("mensagem", "Filme criado com sucesso!");
header("Location: /my-movies");
exit();
