<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            <a href="/" class="flex w-full justify-center items-center">
                <div class="flex justify-center w-16">
                    <img src="{{ asset('mhlogo.png') }}" width="80" height="90"/>
                </div>
                <div>
                    <h1 class="altfont w-full flex justify-center text-xl text-white">Midnight Haulers</h1>
                    <small class="altfont w-full flex justify-center text-sm text-gray-500">TruckyApp Company Tracker</small>
                </div>
            </a>
            <div class="mt-16">
                <div class="flex flex-wrap justify-center gap-6 lg:gap-8">

                    <div class="w-half min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500">
                        <div class="w-full">
                            <div class="h-16 w-full bg-gray-420 flex items-center justify-center rounded-lg">
                                <div class="flex justify-center">
                                    <img src="{{ asset('favicon.png') }}" width="30" height="auto" class="light-img" />
                                </div>
                                @if ($company)
                                    <h2 class="altfont ml-4 text-xl font-semibold text-gray-900 dark:text-white">{{$company}}</h2>
                                @else
                                    <h2 class="altfont ml-4 text-xl font-semibold text-gray-900 dark:text-white">Nome da VTC</h2>
                                @endif
                                
                            </div>

                            
                            
                            @if ($companies)
                                <p class="mt-4 px-6 text-gray-500 dark:text-gray-400 text-sm text-justify leading-relaxed">
                                    Lista de resultados de busca por nome. Use o ID da sua VTC para acessar.
                                </p>
                                <ul class="mt-4 flex-col gap-6">
                                    @foreach ($companies as $company)
                                        <li class="text-white font-bold">
                                            <strong class="text-xl">ID: {{$company['id']}}</strong> - {{$company['name']}}
                                            <hr noshade width="100%" />
                                        </li>
                                    @endforeach

                                </ul>
                            @else
                                <p class="mt-4 px-6 text-gray-500 dark:text-gray-400 text-sm text-justify leading-relaxed">
                                    Use o campo abaixo para procurar o <strong>Company ID</strong> de sua empresa no TruckyApp.
                                </p>    
                                <form id="companyName" class="mt-6 w-full flex justify-center gap-4">
                                    <input id="company" name="company" type="text" class="w-full h-4 px-6 no-spinner" required>
                                    <button type="submit">Procurar</button>
                                </form>
                            @endif
                            
                        </div>
                    </div>
                    
                    <div class="z-10 w-quarter min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div class="h-16 w-full bg-gray-420 flex items-center justify-center rounded-lg">
                                <div class="flex justify-center">
                                    <img src="{{ asset('favicon.png') }}" width="30" height="auto" class="light-img" />
                                </div>
                                <h2 class="altfont ml-4 text-xl font-semibold text-gray-900 dark:text-white">Company Id</h2>
                            </div>

                            
                            <p class="mt-4 px-6 text-gray-500 dark:text-gray-400 text-sm text-justify leading-relaxed">
                                Insira o ID de sua empresa no TruckyApp para acessar a ferramenta e carregar automaticamente sempre que entrar.
                            </p>
                            <form id="companyID" class="mt-6 w-full flex justify-center gap-4">
                                <input id="idInput" type="number" class="w-full h-4 px-6 no-spinner">
                                <button type="submit">Acessar</button>
                            </form>
                        </div>
                    </div>                    

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