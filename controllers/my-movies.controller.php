<?php
if (!auth()) {
  header("Location: /");
  exit();
}
$movies = Movie::meus(auth()->id);
view("my-movies", compact('movies'));
