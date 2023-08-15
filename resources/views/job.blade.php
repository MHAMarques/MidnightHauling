<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php use App\Models\Members; @endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$job['driver']['name']}} - {{$job['cargo_name']}} [{{$job['cargo_mass']}}Tons]</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{$job['driver']['avatar_url']}}">
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
        window.location.replace('/drivers/'+storedId);
    }
</script>
@php
$timeTranslations = [
    'hours' => 'horas',
    'hour' => 'hora',
    'minutes' => 'minutos',
    'minute' => 'minuto',
    'seconds' => 'segundos',
    'second' => 'segundo'
];
@endphp

<body class="antialiased">
    
    <x-mainMenu :company="$job['company']" :companyID="$companyID" />

    <main>
        <section>
           
            <x-mainJob :job="$job" />
            <div class="mainPage_Container">
                
                @php 
                    $avgIncome = $job['cargo_definition']['avg_job_income']['1000'] ?? 0;
                    $avgPKM = $job['cargo_definition']['price_per_km'] ?? 0;
                    $realAverage = 0;
                    $realCut = 0;
                    if($job['driven_distance'] > 0){
                        $realAverage = number_format($job['income']/$job['driven_distance'], 2);
                        $realCut = 100 - (($job['revenue'] * 100) / $job['income']);
                    }
                    $realAdvantage = number_format(($realAverage - ($avgIncome/1000)), 2, ',', '.') ?? 0;
                @endphp

                <x-mainCard refUrl="#"  icon="map" title="{{$job['game_id'] == 2 ? 'ATS' : 'ETS'}} - {{$totalKM = number_format($job['driven_distance'], 0, '', '.')}} Km">
                    <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half">{{$job['points']}}<br />EXP</h2>
                    <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                        <strong class="altfont text-white text-lg font-bold">{{$job['status'] == 'in_progress' ? 'Pendente' : strtr($job['duration'], $timeTranslations)}}</strong><br />
                        <strong class="text-white">« {{$job['source_city_name']}}</strong> (<strong>{{$job['source_company_name']}} / {{$job['auto_load'] ? 'Carga Automática' : 'Carga Manual'}}</strong>)<br />
                        <strong class="px-6">- {{$formattedDate = (new DateTime($job['started_at']))->format('d / M / y - H:i:s')}}</strong><br />
                        <strong class="text-white">» {{$job['destination_city_name']}}</strong> (<strong>{{$job['destination_company_name']}} / {{$job['auto_park'] ? 'Carga Automática' : 'Carga Manual'}}</strong>)<br />
                        <strong class="px-6">- {{$formattedDate = (new DateTime($job['completed_at']))->format('d / M / y - H:i:s')}}</strong><br />
                    </p>
                </x-mainCard>

                <x-mainCard refUrl="#"  icon="local_shipping" title="{{$job['vehicle_brand_name']}} {{$job['vehicle_model_name']}}">
                    <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half">{{$job['max_speed']}}<br />KPH</h2>
                    <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                        <strong class="altfont text-white text-lg font-bold">Velocidade média: {{$job['average_speed_kmh']}}Km/h</strong><br />
                        <strong>{{$job['vehicle'] ? 'Garagem: '.$job['vehicle']['garage']['city']['name'] : 'Locação: $'.$revMoney = number_format($job['rent_cost_total'], 2, ',', '.')}}</strong> <br />
                        <strong>Combustível: ${{$revMoney = number_format($job['fuel_cost'], 2, ',', '.')}} / {{$job['fuel_used']}} L</strong><br />
                        <strong class="altfont text-white text-lg font-bold">Avarias: {{$job['total_damage']}}%</strong><br />
                        <strong class="px-6">Veículo ({{$job['vehicle_damage']}}%), Reboque ({{$job['trailers_damage']}}%) e Carga ({{$job['cargo_damage']}}%)<br /></strong>
                    </p>
                </x-mainCard>

                <x-mainCard refUrl="#"  icon="paid" title="${{$money = number_format($job['income'], 2, ',', '.')}}">
                    <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half">-{{number_format($realCut, 0, ',', '.') ?? 0}}%</h2>
                    <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                        <strong class="altfont text-white text-lg font-bold">Impostos: - ${{$showTaxes = number_format($job['taxes'], 2, ',', '.')}}</strong><br />
                        <strong class="px-6">Despesas: - ${{$damageMoney = number_format($job['other_costs_total'], 2, ',', '.')}}</strong> <br />
                        <strong class="px-6">Reparos: - ${{$damageMoney = number_format($job['damage_cost'], 2, ',', '.')}}</strong> <br />
                        <strong class="px-6">Veículo: - ${{$damageMoney = number_format($job['fuel_cost'] + $job['rent_cost_total'], 2, ',', '.')}}</strong> <br />
                        <strong class="altfont text-white text-lg font-bold">Renda: ${{$revenueMoney = number_format($job['revenue'], 2, ',', '.')}}</strong><br />
                    </p>
                </x-mainCard>

                <x-mainCard refUrl="#"  icon="query_stats" title="Mercado Trucky: {{$avgIncome ? '± $'.$money = number_format($avgIncome/1000, 2, ',', '.') . '/Km' : '0,00'}}">
                    <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half">{{$realAdvantage > 0 ? '+' . $realAdvantage : $realAdvantage}}<br />$Km</h2>
                    <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                        <strong class="altfont text-white text-lg font-bold">Tabelado: ${{$avgPKM}}/Km</strong><br />
                        <strong class="px-6">Pago: ${{$realAverage}}/Km</strong> <br />
                        <strong class="altfont text-white text-lg font-bold">Tabelado: ${{$money = number_format($job['driven_distance'] * $avgPKM, 2, ',', '.')}}</strong><br />
                        <strong class="px-6">Pago: ${{$paidMoney = number_format($job['income'], 2, ',', '.')}}</strong> <br />
                    </p>
                </x-mainCard>
                
            </div>
        </section>
    </main>

</body>
</html>
