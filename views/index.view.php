<div class="flex justify-between items-center mb-10">
  <h1 class="font-display text-3xl font-bold">Explorar</h1>
  <?php require 'partials/_search.php' ?>
</div>
<?php if (empty($movies)): ?>
  <div class="flex flex-col items-center justify-center py-20 text-center opacity-60">
    <i class="ph ph-film-strip text-6xl text-gray-600 mb-4"></i>
    <h2 class="text-xl font-bold text-gray-500 mb-2">
      Nenhum filme encontrado "<?= htmlspecialchars($_REQUEST['search'] ?? '') ?>"
    </h2>
    <p class="text-gray-400 mb-6">Que tal tentar outra busca?</p>
    <a href="/" class="text-purple-base hover:text-purple-light font-bold hover:underline">
      <i class="ph ph-x"></i>
      Limpar filtro
    </a>
  </div>
<?php else: ?>
  <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($movies as $movie) { ?>
      <?php require 'partials/_movie.php'; ?>
    <?php } ?>
  </section>
<?php endif; ?>