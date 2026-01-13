<div class="flex justify-between items-center mb-10">
  <h1 class="font-display text-3xl font-bold">Explorar</h1>
  <form class="w-full max-w-sm relative">
    <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-lg"></i>
    <input
      type="text"
      name="search"
      class="w-full bg-gray-200 rounded-lg py-3 pl-12 pr-4 text-sm text-gray-700 border border-transparent placeholder-gray-500 focus:outline-none focus:border-purple-base transition-colors"
      placeholder="Pesquisar..." />
  </form>
</div>
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
  <?php foreach ($livros as $livro) { ?>
    <?php require 'partials/_livro.php'; ?>
  <?php } ?>
</section>