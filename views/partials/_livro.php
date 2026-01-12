<div class="p-2 border-stone-800 border-2 rounded bg-stone-900">
  <div class="flex gap-2">

    <div class="w-1/3">
      <img class="w-60 rounded object-cover" src="<?= $livro->imagem ?>" alt="<?= $livro->titulo ?>">
    </div>
    <div class="flex flex-col gap-2">
      <a href="/livro?id=<?= $livro->id ?>" class="font-semibold hover:underline"><?= $livro->titulo ?></a>
      <div class="text-xs italic"><?= $livro->autor ?></div>
      <div class="text-xs italic">
        <?= str_repeat('⭐', $livro->nota_avaliacao) ?> (<?= $livro->count_avaliacoes ?> <?php if ($livro->count_avaliacoes == 1) echo "Avaliação";
                                                                                        else echo "Avaliações"; ?>)
      </div>
    </div>
  </div>

  <div class="text-sm mt-2">
    <?= $livro->descricao ?>
  </div>
</div>