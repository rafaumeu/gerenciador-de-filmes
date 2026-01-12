<?php
require 'Validacao.php';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("Location: /livros");
  exit();
}

if (!auth()) {
  abort(403);
}

$usuario_id = auth()->id;
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$descricao = $_POST['descricao'];
$ano_lancamento = $_POST['ano_lancamento'];

$validacao = Validacao::validar(regras: [
  "titulo" => ["required", "min:3", "max:255"],
  "autor" => ["required", "min:3", "max:255"],
  "descricao" => ["required", "min:3"],
  "ano_lancamento" => ["required", "min:4", "max:4"],
], dados: $_POST);

if ($validacao->naoPassou('livro')) {
  header('location: /meus-livros');
  exit();
}


$novoNome = md5(rand());
$extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
$imagem = "images/$novoNome.$extensao";
move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . "/../public/$imagem");
$DB->query(
  query: "insert into livros(titulo, autor, descricao, ano_lancamento, usuario_id, imagem) values(:titulo, :autor, :descricao, :ano_lancamento, :usuario_id, :imagem)",
  params: compact("titulo", "autor", "descricao", "ano_lancamento", "usuario_id", "imagem")
);
flash()->push("mensagem", "Livro criado com sucesso!");
header("Location: /meus-livros");
exit();
