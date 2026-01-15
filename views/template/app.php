<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200..1000&family=Rajdhani:wght@500;700&family=Rammetto+One&display=swap" rel="stylesheet">
  <link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
  <link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css" />
  <title>AB Filmes</title>
  <style type="text/tailwindcss">
    @theme{
      --color-purple-base: #892CCD;
      --color-purple-light: #A85FDD;
      --color-gray-100: #0F0F1A;
      --color-gray-200: #131320;
      --color-gray-300: #1A1B2D;
      --color-gray-400: #45455F;
      --color-gray-500: #7A7B9F;
      --color-gray-600: #B5B6C9;
      --color-gray-700: #E4E5EC;
      --color-white: #FFFFFF;
      --color-error-base: #D04048;
      --color-error-light: #F77980;
      --font-display: "Rammetto One", sans-serif;
      --font-title: "Rajdhani", sans-serif;
      --font-body: "Nunito Sans", sans-serif;
    }
  </style>
</head>

<body class="bg-gray-100 text-gray-700 font-body antialiased">
  <header class="bg-gray-200 border-b border-gray-100 py-5">
    <nav class="w-full max-w-screen-3xl mx-auto px-6 flex justify-between items-center">
      <div class="flex items-center gap-4 font-title text-sm">
        <img src="assets/logo.svg" class="w-12" alt="AB Filmes">
      </div>
      <ul class="flex items-center gap-8 font-title text-md">
        <li>
          <a href="/" class="flex items-center gap-2 px-4 py-2 rounded text-gray-500 hover:text-purple-light transition-colors <?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php') ? 'bg-gray-200 text-purple-base' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-100' ?>">
            <i class="ph ph-popcorn"></i>Explorar
          </a>
        </li>
        <?php if (auth()): ?>
          <li>
            <a href="/my-movies" class="flex items-center gap-2 px-4 py-2 rounded text-gray-600 hover:text-gray-700 transition-colors <?= ($_SERVER['REQUEST_URI'] == '/my-movies' || $_SERVER['REQUEST_URI'] == '/my-movies.php') ? 'bg-gray-200 text-purple-base' : 'text-gray-600 hover:bg-gray-200 hover:text-gray-100' ?>">
              <i class="ph ph-film-slate"></i>Meus Filmes
            </a>
          </li>
        <?php endif; ?>
      </ul>


      <div class="flex items-center gap-2">
        <?php if (auth()): ?>
          <div class="flex items-center gap-3 text-sm text-gray-600">
            <span>
              Olá <strong class="font-bold"><?= auth()->name ?></strong>
            </span>
          </div>
          <div class="w-8 h-8 rounded bg-gradient-to-r from-purple-base to-purple-light p-[1px]">

            <img src="https://ui-avatars.com/api/?name=<?= urlencode(auth()->name) ?>&background=121214&color=A85FDD" class="w-full h-full rounded-full object-cover" alt="Avatar">
          </div>
          <span class="h-6 w-px bg-gray-300"></span>

          <a href="/logout" class="text-gray-500 hover:text-red-400 transition-colors">
            <i class="ph ph-sign-out text-xl"></i>
          </a>
        <?php else: ?>

          <a href="/login" class="flex items-center gap-2 font-bold text-gray-700 hover:text-white transition-colors">
            Fazer login
            <i class="ph ph-sign-in text-xl"></i>
          </a>
        <?php endif; ?>
      </div>

    </nav>
  </header>
  <main class="w-full max-w-screen-xl mx-auto px-6 py-10 space-y-6">
    <?php if ($mensagem = flash()->get("mensagem")): ?>
      <div class="bg-gray-200 border border-purple-base px-4 py-3 rounded text-sm font-bold text-gray-700 flex items-center justify-between shadow-lg">
        <span class="flex items-center gap-2">
          <i class="ph ph-check-circle text-purple-base text-lg"></i>
          <?= $mensagem; ?>
        </span>
        <i class="ph ph-x cursor-pointer hover:text-purple-light" onclick="this.parentElement.remove()"></i>
      </div>
    <?php endif; ?>
    <?php require "../views/{$view}.view.php"; ?>
  </main>
</body>

</html>