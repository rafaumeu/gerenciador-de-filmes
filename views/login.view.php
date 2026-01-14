<div class="mt-6 grid grid-cols-2 gap-2">
  <div class="border border-stone-700 rounded">
    <h1 class="border-b border-stone-700 text-stone-400 font-bold px-4 py-2">Login</h1>
    <form class="space-y-2 space-x-4" method="post">
      <?php if ($validations = flash()->get('validations_login')): ?>
        <div class="bg-red-900 border-red-800 border-2 px-4 py-2 rounded text-sm font-bold text-red-300">
          <ul>
            <li>Dê uma olhada nos erros abaixo</li>
            <?php foreach ($validations as $validation): ?>
              <li><?= $validation; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <label class="text-stone-500 mb-px">Email</label>
      <input type="email" class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="digite seu email" name="email">
      <label class="text-stone-500 mb-px">Senha</label>
      <div x-data="{show: false, senha: ''}" class="relative transition-all">
        <input x-model="senha" :type="show ? 'text' : 'password'" class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="digite sua senha" name="password">
        <button type="button" @click="show = !show" class="absolute right-2 top-2 text-stone-400 hover:text-stone-200">
          <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
          </svg>
        </button>
      </div>
      <button type="submit" class="border-lime-800 bg-lime-900 px-4 py-2 rounded-md border border-2 hover:bg-lime-800">Login</button>
    </form>


  </div>
  <div class="border border-stone-700 rounded">
    <h1 class="border-b border-stone-700 text-stone-400 font-bold px-4 py-2">Registro</h1>
    <form class="space-y-2 space-x-4" method="post" action="/register">
      <?php if ($validations = flash()->get('validations_registrar')): ?>
        <div class="bg-red-900 border-red-800 border-2 px-4 py-2 rounded text-sm font-bold text-red-300">
          <ul>
            <li>Dê uma olhada nos erros abaixo</li>
            <?php foreach ($validations as $validation): ?>
              <li><?= $validation; ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
      <label class="text-stone-500 mb-px">Nome</label>
      <input type="text" class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="digite seu nome" name="name">
      <label class="text-stone-500 mb-px">Email</label>
      <input type="text" class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="digite seu email" name="email">
      <label class="text-stone-500 mb-px">Confirme seu email</label>
      <input type="text" class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="digite seu email" name="email_confirmation">
      <label class="text-stone-500 mb-px">Senha</label>
      <div x-data="{
      show: false,
      senha: '',
      get forca() {
       let score = 0;
       if(this.senha.length > 7)
       score +=30;
       if(/[A-Z]/.test(this.senha))
       score +=20;
       if(/\d/.test(this.senha))
       score +=20;
       if(/[^a-zA-Z0-9]/.test(this.senha))
       score +=30;
       return Math.min(100, score);
      },
      get cor() {
      if(this.forca <= 40) return 'bg-red-500';
      if(this.forca <= 80) return 'bg-yellow-500';
      return 'bg-lime-500';
      },
      get texto() {
      if(this.forca <= 40) return 'Fraca';
      if(this.forca <= 80) return 'Média';
      return 'Forte';
      }
            }" class="relative transition-all">
        <input x-model="senha" :type="show ? 'text' : 'password'" class="border-stone-800 bg-stone-900 text-sm border-2 rounded-md focus:outline-none px-2 py-1 w-full" placeholder="digite sua senha" name="password">
        <button type="button" @click="show = !show" class="absolute  right-2 top-2 text-stone-400 hover:text-stone-200">
          <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
          </svg>
        </button>
        <div class="mt-2 h-1.5 w-full bg-stone-800 rounded overflow-hidden" x-show="senha.length > 0">
          <div class="h-full transition-all duration-500" :style="'width:' + forca +'%'" :class="cor"></div>
        </div>
        <div class="text-xs mb-1 text-right font-bold transition-colors duration-300" :class="cor.replace('bg-','text-')" x-text="texto" x-show="senha.length > 0"></div>
      </div>
      <button type="reset" class="border-lime-800 bg-lime-900 px-4 py-2 rounded-md border border-2 hover:bg-lime-800">Cancelar</button>
      <button type="submit" class="border-lime-800 bg-lime-900 px-4 py-2 rounded-md border border-2 hover:bg-lime-800">Registrar</button>
    </form>

  </div>'
</div>'