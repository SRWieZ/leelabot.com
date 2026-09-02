@props(['side', 'players'])

@php
    $isBlue = $side === 'blue';

    // Written out in full so Tailwind's scanner can see every class.
    $label = $isBlue ? 'Blue' : 'Red';
    $dotClass = $isBlue ? 'bg-team-blue' : 'bg-team-red';
    $labelClass = $isBlue ? 'text-team-blue-bright' : 'text-team-red-bright';

    $score = array_sum(array_column($players, 'kills'));
@endphp

<div {{ $attributes }}>
    <div class="flex items-center gap-2">
        <span class="size-1.5 rounded-full {{ $dotClass }}"></span>
        <span class="font-mono text-xs tracking-widest uppercase {{ $labelClass }}">{{ $label }}</span>
        <span class="ml-auto font-mono text-lg leading-none tabular-nums text-white">{{ $score }}</span>
    </div>

    <ul class="mt-2.5 flex flex-col gap-1">
        @foreach ($players as $player)
            <li class="flex items-baseline gap-3 font-mono text-xs">
                <span class="truncate text-plum-300">{{ $player['name'] }}</span>
                <span class="ml-auto tabular-nums text-plum-200">{{ $player['kills'] }}</span>
                <span class="w-8 shrink-0 text-right tabular-nums text-plum-500">/ {{ $player['deaths'] }}</span>
            </li>
        @endforeach
    </ul>
</div>
