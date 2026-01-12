<?php

/**
 * Representação de um registro do banco de dados
 */
class Livro
{
  public $id;
  public $titulo;
  public $autor;
  public $descricao;
  public $avaliacoes;

  public $ano_lancamento;
  public $nota_avaliacao;
  public $count_avaliacoes;
  public $image;

  public static function query($where, $params = [])
  {
    $DB = new Database(config('database'));
    return $DB->query(
      query: "select 
   l.id, 
   l.titulo, 
   l.ano_lancamento, 
   l.autor, 
   l.descricao, 
   l.imagem,
   ifnull(round(sum(a.nota) / 5.0),0) as nota_avaliacao, 
   ifnull(count(a.id),0) as count_avaliacoes 
   from livros l
   left join avaliacoes a on a.livro_id = l.id 
   where $where
   group by l.id, l.titulo, l.ano_lancamento, l.autor, l.descricao, l.imagem",
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
  public static function all($filtro)
  {
    return self::query(
      where: "titulo like :filtro or autor like :filtro or descricao like :filtro",
      params: ['filtro' => "%$filtro%"]
    )->fetchAll();
  }

  public static function meus($usuario_id)
  {
    return self::query(
      where: "l.usuario_id = :usuario_id",
      params: ['usuario_id' => $usuario_id]
    )->fetchAll();
  }
}
