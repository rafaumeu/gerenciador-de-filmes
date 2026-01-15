<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200..1000&family=Rajdhani:wght@500;700&family=Rammetto+One&display=swap" rel="stylesheet">
  <!-- Phosphor Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <title>Ab Filmes</title>
  <style type="text/tailwindcss">
    @theme {
            --color-purple-base: #892CCD;
            --color-purple-light: #A85FDD;
            --color-gray-100: #0F0F1A;
            --color-gray-200: #131320;
            --color-gray-300: #1A1B2D;
            --color-gray-900: #121214; 
            /* ... suas outras cores ... */
            --font-display: "Rammetto One", sans-serif;
            --font-title: "Rajdhani", sans-serif;
            --font-body: "Nunito Sans", sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-700 font-body antialiased">
  <?php require "../views/{$view}.view.php"; ?>
</body>

</html>