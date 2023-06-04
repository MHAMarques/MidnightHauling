@props(['company'])

<h1>
    {{$company['name']}}<br />
    <small class="flex items-center gap-4">{{$company['slogan']}} <img src="{{$company['flag_url']}}" /></small>
</h1>