<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php use App\Models\Company; @endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$company['name']}} - Mercado TruckyApp</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{$company['avatar_url']}}">
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
        window.location.replace('/market/'+storedId);
    }
</script>

<body class="antialiased">
    
    <x-mainMenu :company="$company" :companyID="$companyID" />

    <main>
        <section>
           
            <x-mainMarket pageTitle="Valores do Mercado TruckyApp" pageDetails="ETS/ATS - Cargas de maior demanda" />
            <div class="mainPage_Container">
                
                    @php
                        
                        $jobCargo = $marketETS[0]['groups'][0] ?? 'none';
                        $typeCargo = $marketETS[0]['body_types'][0] ?? 'none';
                        $cargoType = Company::cargoIcons($jobCargo, $typeCargo);
                        $avgIncome = $marketETS[0]['avg_job_income']['1000'] ?? 0;
                        $realAdvantage = $marketETS[0]['price_per_km'] ?? 0;
                        $marketAdvantage = $marketETS[0]['price_per_km_with_market_change'] ?? 0;
                        $marketDiff = $marketAdvantage - $realAdvantage;
                        $longDiff = ($avgIncome/1000) - $marketAdvantage;
                        $fragility = $marketETS[0]['fragility']*100;
    
                    @endphp
                    <x-mainCard refUrl="?game=ets" icon="monitoring" title="Mercado Europeu">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half"><span class="material-symbols-outlined text-xl">{{$cargoType}}</span></h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                            <strong class="altfont text-white text-lg font-bold">{{$marketETS[0]['localized_names']['pt_br'] ?? $marketETS[0]['name']}} [{{$marketDiff < 0 ? $marketDiff : '+'.$marketDiff}}]</strong><br />
                            <strong class="px-6">Preço/Km: ${{$marketAdvantage}}</strong> <br />
                            <strong class="px-6">Preço/1k: ${{$milKMoney = number_format($avgIncome, 2, ',', '.')}} [{{$longDiff < 0 ? $longDiff : '+'.$longDiff}}]</strong> <br />
                            <strong class="altfont text-white text-lg font-bold">Valores definidos:</strong><br />
                            <strong class="px-6">Preço/Km: ${{$realAdvantage}}</strong> <br />
                            <strong class="px-6">Recompensa: {{$expAvg = number_format($marketETS[0]['unit_reward_per_km']*$marketETS[0]['avg_cargo_unit_count'], 1)}} Exp/Km</strong> <br />
                            
                        </p>
                    </x-mainCard>

                    @php
                        
                        $jobCargo = $marketATS[0]['groups'][0] ?? 'none';
                        $typeCargo = $marketATS[0]['body_types'][0] ?? 'none';
                        $cargoType = Company::cargoIcons($jobCargo, $typeCargo);
                        $avgIncome = $marketATS[0]['avg_job_income']['1000'] ?? 0;
                        $realAdvantage = $marketATS[0]['price_per_km'] ?? 0;
                        $marketAdvantage = $marketATS[0]['price_per_km_with_market_change'] ?? 0;
                        $marketDiff = $marketAdvantage - $realAdvantage;
                        $longDiff = ($avgIncome/1000) - $marketAdvantage;
                        $fragility = $marketATS[0]['fragility']*100;
    
                    @endphp
                    <x-mainCard refUrl="?game=ats" icon="monitoring" title="Mercado Americano">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half"><span class="material-symbols-outlined text-xl">{{$cargoType}}</span></h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                            <strong class="altfont text-white text-lg font-bold">{{$marketATS[0]['localized_names']['pt_br'] ?? $marketATS[0]['name']}} [{{$marketDiff < 0 ? $marketDiff : '+'.$marketDiff}}]</strong><br />
                            <strong class="px-6">Preço/Km: ${{$marketAdvantage}}</strong> <br />
                            <strong class="px-6">Preço/1k: ${{$milKMoney = number_format($avgIncome, 2, ',', '.')}} [{{$longDiff < 0 ? $longDiff : '+'.$longDiff}}]</strong> <br />
                            <strong class="altfont text-white text-lg font-bold">Valores definidos:</strong><br />
                            <strong class="px-6">Preço/Km: ${{$realAdvantage}}</strong> <br />
                            <strong class="px-6">Recompensa: {{$expAvg = number_format($marketATS[0]['unit_reward_per_km']*$marketATS[0]['avg_cargo_unit_count'], 1)}} Exp/Km</strong> <br />
                            
                        </p>
                    </x-mainCard>

            </div>
        </section>
    </main>

</body>
</html>
