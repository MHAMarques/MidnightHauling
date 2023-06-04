<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
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
    
    <x-mainMenu :company="$company" :companyID="$companyID" :newAvatar="$newAvatar" />

    <main>
        <section>
            
            <x-mainCompany :company="$company" />
            <div class="mainPage_Container">

                <x-mainCard refUrl="/drivers/{{$companyID}}" icon="account_circle" title="Motoristas Ativos">
                    <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">{{$company['members_count']}}</h2>
                    <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Clique para obter mais informações sobre os {{$company['members_count']}} motoristas ativos na <strong class="font-bold">{{$company['tag']}}</strong>. Métricas, trabalhos realizados e estatísticas do grupo.
                    </p>
                </x-mainCard>
                
                <x-mainCard refUrl="/market/{{$companyID}}" icon="monitoring" title="Mercado de Cargas">
                    <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">500+</h2>
                    <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        São mais de 500 cargas disponíveis em ambos American e Euro Truck Simulators. Clique para obter mais informações sobre as melhores opções de carga para transportes lucrativos na {{$company['tag']}}.
                    </p>
                </x-mainCard>
                        

                <x-mainCard refUrl="/routes/{{$companyID}}" icon="local_shipping" title="Rotas de Transporte">
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
                </x-mainCard>

                <x-mainCard refUrl="/routes/{{$companyID}}" icon="analytics" title="Acesso Administrativo">
                    <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">
                        <span class="material-symbols-outlined text-xl">chart_data</span>
                    </h2>
                    <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Para ter acesso à informações restristas, é necessário que <strong>{{$company['owner']['name']}}</strong> autentique ou compartilhe o acesso com o <strong>Trucky API Token</strong>.
                    </p>
                </x-mainCard>

            </div>

        </section>
    </main>

</body>
</html>
