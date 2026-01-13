<?php

/**
 * Representação de um registro do banco de dados
 */
class Movie
{
  public $id;
  public $title;
  public $duration;
  public $director;
  public $year;
  public $genre;
  public $description;
  public $poster;

  public $user_id;


  public static function query($where, $params = [])
  {
    $DB = new Database(config('database'));
    return $DB->query(
      query: "select 
   m.id, 
   m.title, 
   m.duration, 
   m.director, 
   m.year, 
   m.genre, 
   m.description, 
   m.poster,
   ifnull(round(sum(a.rating) / 5.0),0) as nota_avaliacao, 
   ifnull(count(a.id),0) as count_avaliacoes 
   from movies m
   left join reviews a on a.movie_id = m.id 
   where $where
   group by m.id, m.title, m.duration, m.director, m.year, m.genre, m.description, m.poster",
      class: self::class,
      params: $params
    );
  }
  public static function get($id)
  {
    return self::query(
      where: "l.id = :id",
      params: ['id' => $id]
    )->fetch();
  }
  public static function all($filter)
  {
    return self::query(
      where: "title like :filter or director like :filter or description like :filter",
      params: ['filter' => "%$filter%"]
    )->fetchAll();
  }

  public static function meus($user_id)
  {
    return self::query(
      where: "m.user_id = :user_id",
      params: ['user_id' => $user_id]
    )->fetchAll();
  }
}
