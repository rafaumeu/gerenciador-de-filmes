<?php $databaseReviewErrors = flash()->get('validations_review'); ?>

<div class="space-y-8">

  <div class="flex flex-col md:flex-row gap-8">
    <div class="w-full md:w-[350px] flex-shrink-0">
      <img src="<?= $movie->poster ?>" alt="<?= $movie->title ?>" class="w-full rounded-lg shadow-lg object-cover aspect-[2/3] border border-gray-800">
    </div>
    <div class="flex-1 flex flex-col justify-center h-full">
      <a href="/" class="inline-flex items-center gap-2 text-gray-500 hover:text-white transition-colors text-md mb-4 mt-4">
        <i class="ph ph-arrow-left"></i>
        Voltar
      </a>
      <h1 class="font-title text-3xl sm:text-5xl font-bold text-white mb-4 leading-tight">
        <?= $movie->title ?>
      </h1>
      <div class="flex flex-col gap-2 text-gray-600 text-sm mb-4">
        <span>Categoria: <strong class="text-white"><?= $movie->genre ?></strong></span>
        <span>Ano: <strong class="text-white"><?= $movie->year ?></strong></span>
      </div>
      <div class="flex items-center gap-3 mb-8">
        <div class="flex items-center gap-1 text-purple-base">
          <?php
          $average = count($ratings) > 0 ? array_sum(array_column($ratings, 'rating')) / count($ratings) : '0';
          $roundedAverage = round($average)
          ?>
          <?php foreach (range(1, 5) as $star): ?>
            <i class="<?= ($roundedAverage >= $star) ? 'ph-fill' : 'ph' ?> ph-star text-2xl text-purple-base"></i>
          <?php endforeach; ?>
        </div>
        <span class="text-2xl font-bold text-white"> <?= $roundedAverage ?></span>
        <span class="text-md text-gray-600"> (<?= count($ratings) ?> avaliações)</span>
      </div>
      <p class="text-gray-600 leading-relaxed text-lg max-w-2xl mt-12"> <?= $movie->description ?></p>
    </div>
  </div>
  <div class="mt-12" x-data="{
    openReview: <?= !empty($databaseReviewErrors) ? 'true' : 'false' ?>,
    rating: 0,
    hoverRating: 0}">
    <div class="flex justify-between items-end mb-8 border-b border-gray-800 pb-4">
      <h2 class="font-title text-2xl font-bold text-white">Avaliações</h2>
      <?php if (auth()): ?>
        <button @click="openReview = true" class="bg-purple-base hover:bg-opacity-90 text-white font-bold py-2 px-2 rounded-lg transition-colors flex items-center gap-2">
          <i class="ph ph-star"></i>
          Avaliar Filme
        </button>
      <?php endif; ?>
    </div>

    <template x-teleport="body">
      <div class="relative z-50" x-show="openReview" style="display: none;">
        <div class="fixed inset-0 bg-gray-950/80 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4">
            <div x-show="openReview" @click.outside="openReview = false" class="bg-gray-100 border border-gray-300 rounded-2xl w-full max-w-xl shadow-xl">
              <div class="flex justify-between items-center p-6 border-b border-gray-300">
                <h3 class="text-xl font-bold text-white font-title">Avaliar Filme</h3>
                <button @click="openReview = false" class="flex items-center justify-center text-gray-400 hover:text-white transition-colors p-2 y-2 bg-gray-300 rounded-md">
                  <i class="ph ph-x text-xl"></i>
                </button>
              </div>
              <form action="/create-review" method="POST" class="p-6 space-y-6">
                <input type="hidden" name="movie_id" value="<?= $movie->id ?>">
                <div class="flex gap-4">
                  <img src="<?= $movie->poster ?>" class="w-34.25 h-44 rounded object-cover shadow-sm">
                  <div>
                    <h4 class="font-bold text-white text-md font-title"><?= $movie->title ?></h4>
                    <div class="text-sm text-gray-500 mt-1">
                      <p><span class="text-gray-600">Categoria:</span> <?= $movie->genre ?></p>
                      <p><span class="text-gray-600">Ano:</span> <?= $movie->year ?></p>
                    </div>
                    <div class="mt-4">
                      <label class="text-sm text-gray-600 font-medium">Sua Avaliação:</label>
                      <div class="flex gap-1" @mouseleave="hoverRating = 0">
                        <input type="hidden" name="rating" :value="rating">
                        <?php foreach (range(1, 5) as $star): ?>
                          <button type="button" class="focus:outline-none transition-transform hover:scale-110 p-1" @mouseover="hoverRating = <?= $star ?>" @click="rating = <?= $star ?>">
                            <i class="ph ph-star text-3xl" :class="(hoverRating >= <?= $star ?> || (rating >= <?= $star ?> && hoverRating === 0) ? 'ph-fill text-purple-base' : 'ph text-purple-base')"></i>
                          </button>
                        <?php endforeach; ?>
                      </div>
                      <?php if (isset($databaseReviewErrors['rating'])): ?>
                        <span class="text-error-base text-xs mt-1 block">
                          <?= $databaseReviewErrors['rating'][0] ?>
                        </span>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
                <div class="space-y-2">
                  <textarea name="review" rows="4" class="w-full bg-gray-300 border border-gray-500 rounded-lg p-3 text-white placeholder-gray-500 focus:outline-none focus:border-purple-base focus:ring-1 transition-colors"
                    placeholder="Comentário"></textarea>
                  <?php if (isset($databaseReviewErrors['review'])): ?>
                    <span class="text-error-base text-xs mt-1 block">
                      <?= $databaseReviewErrors['review'][0] ?>
                    </span>
                  <?php endif; ?>
                </div>
                <div class="flex justify-end">
                  <button type="submit" class="bg-purple-base text-white font-bold py-2 px-6 rounded-lg hover:bg-opacity-90 transition-colors">Publicar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </template>
    <div class="space-y-4 mt-8">
      <?php if (empty($ratings)): ?>
        <div class="text-center py-16">
          <div class="w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <i class="ph ph-popcorn text-4xl text-gray-400"></i>
          </div>
          <h3 class="text-gray-600 font-bold text-lg">Nenhuma avaliação registrada</h3>
          <p class="text-gray-600 text-sm mt-1">Que tal enviar o primeiro comentário?</p>

          <p class="text-gray-500 text-md mt-1"><i class="ph ph-star"></i> Avaliar filme</p>
        </div>
      <?php else : ?>
        <?php foreach ($ratings as $rating): ?>
          <div class="bg-gray-200 border border-gray-100 p-8 rounded-2xl flex gap-6 items-star group hover:border-gray-700 transition-colors">
            <div class="flex flex-col-3 items-center gap-4 min-w-[300px] shrink-0 border-r border-gray-800 pr-6">
              <img src="https://ui-avatars.com/api/?name=<?= urlencode($rating->user->name) ?>&background=121214&color=A85FDD" class="w-12 h-12 rounded-xl object-cover">
              <div class="flex flex-col">
                <div class="flex items-center justify-center gap-2">
                  <span class="font-bold text-white text-title"><?= $rating->user->name ?></span>
                  <?php if (auth() && auth()->id === $rating->user->id): ?>
                    <span class="text-[10px] bg-purple-base text-white px-2 py-0.5 rounded-full uppercase font-bold tracking-wide border- border-purple-base/30">Você</span>
                  <?php endif; ?>
                </div>
                <span class="text-xs text-gray-500 block"><?= $rating->user->reviews_count ?> filmes avaliados</span>
              </div>
            </div>
            <div class="flex flex-col flex-1 gap-4">
              <div class="flex justify-between items-start">
                <p class="text-gray-500 text-sm leading-relaxed text-justify pr-8 pt-2"><?= $rating->review ?></p>
                <div class="flex items-center gap-1.5 text-lg font-bold bg-gray-300 px-3 py-2 text-gray-700 rounded-lg shrink-0"><?= $rating->rating ?>
                  <span class="text-xs text-gray-700/70">/5</span>
                  <i class="ph-fill ph-star text-lg text-purple-base"></i>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>