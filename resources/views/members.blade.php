<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$company['name']}}</title>

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
        window.location.replace('/drivers/'+storedId);
    }
</script>

<body class="antialiased">
    
    <x-mainMenu :company="$company" :companyID="$companyID" />

    <main>
        <section>
           
            <x-mainCompany :company="$company" />
            <div class="mainPage_Container">
                @foreach ($members['data'] as $member)
                    <x-mainCard refUrl="?driver={{$member['id']}}" icon="{{$member['role']['name'] == 'Owner' ? 'social_leaderboard' : 'account_circle'}}" title="{{$member['name']}}">
                        <h2 class="icon_card text-lg font-semibold text-gray-900 dark:text-white">lvl {{$member['level']}}</h2>
                        <p class="px-6 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                           <strong>Cargo:</strong> {{$member['role']['name']}}<br />
                           <strong>Inatividade:</strong> {{$member['last_job_days']}} dias<br />
                           <strong>Rentabilidade:</strong> ${{$money = number_format($member['total_revenue'], 2, ',', '.')}}<br />
                           <strong>Distância total:</strong> {{$totalKM = number_format($member['total_driven_distance'], 0, '', '.')}}Km<br />
                        </p>
                    </x-mainCard>
                @endforeach
            </div>
            <div class="w-full flex justify-center gap-6">
                @if ($members['current_page'] > 1)
                    <a class="mt-16" href="?page={{$members['current_page']-1}}">Página anterior</a>
                @endif
                @if ($members['current_page'] < $members['last_page'])
                    <a class="mt-16" href="?page={{$members['current_page']+1}}">Próxima página</a>
                @endif
            </div>
        </section>
    </main>

</body>
</html>
