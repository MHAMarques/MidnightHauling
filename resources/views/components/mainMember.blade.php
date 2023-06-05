@props(['member'])

<h1>
    <img src="{{$member['avatar_url']}}" width="100" height="auto"/>{{$member['name']}}<br />
    <small class="flex items-center gap-4">lvl. {{$member['level']}} - {{$member['company']['name'] . ' (' . $member['role']['name']}})
        @if ($member['flag_url'])
            <img src="{{$member['flag_url']}}" />
        @endif
    </small>
</h1>