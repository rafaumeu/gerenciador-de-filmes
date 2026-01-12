<h1 class="mt-6 font-bold text-lg mt-6">Explorar</h1>
<form class="w-full flex space-x-2 mt-6">
  <input type="text" name="pesquisar" class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="Pesquisar..." name="pesquisar" />
  <button type="submit">🔎</button>
</form>
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
  <?php foreach ($livros as $livro) { ?>
    <?php require 'partials/_livro.php'; ?>
  <?php } ?>
</section>