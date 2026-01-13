<?php
require "Validation.php";
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header("location: /");
  exit();
}
$user_id = auth()->id;
$movie_id = $_POST['movie_id'];
$review = $_POST['review'];
$rating = $_POST['rating'];

$validation = Validation::validate([
  'review' => ['required'],
  'rating' => ['required']
], $_POST);

if ($validation->fails('review')) {
  header("location: /movie?id=$movie_id");
  exit();
}
$DB->query(
  query: "insert into reviews (user_id, movie_id, review, rating) 
values (:user_id, :movie_id, :review, :rating)",
  params: compact('user_id', 'movie_id', 'review', 'rating')
);
flash()->push('mensagem', 'Avaliação criada com sucesso');
header("location: /movie?id=$movie_id");
exit();
