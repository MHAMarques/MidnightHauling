<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php 
    use App\Models\Company;
    usort($marketETS, function ($a, $b) {
        return $b['avg_job_income']['1000'] <=> $a['avg_job_income']['1000'];
    });
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$company['name']}} - Mercado ETS TruckyApp</title>

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
           
            <x-mainMarket pageTitle="Valores do Mercado ETS" pageDetails="Lista de cargas do mercado TruckyApp" />
            <div class="mainPage_Container">
                
                @foreach ($marketETS as $market)
                @php
                    
                    $jobCargo = $market['groups'][0] ?? 'none';
                    $typeCargo = $market['body_types'][0] ?? 'none';
                    $cargoType = Company::cargoIcons($jobCargo, $typeCargo);
                    $avgIncome = $market['avg_job_income']['1000'] ?? 0;
                    $realAdvantage = $market['price_per_km'] ?? 0;
                    $marketAdvantage = $market['price_per_km_with_market_change'] ?? 0;
                    $marketDiff = $marketAdvantage - $realAdvantage;
                    $longDiff = ($avgIncome/1000) - $marketAdvantage;
                    $fragility = $market['fragility']*100;

                @endphp
                    <x-mainCard refUrl="#" icon="{{$cargoType}}" title="{{$market['localized_names']['pt_br'] ?? $market['name']}} - {{$market['avg_cargo_mass_t']}}T">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half">{{$realAdv = number_format($realAdvantage, 1)}}<br />$/Km</h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                            <strong class="altfont text-white text-lg font-bold">Média de mercado:</strong><br />
                            <strong class="px-6">Preço/Km: ${{$marketAdvantage}} [{{$marketDiff < 0 ? $marketDiff : '+'.$marketDiff}}]</strong> <br />
                            <strong class="px-6">Preço/1k: ${{$milKMoney = number_format($avgIncome, 2, ',', '.')}} [{{$longDiff < 0 ? $longDiff : '+'.$longDiff}}]</strong> <br />
                            <strong class="altfont text-white text-lg font-bold">Detalhes:</strong><br />
                            <strong class="px-6">Recompensa: {{$expAvg = number_format($market['unit_reward_per_km']*$market['avg_cargo_unit_count'], 1)}} Exp/Km</strong> <br />
                            <strong class="px-6">Fragilidade: {{$fragility < 25 ? 'Baixa' : ''}}{{$fragility >= 25 && $fragility < 50 ? 'Média' : ''}}{{$fragility >= 50 && $fragility < 75 ? 'Alta' : ''}}{{$fragility >= 75 ? 'Extrema' : ''}}</strong> <br />
                            
                        </p>
                    </x-mainCard>
                @endforeach
            </div>
        </section>
    </main>

</body>
</html>
