{{-- Dotted link between two stages of the pipeline: vertical when the columns
     stack, horizontal once they sit side by side. --}}
<div {{ $attributes->merge(['class' => 'flex items-center justify-center text-orchid-400/70']) }} aria-hidden="true">
    <span class="flex flex-col items-center lg:hidden">
        <span class="dot-rule-y h-8 w-px"></span>
        <svg class="size-2.5" viewBox="0 0 10 10" fill="currentColor"><path d="M0 0h10L5 10z" /></svg>
    </span>

    <span class="hidden w-full items-center lg:flex">
        <span class="dot-rule-x h-px flex-1"></span>
        <svg class="size-2.5 shrink-0" viewBox="0 0 10 10" fill="currentColor"><path d="M0 0v10l10-5z" /></svg>
    </span>
</div>
