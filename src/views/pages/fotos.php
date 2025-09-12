<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Galeria de Fotos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Usando Tailwind CSS via CDN para estilização moderna -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Efeito de escurecimento do vídeo de fundo */
        .bg-video::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1;
        }
    </style>
</head>
<body class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Vídeo de fundo -->
    <div class="absolute inset-0 w-full h-full bg-video z-0">
        <video autoplay muted loop playsinline class="object-cover w-full h-full">
            <source src="/backend/src/video/video.mp4" type="video/mp4">
            Seu navegador não suporta vídeo em HTML5.
        </video>
    </div>

    <!-- Conteúdo centralizado -->
    <div class="relative z-10 flex flex-col items-center justify-center w-full">
        <h1 class="text-white text-4xl font-bold mb-8 drop-shadow-lg">Galeria de Fotos</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 w-full max-w-5xl">
            <img src="/backend/src/fotos/foto1.jpg" alt="Foto 1" class="w-40 h-40 object-cover rounded-xl shadow-lg transition-transform hover:scale-105 duration-300 border-4 border-white/30">
            <img src="/backend/src/fotos/foto2.jpg" alt="Foto 2" class="w-40 h-40 object-cover rounded-xl shadow-lg transition-transform hover:scale-105 duration-300 border-4 border-white/30">
            <img src="/backend/src/fotos/foto3.jpg" alt="Foto 3" class="w-40 h-40 object-cover rounded-xl shadow-lg transition-transform hover:scale-105 duration-300 border-4 border-white/30">
            <img src="/backend/src/fotos/foto4.jpg" alt="Foto 4" class="w-40 h-40 object-cover rounded-xl shadow-lg transition-transform hover:scale-105 duration-300 border-4 border-white/30">
            <img src="/backend/src/fotos/foto5.jpg" alt="Foto 5" class="w-40 h-40 object-cover rounded-xl shadow-lg transition-transform hover:scale-105 duration-300 border-4 border-white/30">
            <img src="/backend/src/fotos/foto6.jpg" alt="Foto 6" class="w-40 h-40 object-cover rounded-xl shadow-lg transition-transform hover:scale-105 duration-300 border-4 border-white/30">
        </div>
    </div>
</body>
</html>