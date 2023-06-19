<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php 
    use App\Models\Company;
    
    if(isset($_COOKIE['MHToken'])){
        $companyToken = $_COOKIE['MHToken'];
    }else{
        $companyToken = null;
    }
    
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$company['name']}} - Acesso Administrativo</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{$company['avatar_url']}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hub.css') }}" rel="stylesheet">
</head>
<input type="hidden" id="loadedID" name="companyId" value="{{$companyID}}" />
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
    
    <x-mainMenu :company="$company" :companyID="$companyID" />

    <main>
        <section>
            @if ($companyToken)
                @php 
                    $CompanyAllTimeStats = Company::allTimeStats($companyID, $companyToken); 
                    $MonthlyStats = Company::monthlyStats($companyID, $companyToken);
                    $currentMonth = date('M');
                @endphp
                <x-mainCompany :company="$company" />

                <div class="mainPage_Container">

                    <x-mainCard refUrl="#"  icon="account_balance_wallet" title="Saldo: ${{$balanceMoney = number_format($CompanyAllTimeStats['balance'], 2, ',', '.')}}">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half"><span class="material-symbols-outlined text-xl">payments</span></h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full">
                            <strong class="altfont text-white text-lg font-bold">Membros Ativos: {{$CompanyAllTimeStats['members']}}</strong><br />
                            <strong class="px-6">Garagens: {{$CompanyAllTimeStats['garages']}}</strong><br />
                            <strong class="px-6">Veículos: {{$CompanyAllTimeStats['vehicles']}}<br /></strong> 
                            <strong class="altfont text-white text-lg font-bold">Trabalhos ativos: {{$CompanyAllTimeStats['running_jobs']}}</strong><br />
                        </p>
                    </x-mainCard>

                    <x-mainCard refUrl="#"  icon="local_shipping" title="{{$MonthlyStats['jobs']}} Entregas em {{$currentMonth}}">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half">{{$MonthlyStats['cargo_mass']}} Tons</h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full">
                            <strong class="altfont text-white text-lg font-bold">Lucro: ${{$balanceMoney = number_format($MonthlyStats['revenue'], 2, ',', '.')}}</strong><br />
                            <strong class="px-6">Imposto: -${{$taxesMoney = number_format($MonthlyStats['taxes'], 2, ',', '.')}}</strong><br />
                            <strong class="px-6">Aluguel: -${{$rentMoney = number_format($MonthlyStats['rent_cost'], 2, ',', '.')}}<br /></strong>
                            <strong class="px-6">Combustível: -${{$fuelMoney = number_format($MonthlyStats['fuel_cost'], 2, ',', '.')}}<br /></strong> 
                            <strong class="px-6">Danos: -${{$damageMoney = number_format($MonthlyStats['damage_cost'], 2, ',', '.')}}<br /></strong>
                            <strong class="altfont text-white text-lg font-bold">Distância: {{$totalKM = number_format($MonthlyStats['driven_distance'], 0, '', '.')}} Km</strong><br />
                        </p>
                    </x-mainCard>

                </div>
            @else
                <x-mainCompany :company="$company" />
                <div class="flex flex-wrap justify-center gap-6 lg:gap-8">

                    <div class="z-10 w-half min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500 hover:outline hover:outline-2 hover:outline-red-500">
                        <div>
                            <div class="flex items-center">
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <span class="material-symbols-outlined text-xl text-white font-bold">key</span>
                                </div>
                                <h2 class="altfont px-6 text-xl font-semibold text-gray-900 dark:text-white">Token de acesso</h2>
                            </div>

                            <p class="w-full text-justify mt-4 px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                Somente com o <strong class="text-white">Token de Acesso da Empresa ao API</strong> é possível ter acesso às informações privadas da <strong>{{$company['name']}}</strong>. Para isso o dono ou responsável pela <strong>VTC</strong> precisa acessar as seguintes configurações no TruckyApp:
                            </p>
                            <p class="w-full text-justify mt-4 px-6 text-white text-sm leading-relaxed">
                                Centro da Empresa (VTC) » Painel de Informações » Configurações da Empresa » Integrações » Solicitar o Token de Acesso da Empresa ao API
                            </p>
                        </div>
                    </div>

                    <div class="z-10 w-quarter min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <div class="h-16 w-full bg-gray-420 flex items-center justify-center rounded-lg">
                                <div class="flex justify-center">
                                    <img src="{{ asset('favicon.png') }}" width="30" height="auto" class="light-img" />
                                </div>
                                <h2 class="altfont ml-4 text-xl font-semibold text-gray-900 dark:text-white">Company Token</h2>
                            </div>

                            
                            <p class="mt-4 px-6 text-gray-500 dark:text-gray-400 text-sm text-justify leading-relaxed">
                                Copie e cole o <strong class="text-white">Token de Acesso da Empresa ao API</strong> no campo para authenticar automaticamente sempre que entrar.
                            </p>
                            <form id="companyToken" name="accessToken" class="mt-6 w-full flex justify-center gap-4">
                                <input id="token" type="text" class="w-full h-4 px-6 no-spinner" required>
                                <button type="submit">Acessar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('companyToken');
                        form.addEventListener('submit', function(event) {
                            const tokenInput = document.getElementById('token');
                            const token = tokenInput.value;
                            document.cookie = "MHToken=" + token + "; expires=Thu, 01 Jan 2024 00:00:00 UTC; path=/admin/11080";
                        });
                    });
                </script>
            @endif
        </section>
    </main>
</body>
</html>
