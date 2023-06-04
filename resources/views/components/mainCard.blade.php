@props(['refUrl', 'icon', 'title'])

<a href="{{$refUrl}}" class="w-card min-w-screen p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex focus:outline focus:outline-2 focus:outline-red-500 hover:outline hover:outline-2 hover:outline-red-500">
    <article class="w-full mainPage_Card">    
        <div class="flex items-center gap-4 text-xl">
            <span class="material-symbols-outlined text-xl">{{$icon}}</span>
            <h3>{{$title}}</h3>
        </div>

        <div class="mainPage_CardContent mt-6">
            {{$slot}}
        </div>
    </article>
</a>