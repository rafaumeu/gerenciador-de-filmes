<h1><?= $livro->titulo ?></h1>
<?php require_once 'partials/_livro.php'; ?>
<h2>Avaliações <?= count($avaliacoes) ?></h2>
<div class="grid grid-cols-4 gap-4">
  <div class="col-span-3 gap-4">
    <?php foreach ($avaliacoes as $avaliacao): ?>
      <div class="border border-stone-700 rounded">
        <div class="border-b border-stone-700 flex justify-between items-center">
          <h2 class="text-stone-400 font-bold px-4 py-2"><?= $avaliacao->usuario->nome ?></h2>
          <span class="text-sm">Nota: <?= str_repeat("⭐", $avaliacao->nota) ?></span>
        </div>
        <div class="px-4 py-2">
          <?= $avaliacao->avaliacao ?>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
  <?php if (auth()): ?>
    <div class="border border-stone-700 rounded">
      <h2 class="border-b border-stone-700 text-stone-400 font-bold px-4 py-2">Me conte o que achou!</h2>
      <form class="space-y-2 space-x-4" method="post" action="avaliacao-criar">
        <?php if ($validacoes = flash()->get('validacoes_avaliacao')): ?>
          <div class="bg-red-900 border-red-800 border-2 px-4 py-2 rounded text-sm font-bold text-red-300">
            <ul>
              <li>Dê uma olhada nos erros abaixo</li>
              <?php foreach ($validacoes as $validacao): ?>
                <li><?= $validacao; ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <input type="hidden" name="livro_id" value="<?= $livro->id ?>">
        <label class="text-stone-500 mb-px">Avaliação</label>
        <textarea class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="digite sua avaliação" name="avaliacao"></textarea>
        <div class="flex flex-col">
          <label class="text-stone-500 mb-px">Nota</label>
          <select class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" name="nota">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>
        <button type="submit" class="border-lime-800 bg-lime-900 px-4 py-2 rounded-md border border-2 hover:bg-lime-800">Salvar</button>
      </form>

    </div>
  <?php endif; ?>
</div>