@props(['side', 'players'])

@php
    $isBlue = $side === 'blue';

    // Written out in full so Tailwind's scanner can see every class.
    $label = $isBlue ? 'Blue' : 'Red';
    $barClass = $isBlue ? 'bg-hud-blue-bar' : 'bg-hud-red-bar';
    $rowClass = $isBlue ? 'bg-hud-blue' : 'bg-hud-red';

    $score = array_sum(array_column($players, 'kills'));
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col gap-px']) }}>
    <div class="flex items-center gap-2 px-2 py-1.5 font-mono text-xs text-white {{ $barClass }}">
        <span class="tracking-widest uppercase">{{ $label }}</span>
        <span class="ml-auto text-sm leading-none tabular-nums">{{ $score }}</span>
    </div>

    {{-- A filled square marks a player still alive; the dead go dim, as in game. --}}
    <ul class="flex flex-col gap-px">
        @foreach ($players as $player)
            <li class="flex items-center gap-2 px-2 py-1 font-mono text-xs {{ $rowClass }} {{ $player['alive'] ? 'text-white' : 'text-white/45' }}">
                <span class="size-1.5 shrink-0 {{ $player['alive'] ? 'bg-white' : 'bg-white/30' }}"></span>
                <span class="tabular-nums">{{ $player['kills'] }}:{{ $player['deaths'] }}</span>
                <span class="truncate">{{ $player['name'] }}</span>
            </li>
        @endforeach
    </ul>
</div>
