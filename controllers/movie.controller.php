<?php
$movie = Movie::get($_GET['id']);
$reviews = $DB->query(
  query: 'select * from reviews where movie_id = :id',
  class: Review::class,
  params: ['id' => $_GET['id']]
)->fetchAll();
foreach ($reviews as $review) {
  $review->user = $DB->query(
    query: 'select * from users where id = :id',
    class: User::class,
    params: ["id" => $review->user_id]
  )->fetch();
}
view("movie", ["movie" => $movie, "reviews" => $reviews]);
