<div class="w-full rounded-xl overflow-hidden relative bg-gray-200 group hover:scale-105 transition-transform duration-300 border border-transparent hover:border-purple-base">
  <a href="/movie?id=<?= $movie->id ?>" class="absolute inset-0 z-10 w-full h-full"></a>
  <div class="h-80 w-full">
    <?php if (!empty($movie->poster)): ?>
      <img class="w-full h-full object-cover group-hover:opacity-80 transition-opacity" src="<?= $movie->poster ?>" alt="<?= $movie->title ?>">
    <?php else: ?>
      <div class="w-full h-full bg-gray-300 flex items-center justify-center group-hover:opacity-80 transition-opacity">
        <i class="ph ph-film-strip text-4xl text-gray-500"></i>
      </div>
    <?php endif; ?>
  </div>
  <div class="absolute top-2 right-2 bg-gray-100/80 backdrop-blur-sm px-2 py-1 rounded flex items-center gap-1 z-20 shadow-md">
    <div class="flex items-baseline">

      <span class="text-xl font-bold text-gray-700 font-title">

        <?= number_format($movie->rating, 1, ',', '.') ?>
      </span>
      <span class="text-xs font-title opacity-70 leading-tight ml-2"> / 5</span>
      <i class="ph-fill ph-star text-white text-xl ml-1"></i>
    </div>

  </div>
  <div class="absolute inset-0 bg-gradient-to-t from-gray-100 via-gray-100/40 to-transparent opacity-90"></div>
  <div class="absolute bottom-0 left-0 p-4 w-full z-20 group-hover:opacity-100 transition-opacity">
    <h3 class="font-title font-bold text-xl text-white leading-tight mb-1 truncate"><?= $movie->title ?></h3>
  </div>
  <div class="flex items-center justify-between text-sm text-gray-600 font-title">
    <span><?= $movie->genre ?></span>
    <span><?= $movie->year ?></span>
  </div>
</div>