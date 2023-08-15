<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php use App\Models\Members; @endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$member['name']}} - Motorista</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{$member['avatar_url']}}">
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
    
    <x-mainMenu :company="$member['company']" :companyID="$companyID" />

    <main>
        <section>
           
            <x-mainMember :member="$member" />
            <div class="mainPage_Container">
                
                @foreach ($jobs['data'] as $job)
                    @if ($job['company_id'] == $companyID)
                    @php
                        
                        $jobCargo = $job['cargo_definition']['groups'][0] ?? 'none';
                        $typeCargo = $job['cargo_definition']['body_types'][0] ?? 'none';
                        $cargoType = Members::jobIcons($jobCargo, $typeCargo);
                        
                    @endphp

                    <x-mainCard refUrl="?job={{$job['id']}}"  icon="{{$cargoType}}" title="{{$job['cargo_definition']['localized_names']['pt_br'] ?? $job['cargo_name']}} - {{$job['cargo_mass'] .'T'}}">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half">{{$job['max_speed'] ? $job['max_speed'] : '?'}}<br />KPH</h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full">
                            <strong class="altfont text-white text-lg font-bold">{{$formattedDate = (new DateTime($job['created_at']))->format('d / M / y')}} - {{$job['game_id'] == 2 ? 'ATS' : 'ETS'}}<br /></strong> 
                            <strong>{{$job['status'] == 'in_progress' ? 'Pendente' : strtr($job['duration'], $timeTranslations)}}<br /></strong>
                            <strong>« {{$job['source_city_name']}}</strong> (<strong>{{$job['source_company_name']}})</strong><br />
                            <strong>» {{$job['destination_city_name']}}</strong> (<strong>{{$job['destination_company_name']}}</strong>)<br />
                            <strong>{{$totalKM = number_format($job['driven_distance'], 0, '', '.')}}Km de {{$job['vehicle_brand_name']}} {{$job['vehicle_model_name']}}<br /></strong> 
                            <strong class="altfont text-white text-lg font-bold">Pagamento:</strong><br />
                            <strong>Total: ${{$incMoney = number_format($job['income'], 2, ',', '.')}}<br />{{'Final: $' . $revMoney = number_format($job['revenue'], 2, ',', '.')}}<br /></strong> 
                        </p>
                    </x-mainCard>
                    @endif
                @endforeach
            
            </div>
            <div class="w-full flex justify-center gap-6">
                @if ($jobs['current_page'] > 1)
                    <a class="mt-16" href="?driver={{$member['id']}}&turn={{$jobs['current_page']-1}}">Página anterior</a>
                @endif
                @if ($jobs['current_page'] < $jobs['last_page'])
                    <a class="mt-16" href="?driver={{$member['id']}}&turn={{$jobs['current_page']+1}}">Próxima página</a>
                @endif
            </div>
        </section>
    </main>

</body>
</html>
