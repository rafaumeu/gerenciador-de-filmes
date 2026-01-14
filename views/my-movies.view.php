<?php $errors = flash()->get('validations_movie'); ?>
<div x-data="{ 
open: <?= (!empty($errors) ? 'true' : 'false') ?>,
        posterUrl: null,
        fileChosen(event) {
        let file= event.target.files[0];
        if(file){
            let reader = new FileReader();
            reader.onload = (e) => this.posterUrl = e.target.result;
            reader.readAsDataURL(file);
        }
    }
 }">
  <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">

    <h1 class="font-display text-3xl font-bold">Meus Filmes</h1>
    <div class="flex items-center gap-4">
      <?php require 'partials/_search.php' ?>
      <button @click="open = true" class="bg-purple-base hover:bg-purple-light text-white font-bold py-2 px-4 rounded flex item-center gap-2 transition-colors">
        <i class="ph ph-plus text-lg"></i> Novo
      </button>
    </div>
  </div>
  <?php if (empty($movies)): ?>
    <div class="flex flex-col items-center justify-center h-[50vh] text-center opacity-60">
      <i class="ph ph-film-slate text-6xl text-gray-600 mb-4"></i>
      <h2 class="text-xl font-bold text-gray-500 mb-2">
        Nenhum filme registrado
      </h2>
      <p class="text-gray-500 mb-6">Que tal começar cadastrando seu primeiro filme?</p>
      <button @click="open = true" class="bg-purple-base hover:bg-purple-light text-white font-bold py-2 px-4 rounded flex item-center gap-2 transition-colors">
        <i class="ph ph-plus text-lg"></i> Novo
      </button>
    </div>
  <?php else: ?>
    <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <?php foreach ($movies as $movie) {
        require_once 'partials/_movie.php';
      } ?>
    </section>
  <?php endif; ?>
  <div
    x-show="open" style="display: none;"
    class="fixed inset-0 z-50 flex item-center justify-center bg-black/80 backdrop-blur-sm"
    x-transition.opacity>
    <div class="bg-gray-900 border border-gray-800 rounded-lg shadow-2xl w-full max-w-6xl p-8 relative" @click.away="open = false">
      <button @click="open = false" class="absolute top-4 right-4 text-gray-500 hover:text-purple-base">
        <i class="ph ph-x text-xl"></i>
      </button>
      <h2 class="font-display text-xl font-bold mb-6 text-gray-600">Novo filme</h2>
      <form action="/create-movie" method="POST" enctype="multipart/form-data" class="flex flex-col md:flex-row gap-8">
        <div class="w-full md:w-5/12">
          <div class="space-y-1">
            <label class="relative overflow-hidden flex flex-col items-center justify-center w-full h-[440px] border-2 border-dashed border-gray-700 rounded-lg hover:border-purple-500 hover:bg-gray-800 transition-all cursor-pointer bg-gray-800/30">
              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <i class="ph ph-upload-simple text-4xl text-purple-500 mb-4"></i>
                <p class="mb-2 text-sm text-gray-400">Fazer upload</p>
              </div>
              <img x-show="posterUrl" :src="posterUrl" class="absolute inset-0 w-full h-full object-cover">
              <input type="file" name="poster" @change="fileChosen" class="hidden">
            </label>
          </div>
        </div>
        <div class="w-full md:w-7/12 flex flex-col justify-between">
          <div class="space-y-4">

            <div class="relative">
              <i class="ph ph-film-slate absolute left-4 top-1/2 -translate-y-1/2 <?= isset($errors['title']) ? 'text-red-500' : 'text-gray-500' ?>"></i>
              <input type="text" name="title" placeholder="Título" value="<?= old('title') ?>" class="w-full bg-gray-900 border border-gray-700 rounded-lg block pl-10 p-3 text-gray-600 placeholder-gray-500 focus:outline-none focus:border-purple-base focus:ring-1 transition-colors <?= isset($errors['title']) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-700 focus:border-purple-base focus:ring-purple-500' ?>">
              <?php if (isset($errors['title'])): ?>
                <div class="text-red-400 text-xs mt-1 mb-1 absolute -bottom-5 left-0">
                  <?= $errors['title'][0] ?>
                </div>
              <?php endif; ?>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class="relative">
                <i class="ph ph-user absolute left-4 top-1/2 -translate-y-1/2 <?= isset($errors['director']) ? 'text-red-500' : 'text-gray-500' ?>"></i>
                <input type="text" name="director" placeholder="Diretor" value="<?= old('director') ?>" class="w-full bg-gray-900 border border-gray-700 rounded-lg block pl-10 p-3 text-gray-600 placeholder-gray-500 focus:outline-none focus:border-purple-base focus:ring-1 transition-colors <?= isset($errors['director']) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-700 focus:border-purple-base focus:ring-purple-500' ?>">
                <?php if (isset($errors['director'])): ?>
                  <div class="text-red-400 text-xs mt-1 mb-1 absolute -bottom-5 left-0">
                    <?= $errors['director'][0] ?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="relative">
                <i class="ph ph-calendar-blank absolute left-4 top-1/2 -translate-y-1/2 <?= isset($errors['year']) ? 'text-red-500' : 'text-gray-500' ?>"></i>
                <input type="number" name="year" placeholder="Ano" value="<?= old('year') ?>" class="w-full bg-gray-900 border border-gray-700 rounded-lg block pl-10 p-3 text-gray-600 placeholder-gray-500 focus:outline-none focus:border-purple-base focus:ring-1 transition-colors <?= isset($errors['year']) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-700 focus:border-purple-base focus:ring-purple-500' ?>">
                <?php if (isset($errors['year'])): ?>
                  <div class="text-red-400 text-xs mt-1 mb-1 absolute -bottom-5 left-0">
                    <?= $errors['year'][0] ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div class="relative">
                <i class="ph ph-clock absolute left-4 top-1/2 -translate-y-1/2 <?= isset($errors['duration']) ? 'text-red-500' : 'text-gray-500' ?>"></i>
                <input type="number" name="duration" placeholder="Duração" value="<?= old('duration') ?>" class="w-full bg-gray-900 border border-gray-700 rounded-lg block pl-10 p-3 text-gray-600 placeholder-gray-500 focus:outline-none focus:border-purple-base focus:ring-1 transition-colors <?= isset($errors['duration']) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-700 focus:border-purple-base focus:ring-purple-500' ?>">
                <?php if (isset($errors['duration'])): ?>
                  <div class="text-red-400 text-xs mt-1 mb-1 absolute -bottom-5 left-0">
                    <?= $errors['duration'][0] ?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="relative">
                <i class="ph ph-tag absolute left-4 top-1/2 -translate-y-1/2 <?= isset($errors['genre']) ? 'text-red-500' : 'text-gray-500' ?>"></i>
                <input type="text" name="genre" placeholder="Categoria" value="<?= old('genre') ?>" class="w-full bg-gray-900 border border-gray-700 rounded-lg block pl-10 p-3 text-gray-600 placeholder-gray-500 focus:outline-none focus:border-purple-base focus:ring-1 transition-colors <?= isset($errors['genre']) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-700 focus:border-purple-base focus:ring-purple-500' ?>">
                <?php if (isset($errors['genre'])): ?>
                  <div class="text-red-400 text-xs mt-1 mb-1 absolute -bottom-5 left-0">
                    <?= $errors['genre'][0] ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="relative">
              <textarea name="description" rows="6" placeholder="Descrição" value="<?= old('description') ?>" class="w-full bg-gray-900 border border-gray-700 rounded-lg block pl-10 p-3 text-gray-600 placeholder-gray-500 focus:outline-none focus:border-purple-base focus:ring-1 transition-colors <?= isset($errors['description']) ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : 'border-gray-700 focus:border-purple-base focus:ring-purple-500' ?> resize-none"><?= old('description') ?></textarea>
              <?php if (isset($errors['description'])): ?>
                <div class="text-red-400 text-xs mt-1 mb-1 absolute -bottom-5 left-0">
                  <?= $errors['description'][0] ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="flex items-center justify-end gap-4 mt-8">
            <button
              type="button"
              @click="open = false"
              class="text-gray-400 hover:text-white font-medium transition-colors">
              Cancelar
            </button>
            <button type="submit" class="bg-purple-base hover:bg-purple-light text-white font-bold py-2.5 px-8 rounded-lg transition-colors shadow-lg shadow-purple-900/20">
              Salvar Filme
            </button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>