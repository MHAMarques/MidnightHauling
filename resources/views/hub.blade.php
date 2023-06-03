<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    // use App\Models\Company;
    // $marketETS = Company::getETSMarket();
    // $marketATS = Company::getATSMarket();

    $avatar = $company['avatar'];
    $newAvatar = str_replace("public/", "storage/", $avatar);
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$company['name']}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="https://e.truckyapp.com/{{$newAvatar}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hub.css') }}" rel="stylesheet">
</head>

<input type="hidden" id="loadedID" value="{{$companyID}}" />
<script>
    const companyID = document.getElementById('loadedID');
    const storedId = localStorage.getItem('MHCompanyId');
    if(!storedId){
        window.location.replace('/');
    }
    if(storedId != companyID.value){
        window.location.replace('/hub/'+storedId);
    }
</script>

<body class="antialiased">
    
    <header class="z-10">
        <aside>
            <section>
                <a href="/hub/{{$companyID}}"><div class="logo_profile"><img src="https://e.truckyapp.com/{{$newAvatar}}" title="{{$company['name']}}" alt="Logotipo da empresa {{$company['name']}}"></div></a>
            </section>
            <section>

                <a href="/drivers/{{$companyID}}"><nav>
                    <div class="icon_task"><span class="material-symbols-outlined">account_circle</span></div>
                    <h2>Motoristas</h2>
                </nav></a>
                <a href="/market/{{$companyID}}"><nav>
                    <div class="icon_task"><span class="material-symbols-outlined">monitoring</span></div>
                    <h2>Mercado</h2>
                </nav></a>
                <a href="/routes/{{$companyID}}"><nav>
                    <div class="icon_task"><span class="material-symbols-outlined">local_shipping</span></div>
                    <h2>Rotas</h2>
                </nav></a>
                <a href="/garage/{{$companyID}}"><nav>
                    <div class="icon_task"><span class="material-symbols-outlined">analytics</span></div>
                    <h2>Admin</h2>
                </nav></a>
    
            </section>
        </aside>
    </header>
    
    <main>
        <section>
            <h1>
                {{$company['name']}}<br />
                <small class="flex items-center gap-4">{{$company['slogan']}} <img src="{{$company['flag_url']}}" /></small>
            </h1>
            
            <div class="mainPage_Container">
                <a href="/drivers/{{$companyID}}" class="w-card min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500 hover:outline hover:outline-2 hover:outline-red-500">
                    <article class="w-full mainPage_Card">    
                        <div class="flex items-center gap-4 text-xl">
                            <span class="material-symbols-outlined text-xl">account_circle</span>
                            <h3>Motoristas Ativos</h3>
                        </div>

                        <div class="mainPage_CardContent mt-6">
                            <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">{{$company['members_count']}}</h2>
                            <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Clique para obter mais informações sobre os {{$company['members_count']}} motoristas ativos na <strong class="font-bold">{{$company['tag']}}</strong>. Métricas, trabalhos realizados e estatísticas do grupo.
                            </p>
                        </div>
                    </article>
                </a>

                <a href="/market/{{$companyID}}" class="w-card min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500 hover:outline hover:outline-2 hover:outline-red-500">
                    <article class="w-full mainPage_Card">    
                        <div class="flex items-center gap-4 text-xl">
                            <span class="material-symbols-outlined text-xl">monitoring</span>
                            <h3>Mercado de Cargas</h3>
                        </div>
                        <div class="mainPage_CardContent mt-6">
                            <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">500+</h2>
                            <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                São mais de 500 cargas disponíveis em ambos American e Euro Truck Simulators. Clique para obter mais informações sobre as melhores opções de carga para transportes lucrativos na {{$company['tag']}}.
                            </p>
                        </div>
                    </article>
                </a>

                <a href="/routes/{{$companyID}}" class="w-card min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500 hover:outline hover:outline-2 hover:outline-red-500">
                    <article class="w-full mainPage_Card">    
                        <div class="flex items-center gap-4 text-xl">
                            <span class="material-symbols-outlined text-xl">local_shipping</span>
                            <h3>Rotas de Transporte</h3>
                        </div>

                        <div class="mainPage_CardContent mt-6">
                            <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">
                            @php
                                $mode = 'quilometragem';
                                if($company['company_type'] == 'realistic'){
                                    echo '<span class="material-symbols-outlined text-xl">inventory</span>';
                                    $mode = 'simulação';
                                }
                                elseif($company['company_type'] == 'both'){
                                    echo '<span class="material-symbols-outlined text-xl">emoji_transportation</span>';
                                    $mode = 'simulação e quilometragem';
                                }
                                else{
                                    echo '<span class="material-symbols-outlined text-xl">add_road</span>';
                                }
                            @endphp
                            </h2>
                            <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                O foco da {{$company['tag']}} é a {{$mode}}. Clique para obter mais informações sobre as rotas mais populares e lucrativas realizado pela <strong class="font-bold">{{$company['name']}}</strong>.
                            </p>
                        </div>
                    </article>
                </a>

                <a href="/routes/{{$companyID}}" class="w-card min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500 hover:outline hover:outline-2 hover:outline-red-500">
                    <article class="w-full mainPage_Card">    
                        <div class="flex items-center gap-4 text-xl">
                            <span class="material-symbols-outlined text-xl">analytics</span>
                            <h3>Acesso Administrativo</h3>
                        </div>

                        <div class="mainPage_CardContent mt-6">
                            <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">
                                <span class="material-symbols-outlined text-xl">chart_data</span>
                            </h2>
                            <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Para ter acesso à informações restristas, é necessário que <strong>{{$company['owner']['name']}}</strong> autentique ou compartilhe o acesso com o <strong>Trucky API Token</strong>.
                            </p>
                        </div>
                    </article>
                </a>

            </div>

        </section>
    </main>
</body>
</html>
