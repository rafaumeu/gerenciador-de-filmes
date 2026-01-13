<?php
$movies = Movie::all($_REQUEST["search"] ?? "");
view("index", ["movies" => $movies]);
