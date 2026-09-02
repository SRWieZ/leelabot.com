@props(['side', 'players'])

@php
    $isBlue = $side === 'blue';

    // Written out in full so Tailwind's scanner can see every class.
    $label = $isBlue ? 'Blue team' : 'Red team';
    $dotClass = $isBlue ? 'bg-team-blue' : 'bg-team-red';
    $labelClass = $isBlue ? 'text-team-blue-bright' : 'text-team-red-bright';
    $barClass = $isBlue ? 'bg-team-blue' : 'bg-team-red';
    $trackClass = $isBlue ? 'bg-team-blue/15' : 'bg-team-red/15';
    $glowClass = $isBlue
        ? 'from-team-blue/12 to-transparent'
        : 'from-team-red/12 to-transparent';

    $kills = array_column($players, 'kills');
    $best = max($kills) ?: 1;
    $score = array_sum($kills);
@endphp

<div {{ $attributes->merge(['class' => 'relative isolate flex flex-col overflow-hidden p-5 sm:p-6']) }}>
    <div class="absolute inset-x-0 top-0 -z-10 h-24 bg-gradient-to-b {{ $glowClass }}"></div>

    <div class="flex items-center gap-2.5">
        <span class="size-2 rounded-full {{ $dotClass }}"></span>
        <span class="font-mono text-xs tracking-widest uppercase {{ $labelClass }}">{{ $label }}</span>
        <span class="ml-auto font-mono text-sm tabular-nums text-plum-200">{{ $score }}</span>
    </div>

    <ul class="my-auto flex flex-col gap-3.5 pt-6">
        @foreach ($players as $player)
            <li class="flex flex-col gap-1.5">
                <div class="flex items-baseline gap-3 font-mono text-sm">
                    <span class="text-plum-200">{{ $player['name'] }}</span>
                    <span class="ml-auto tabular-nums text-plum-300">{{ $player['kills'] }}</span>
                    <span class="tabular-nums text-plum-500">/ {{ $player['deaths'] }}</span>
                </div>
                <div class="h-1 overflow-hidden rounded-full {{ $trackClass }}">
                    <div class="h-full rounded-full {{ $barClass }}" style="width: {{ round($player['kills'] / $best * 100) }}%"></div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
