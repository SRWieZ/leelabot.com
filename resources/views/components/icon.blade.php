@props(['name'])

{{-- Hand-drawn 24x24 stroke icons, kept in one place so the set stays consistent. --}}
<svg {{ $attributes }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('servers')
            <rect x="3" y="4" width="18" height="6" rx="2" />
            <rect x="3" y="14" width="18" height="6" rx="2" />
            <path d="M7 7h.01M7 17h.01" />
            @break

        @case('blocks')
            <rect x="3" y="3" width="8" height="8" rx="2" />
            <rect x="13" y="3" width="8" height="8" rx="2" />
            <rect x="3" y="13" width="8" height="8" rx="2" />
            <path d="M17 13.5v7M13.5 17h7" />
            @break

        @case('prompt')
            <path d="M21 14a2 2 0 0 1-2 2H8.5L4.5 19.5V5a2 2 0 0 1 2-2H19a2 2 0 0 1 2 2z" />
            <path d="M8.5 8.5 10.5 10.5 8.5 12.5" />
            <path d="M13 12.5h4" />
            @break

        @case('shield')
            <path d="M12 21.5s7.5-3.75 7.5-9.5V5.25L12 2.5 4.5 5.25V12c0 5.75 7.5 9.5 7.5 9.5z" />
            <path d="m9 11.75 2.25 2.25L15 10.25" />
            @break

        @case('chart')
            <path d="M3.5 3.5v17h17" />
            <rect x="7" y="12" width="3" height="5.5" rx="1" />
            <rect x="12" y="8.5" width="3" height="9" rx="1" />
            <rect x="17" y="5.5" width="3" height="12" rx="1" />
            @break

        @case('relay')
            <circle cx="4.5" cy="12" r="2.5" />
            <circle cx="19.5" cy="12" r="2.5" />
            <circle cx="12" cy="12" r="1.6" fill="currentColor" stroke="none" />
            <path d="M7.2 12h2.6M14.2 12h2.6" />
            @break
    @endswitch
</svg>
