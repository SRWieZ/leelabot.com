@props(['name'])

{{-- Small hand-drawn 24x24 stroke set, kept in one place so it stays consistent. --}}
<svg {{ $attributes }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('file')
            <path d="M13.5 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8.5z" />
            <path d="M13.5 3v5.5H19" />
            <path d="M8.5 13h7M8.5 16.5h4.5" />
            @break

        @case('prompt')
            <path d="M21 14a2 2 0 0 1-2 2H8.5L4.5 19.5V5a2 2 0 0 1 2-2H19a2 2 0 0 1 2 2z" />
            <path d="M8.5 8.5 10.5 10.5 8.5 12.5" />
            <path d="M13 12.5h4" />
            @break

        @case('relay')
            <circle cx="4.5" cy="12" r="2.5" />
            <circle cx="19.5" cy="12" r="2.5" />
            <circle cx="12" cy="12" r="1.6" fill="currentColor" stroke="none" />
            <path d="M7.2 12h2.6M14.2 12h2.6" />
            @break

        @case('voice')
            <path d="M4.5 13v-1.5a7.5 7.5 0 0 1 15 0V13" />
            <rect x="2.5" y="12.5" width="4" height="6.5" rx="2" />
            <rect x="17.5" y="12.5" width="4" height="6.5" rx="2" />
            @break
    @endswitch
</svg>
