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
  $review->user->reviews_count = $DB->query(
    query: 'select count(*) as total from reviews where user_id = :user_id',
    params: ["user_id" => $review->user_id]
  )->fetch()["total"];
}
view("movies", ["movie" => $movie, "ratings" => $reviews]);
