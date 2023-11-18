<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Marcelo Henrique A Marques - GitHub.com/MHAMarques">
    <meta name="description" content="Midnight Haulers [MHL] - App para rastreamento e gerenciamento de empresas de transportes virtual presentes na plataforma TruckyApp.">
    

    <title>Midnight Haulers - TruckyApp Tracker</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('mhlogo.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<script>
    const storedId = localStorage.getItem('MHCompanyId');
    if(storedId){
        window.location.replace('/hub/'+storedId);
    }
</script>
<body class="antialiased">
    <div class="relative flex justify-center items-start min-h-screen selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex w-full justify-center items-center">
                <div class="flex justify-center w-16">
                    <img src="{{ asset('mhlogo.png') }}" width="80" height="90"/>
                </div>
                <div>
                    <h1 class="altfont w-full flex justify-center text-xl text-white font-bold">Midnight Haulers</h1>
                    <small class="altfont w-full flex justify-center text-sm text-gray-500">TruckyApp Company Tracker</small>
                </div>
            </div>
            <div class="mt-16">
                <div class="flex flex-wrap justify-center gap-6 lg:gap-8">

                    <a href="\search" class="z-10 w-half min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500 hover:outline hover:outline-2 hover:outline-red-500">
                        <div>
                            <div class="flex items-center">
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="w-7 h-7 stroke-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64" />
                                    </svg>
                                </div>
                                <h2 class="altfont px-6 text-xl font-semibold text-gray-900 dark:text-white">Encontre sua VTC</h2>
                            </div>

                            <p class="w-full text-justify mt-4 px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                <strong>Clique aqui</strong> para procurar sua <strong>Company ID</strong>. Obtenha acesso à ferramenta para acompanhar as métricas, as oportunidades e o desempenho da equipe de motoristas que compõe sua <strong>Virtual Transport Company</strong> no TruckyApp.
                            </p>
                        </div>
                    </a>

                    <div class="z-10 w-quarter min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div class="h-16 w-full bg-gray-420 flex items-center justify-center rounded-lg">
                                <div class="flex justify-center">
                                    <img src="{{ asset('favicon.png') }}" width="30" height="auto" class="light-img" />
                                </div>
                                <h2 class="altfont ml-4 text-xl font-semibold text-gray-900 dark:text-white">Company Id</h2>
                            </div>

                            
                            <p class="mt-4 px-6 text-gray-500 dark:text-gray-400 text-sm text-justify leading-relaxed">
                                Insira o ID de sua empresa no TruckyApp para acessar e carregar automaticamente sempre que entrar.
                            </p>
                            <form id="companyID" class="mt-6 w-full flex justify-center gap-4">
                                <input id="idInput" type="number" class="w-full h-4 px-6 no-spinner" required>
                                <button type="submit">Acessar</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="flex justify-center mt-16 px-0 items-center">
                <div class="lg:fixed text-gray-500 m-6 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    <!--Built with Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})-->
                    Desenvolvido para empresas e motoristas do <strong><a href="https://truckyapp.com/" style="color: #ff0051" target="_blank">Trucky App</a></strong>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('companyID');
        form.addEventListener('submit', function(event) {
            const idInput = document.getElementById('idInput');
            const id = idInput.value;

            localStorage.setItem('MHCompanyId', id);
        });
    });
</script>
</html>