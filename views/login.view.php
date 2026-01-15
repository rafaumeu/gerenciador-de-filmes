<?php
$validations_login = flash()->get("validations_login");
$validations_registrar = flash()->get("validations_registrar");
$mode = $validations_registrar ? "register" : "login";
?>
<div class="grid grid-cols-1 lg:grid-cols-2 h-screen bg-gray-100 overflow-hidden">
  <div class="relative hidden flex-col justify-between p-12 text-white lg:flex">
    <div class="absolute inset-0 bg-gray-100">
      <img src="assets/image.png" class="h-full w-full object-cover opacity-60">
      <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent"></div>
    </div>
    <div class="relative z-20 flex items-center gap-2 text-3xl font-bol font-display tracking-wide">
      <img src="assets/logo.svg" alt="logo" class="w-10 h-10">
    </div>
    <div class="relative z-20 max-w-lg">
      <blockquote class="space-y-6">
        <h1 class="text-md font-display text-gray-600 font-bold leading-tight">
          ab filmes
        </h1>
        <p class="text-2xl font-display text-gray-700 font-bold leading-tight">
          "O guia definitivo para os amantes de cinema."
        </p>
      </blockquote>
    </div>
  </div>
  <div class="flex flex-col justify-center items-center p-8 bg-gray-100 w-full relative" x-data="{mode: '<?= $mode ?>'}">
    <div class="flex items-center gap-1 bg-gray-200 p-1 rounded-xl mb-12">
      <button type="button" @click="mode = 'login'" :class="mode === 'login' ? 'bg-gray-300 text-purple-light shadow-sm ring-1 ring-gray-600/5' : 'bg-gray-200 text-gray-500'" class="px-8 py-2 rounded-lg text-sm font-bold transition-all duration-200">Login</button>
      <button type="button" @click="mode = 'register'" :class="mode === 'register' ? 'bg-gray-300 text-purple-light shadow-sm ring-1 ring-gray-600/5' : 'bg-gray-200 text-gray-500'" class="px-8 py-2 rounded-lg text-sm font-bold transition-all duration-200">Cadastro</button>
    </div>
    <div x-show="mode === 'login'" x-transition class="w-full max-w-[328px] space-y-8">
      <div class="flex flex-col space-y-2 text-center">
        <h1 class="text-xl font-bold tracking-tight text-white font-title">Acesse sua conta</h1>
      </div>
      <form action="/login" method="post" class="space-y-4">
        <?php if (isset($validations_login[0])): ?>
          <div class="flex items-center gap2 text-error-base p-3 rounded-lg mb-6">
            <i class="ph ph-waring text-xl"></i>
            <span class="text-sm font-bold"><?= $validations_login[0]; ?></span>
          </div>
        <?php endif; ?>
        <div class="space-y-4">
          <div class="space-y-2">
            <div class="relative  transition-colors  text-gray-400 focus-within:text-purple-base">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none <?= isset($validations_login['email']) ? 'text-error-base' : '' ?>">
                <i class="ph ph-envelope text-xl"></i>
              </div>
              <input type="email" name="email" class="block w-full pl-10 pr-3 border rounded-xl leading-5 bg-gray-300 border border-gray-500 py-3 placeholder-gray-500 focus:outline-none focus:ring-1 sm:text-sm transition-all border-gray-500 focus:border-purple-base focus:ring-purple-base" placeholder="E-mail">
            </div>
            <?php if (isset($validations_login['email'])): ?>
              <div class="flex items-center gap-2 mt-1 text-error-base text-xs pl-1">
                <i class="ph ph-warning"></i>
                <span><?= $validations_login['email'][0]; ?></span>
              </div>
            <?php endif; ?>
          </div>
          <div class="space-y-1">
            <div class="relative text-gray-400 transition-colors text-gray-400 focus-within:text-purple-base" x-data="{show: false}">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none <?= isset($validations_login['password']) ? 'text-error-base' : '' ?>">
                <i class="ph ph-password text-xl"></i>
              </div>
              <input :type="show ? 'text' : 'password'" name="password" class="block w-full pl-10 pr-3 border rounded-xl leading-5 bg-gray-300 border border-gray-500 py-3 placeholder-gray-500 focus:outline-none focus:ring-1 sm:text-sm transition-all border-gray-500 focus:border-purple-base focus:ring-purple-base" placeholder="Senha">
              <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer hover:text-white transition-colors">
                <i class="ph text-xl" :class="show ? 'ph-eye-closed' : 'ph-eye'"></i>
              </button>
            </div>
            <?php if (isset($validations_login['password'])): ?>
              <div class="flex items-center gap-2 mt-1 text-error-base text-xs pl-1">
                <i class="ph ph-warning"></i>
                <span><?= $validations_login['password'][0]; ?></span>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <button type="submit" class="w-full bg-purple-base text-white font-bold py-3 rounded-xl transition-all duration-200 hover:bg-purple-light">Entrar</button>
      </form>
    </div>
    <div x-show="mode === 'register'" x-transition class="w-full max-w-[328px] space-y-8" style="display:none;">
      <div class="flex flex-col space-y-2 text-center">
        <h1 class="text-xl font-bold tracking-tight text-white font-title">Crie sua conta</h1>
      </div>
      <form action="/register" method="post" class="space-y-4">
        <div class="space-y-4">
          <div class="space-y-1">
            <div class="relative text-gray-400 focus-within:text-purple-base transition-colors">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none <?= isset($validations_registrar['name']) ? 'text-error-base' : '' ?>">
                <i class="ph ph-user text-xl"></i>
              </div>
              <input type="text" name="name" class="block w-full pl-10 pr-3 border rounded-xl leading-5 bg-gray-300 border border-gray-500 py-3 placeholder-gray-500 focus:outline-none focus:ring-1 sm:text-sm transition-all border-gray-500 focus:border-purple-base focus:ring-purple-base" placeholder="Nome">
            </div>
            <?php if (isset($validations_registrar['name'])): ?>
              <div class="flex items-center gap-2 mt-1 text-error-base text-xs pl-1">
                <i class="ph ph-warning"></i>
                <span><?= $validations_registrar['name'][0]; ?></span>
              </div>
            <?php endif; ?>
          </div>
          <div class="space-y-1">
            <div class="relative text-gray-400 focus-within:text-purple-base transition-colors">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none <?= isset($validations_registrar['email']) ? 'text-error-base' : '' ?>">
                <i class="ph ph-envelope text-xl"></i>
              </div>
              <input type="email" name="email" class="block w-full pl-10 pr-3 border rounded-xl leading-5 bg-gray-300 border border-gray-500 py-3 placeholder-gray-500 focus:outline-none focus:ring-1 sm:text-sm transition-all border-gray-500 focus:border-purple-base focus:ring-purple-base" placeholder="E-mail">
            </div>
            <?php if (isset($validations_registrar['email'])): ?>
              <div class="flex items-center gap-2 mt-1 text-error-base text-xs pl-1">
                <i class="ph ph-warning"></i>
                <span><?= $validations_registrar['email'][0]; ?></span>
              </div>
            <?php endif; ?>
          </div>
          <div class="space-y-1">
            <div class="relative text-gray-400 focus-within:text-purple-base transition-colors">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none <?= isset($validations_registrar['email_confirmation']) ? 'text-error-base' : '' ?>">
                <i class="ph ph-envelope text-xl"></i>
              </div>
              <input type="email" name="email_confirmation" class="block w-full pl-10 pr-3 border rounded-xl leading-5 bg-gray-300 border border-gray-500 py-3 placeholder-gray-500 focus:outline-none focus:ring-1 sm:text-sm transition-all border-gray-500 focus:border-purple-base focus:ring-purple-base" placeholder="Confirmação de E-mail">
            </div>
            <?php if (isset($validations_registrar['email_confirmation'])): ?>
              <div class="flex items-center gap-2 mt-1 text-error-base text-xs pl-1">
                <i class="ph ph-warning"></i>
                <span><?= $validations_registrar['email_confirmation'][0]; ?></span>
              </div>
            <?php endif; ?>
          </div>
          <div class="space-y-1"
            x-data="{
              show: false,
              senha: '',
              get forca() {
                  let score = 0;
                  if(this.senha.length > 7) score += 30;
                  if(/[A-Z]/.test(this.senha)) score += 20;
                  if(/\d/.test(this.senha)) score += 20;
                  if(/[^a-zA-Z0-9]/.test(this.senha)) score += 30;
                  return Math.min(100, score);
              },
              get cor() { // Cores para Barra
                  if(this.forca <= 40) return 'bg-red-500';
                  if(this.forca <= 80) return 'bg-yellow-500';
                  return 'bg-green-500';
              },
                get texto() { // Cores para Texto
                  if(this.forca <= 40) return 'text-red-500';
                  if(this.forca <= 80) return 'text-yellow-500';
                  return 'text-green-500';
              },
              get label() {
                  if(this.forca <= 40) return 'Fraca';
                  if(this.forca <= 80) return 'Média';
                  return 'Forte';
              }
            }">
            <div class="relative text-gray-400 focus-within:text-purple-base transition-colors">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none <?= isset($validations_registrar['password']) ? 'text-error-base' : '' ?>">
                <i class="ph ph-password text-xl"></i>
              </div>
              <input x-model="senha" :type="show ? 'text' : 'password'" name="password" class="block w-full pl-10 pr-3 border rounded-xl leading-5 bg-gray-300 border border-gray-500 py-3 placeholder-gray-500 focus:outline-none focus:ring-1 sm:text-sm transition-all border-gray-500 focus:border-purple-base focus:ring-purple-base" placeholder="Senha">
              <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center px-4 cursor-pointer transition-colors focus-within:text-purple-base">
                <i class="ph text-xl" :class="show ? 'ph-eye-closed' : 'ph-eye'"></i>
              </button>
              <div class="flex items-center gap-2 mt-2 h-1 w-full bg-gray-200 rounded full overflow-hidden" x-show="senha.length > 0" :class="cor"></div>
            </div>
            <div class="text-xs text-right font-bold transition-colors duration-300 mt-1" :class="texto" x-text="label" x-show="senha.length > 0"></div>
            <?php if (isset($validations_registrar['password'])): ?>
              <div class="flex items-center gap-2 mt-1 text-error-base text-xs pl-1">
                <i class="ph ph-warning"></i>
                <span><?= $validations_registrar['password'][0]; ?></span>
              </div>
            <?php endif; ?>
          </div>
          <button type="submit" class="w-full bg-purple-base text-white font-bold py-2 rounded-xl hover:bg-purple-light transition-colors">Criar</button>
      </form>
    </div>
  </div>
</div>