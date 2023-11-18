<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php use App\Models\Company; @endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$company['name']}} - Rotas de trabalho</title>

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
        window.location.replace('/routes/'+storedId);
    }
</script>

<body class="antialiased">
    
    <x-mainMenu :company="$company" :companyID="$companyID" />

    <main>
        <section>
           
            <x-mainCompany :company="$company" />
            <div class="mainPage_Container">
                
                    @php
                        
                        $dataETS = $routes['ets2'];
                        $dataATS = $routes['ats'];
                        $dataAll = $routes['total'];

                        $dataETS['total_jobs'] > 0 ? $realRaceRatioETS = ($dataETS['real_km']*100)/$dataETS['total_km'] : $realRaceRatioETS = 100; 
                        $dataATS['total_jobs'] > 0 ? $realRaceRatioATS = ($dataATS['real_km']*100)/$dataATS['total_km'] : $realRaceRatioATS = 100; 
    
                    @endphp
                    <x-mainCard refUrl="?game=ets" icon="local_shipping" title="Trabalhos no ETS">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half"><span class="material-symbols-outlined text-xl">bakery_dining</span></h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                            <strong class="altfont text-white text-lg font-bold">Quilometragem de {{$routes['year']}}</strong><br />
                            <strong class="px-6">Total: {{$totalKM = number_format($dataETS['real_km'], 0, '', '.')}} Km</strong> <br />
                            <strong class="altfont text-white text-lg font-bold">Contratos despachados:</strong><br />
                            <strong class="px-6">Contratos Realizados: {{$totalJobs = number_format($dataETS['jobs_completed'], 0, '', '.')}}</strong> <br />
                            <strong class="px-6">Contratos Cancelados: {{$totalJobs = number_format($dataETS['jobs_canceled'], 0, '', '.')}}</strong> <br />
                            <strong class="px-6">Acima da velocidade: {{$totalKM = number_format(100 - $realRaceRatioETS, 0, '', '.')}}%</strong> <br />
                            
                        </p>
                    </x-mainCard>

                    <x-mainCard refUrl="?game=ats" icon="local_shipping" title="Trabalhos no ATS">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white w-half"><span class="material-symbols-outlined text-xl">lunch_dining</span></h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed w-full text-left">
                            <strong class="altfont text-white text-lg font-bold">Quilometragem de {{$routes['year']}}</strong><br />
                            <strong class="px-6">Total: {{$totalKM = number_format($dataATS['real_km'], 0, '', '.')}} Km</strong> <br />
                            <strong class="altfont text-white text-lg font-bold">Contratos despachados:</strong><br />
                            <strong class="px-6">Contratos Realizados: {{$totalJobs = number_format($dataATS['jobs_completed'], 0, '', '.')}}</strong> <br />
                            <strong class="px-6">Contratos Cancelados: {{$totalJobs = number_format($dataATS['jobs_canceled'], 0, '', '.')}}</strong> <br />
                            <strong class="px-6">Acima da velocidade: {{$totalKM = number_format(100 - $realRaceRatioATS, 0, '', '.')}}%</strong> <br />
                            
                        </p>
                    </x-mainCard>

            </div>
        </section>
    </main>

</body>
</html>
