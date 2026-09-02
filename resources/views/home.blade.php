<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Leelabot — an administration bot for Urban Terror</title>
        <meta name="description" content="Leelabot runs your Urban Terror servers: RCon from the chat box, automatic warns and bans, player stats, and an IRC bridge. Free software, written in PHP.">
        <link rel="canonical" href="{{ url('/') }}">
        <meta name="theme-color" content="#2b2830">

        <meta property="og:type" content="website">
        <meta property="og:title" content="Leelabot — an administration bot for Urban Terror">
        <meta property="og:description" content="RCon from the chat box, automatic warns and bans, player stats, and an IRC bridge. Free software, written in PHP.">
        <meta property="og:url" content="{{ url('/') }}">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="relative min-h-screen bg-plum-950 font-sans text-plum-400 antialiased">
        {{-- Backdrop is just the field grid; the team colours live in the HUD. --}}
        <div class="field-grid pointer-events-none fixed inset-0 -z-20"></div>

        <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:rounded-md focus:bg-orchid-600 focus:px-4 focus:py-2 focus:text-white">
            Skip to content
        </a>

        <header class="relative z-30">
            <div class="mx-auto flex max-w-6xl items-center gap-6 px-6 py-6">
                <a href="/" class="shrink-0">
                    <img src="/leelabot-logo.png" alt="Leelabot" width="92" height="48" class="h-9 w-auto">
                </a>

                <nav class="ml-auto flex items-center gap-6 text-sm">
                    <a href="#how" class="hidden text-plum-400 transition-colors hover:text-orchid-300 sm:block">How it works</a>
                    <a href="#plugins" class="hidden text-plum-400 transition-colors hover:text-orchid-300 sm:block">Plugins</a>
                    <a href="#install" class="hidden text-plum-400 transition-colors hover:text-orchid-300 sm:block">Install</a>
                    <a href="{{ config('leelabot.repository') }}" class="font-medium text-plum-100 transition-colors hover:text-orchid-300">GitHub&nbsp;&rarr;</a>
                </nav>
            </div>
        </header>

        <main id="content">
            {{-- Hero --}}
            <section class="mx-auto flex max-w-3xl flex-col items-center gap-7 px-6 pt-14 pb-14 text-center lg:pt-20">
                <span class="inline-flex items-center gap-2 rounded-full border border-orchid-400/30 bg-orchid-500/10 px-3.5 py-1 font-mono text-xs text-orchid-200">
                    Urban Terror &middot; PHP &middot; GPL-2.0+
                </span>

                <h1 class="text-4xl/[1.08] font-semibold tracking-tight text-balance text-white sm:text-5xl/[1.06] lg:text-6xl/[1.05]">
                    Run your Urban Terror servers from the chat box.
                </h1>

                <p class="max-w-xl text-lg/relaxed text-pretty text-plum-300">
                    Leelabot sits between the two teams and your RCon. It answers admin commands typed
                    in game, hands out warns and bans on its own, and keeps the stats.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="#install" class="rounded-lg bg-orchid-600 px-5 py-2.5 text-sm font-medium text-white shadow-lg shadow-black/40 transition-colors hover:bg-orchid-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orchid-400">
                        Get started
                    </a>
                    <a href="{{ config('leelabot.repository') }}" class="rounded-lg border border-white/15 bg-white/5 px-5 py-2.5 text-sm font-medium text-plum-100 transition-colors hover:border-white/30 hover:bg-white/10">
                        Source on GitHub
                    </a>
                </div>
            </section>

            {{-- The bot as it appears in game: chat down the left, score to the right. --}}
            @php($board = config('leelabot.scoreboard'))
            <section class="mx-auto max-w-6xl px-6 pb-24">
                <div class="relative isolate overflow-hidden rounded-2xl border border-white/10 shadow-2xl shadow-black/60">
                    <img src="/ut4-backdrop.jpg" alt="" aria-hidden="true" class="absolute inset-0 -z-10 size-full object-cover">
                    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-plum-950/95 via-plum-950/55 to-plum-950/90"></div>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-plum-950 via-transparent to-plum-950/40"></div>

                    <div class="grid min-h-[23rem] gap-8 p-5 sm:p-7 lg:grid-cols-[minmax(0,1fr)_19rem] lg:gap-10">
                        {{-- Chat, sitting low like it does in game. --}}
                        <div class="order-2 flex flex-col justify-end lg:order-1">
                            <div class="flex flex-col gap-1.5 font-mono text-[13px]/relaxed [text-shadow:0_1px_3px_rgb(0_0_0/0.95)]">
                                @foreach ($board['feed'] as $line)
                                    @php($speaker = match ($line['team']) {
                                        'blue' => 'text-team-blue-bright',
                                        'red' => 'text-team-red-bright',
                                        default => 'text-orchid-300',
                                    })
                                    <p class="flex gap-2">
                                        <span class="shrink-0 text-plum-400">{{ $line['time'] }}</span>
                                        <span class="min-w-0 break-words">
                                            <span class="{{ $speaker }}">{{ $line['who'] }}:</span>
                                            <span class="{{ $line['team'] === 'bot' ? 'text-plum-100' : 'text-white' }}">{{ $line['text'] }}</span>
                                        </span>
                                    </p>
                                @endforeach
                            </div>
                        </div>

                        {{-- Scoreboard, low on the right, built like the in-game one. --}}
                        <div class="order-1 lg:order-2 lg:self-end">
                            <div class="flex flex-col gap-2 overflow-hidden rounded-md border border-white/20 bg-black/40 p-1">
                                <x-team-panel side="blue" :players="$board['blue']" />
                                <x-team-panel side="red" :players="$board['red']" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- What it does, as the pipeline it actually is. --}}
            @php($pipeline = config('leelabot.pipeline'))
            <section id="how" class="border-t border-white/5">
                <div class="mx-auto max-w-6xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">What it does</h2>
                    <p class="mt-4 max-w-2xl text-pretty text-plum-400">
                        It never talks to the game directly. It follows the log files each server writes,
                        hands what it finds to the plugins you loaded, and answers on whichever channel
                        makes sense.
                    </p>

                    <div class="mt-14 grid items-stretch gap-4 lg:grid-cols-[minmax(0,1fr)_5rem_minmax(0,1.25fr)_5rem_minmax(0,1fr)] lg:gap-0">
                        {{-- Reads --}}
                        <div class="flex flex-col rounded-xl border border-white/10 bg-plum-900 p-5">
                            <p class="font-mono text-xs tracking-widest uppercase text-orchid-300">{{ $pipeline['reads']['title'] }}</p>

                            <ul class="my-auto flex flex-col gap-2.5 py-5">
                                @foreach ($pipeline['reads']['nodes'] as $node)
                                    <li class="flex items-center gap-3 rounded-lg border border-white/10 bg-plum-900/60 px-3 py-2.5">
                                        <x-icon :name="$node['icon']" class="size-4 shrink-0 text-plum-400" />
                                        <span class="font-mono text-sm text-plum-100">{{ $node['label'] }}</span>
                                        <span class="ml-auto font-mono text-xs text-plum-500">{{ $node['meta'] }}</span>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                        <x-connector class="lg:px-4" />

                        {{-- Leelabot and its plugins --}}
                        <div class="flex flex-col rounded-xl border border-orchid-400/30 bg-orchid-950 p-5">
                            <p class="font-mono text-xs tracking-widest uppercase text-orchid-300">{{ $pipeline['core']['title'] }}</p>

                            {{-- Plugins ring the core: half above, half below, dotted into it. --}}
                            @php($half = (int) ceil(count($pipeline['core']['plugins']) / 2))
                            <div class="mt-5 flex flex-col items-center gap-2.5">
                                <ul class="flex flex-wrap justify-center gap-2">
                                    @foreach (array_slice($pipeline['core']['plugins'], 0, $half) as $plugin)
                                        <li class="rounded-md border border-white/10 bg-plum-900/60 px-2.5 py-1 font-mono text-xs text-plum-300">{{ $plugin }}</li>
                                    @endforeach
                                </ul>

                                <span class="dot-rule-y h-6 w-px text-orchid-400" aria-hidden="true"></span>

                                <span class="rounded-lg border border-orchid-400/40 bg-plum-950/70 px-4 py-2.5">
                                    <img src="/leelabot-logo.png" alt="Leelabot" width="92" height="48" class="h-7 w-auto">
                                </span>

                                <span class="dot-rule-y h-6 w-px text-orchid-400" aria-hidden="true"></span>

                                <ul class="flex flex-wrap justify-center gap-2">
                                    @foreach (array_slice($pipeline['core']['plugins'], $half) as $plugin)
                                        <li class="rounded-md border border-white/10 bg-plum-900/60 px-2.5 py-1 font-mono text-xs text-plum-300">{{ $plugin }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                        <x-connector class="lg:px-4" />

                        {{-- Answers --}}
                        <div class="flex flex-col rounded-xl border border-white/10 bg-plum-900 p-5">
                            <p class="font-mono text-xs tracking-widest uppercase text-orchid-300">{{ $pipeline['speaks']['title'] }}</p>

                            <ul class="my-auto flex flex-col gap-2.5 py-5">
                                @foreach ($pipeline['speaks']['nodes'] as $node)
                                    <li class="flex items-center gap-3 rounded-lg border border-white/10 bg-plum-900/60 px-3 py-2.5">
                                        <x-icon :name="$node['icon']" class="size-4 shrink-0 text-plum-400" />
                                        <span class="font-mono text-sm text-plum-100">{{ $node['label'] }}</span>
                                        <span class="ml-auto text-xs text-plum-500">{{ $node['meta'] }}</span>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </section>

            {{-- Commands --}}
            <section class="border-t border-white/5">
                <div class="mx-auto max-w-6xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Commands, typed in game</h2>
                    <p class="mt-4 max-w-xl text-pretty text-plum-400">
                        Rights are per command and per admin level, so trusted regulars can call a vote
                        without ever getting near your RCon password. Hover one to see what it does.
                    </p>

                    <ul class="mt-8 flex flex-wrap gap-2">
                        @foreach (config('leelabot.commands') as $index => $command)
                            <li class="group relative">
                                <button
                                    type="button"
                                    aria-describedby="command-{{ $index }}"
                                    class="cursor-help rounded-md border border-white/10 bg-white/5 px-2.5 py-1 font-mono text-sm text-plum-200 transition-colors hover:border-orchid-400/50 hover:bg-orchid-500/10 hover:text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orchid-400"
                                >{{ $command['name'] }}</button>

                                {{-- display:none while idle so the tooltip never widens the page. --}}
                                <span
                                    id="command-{{ $index }}"
                                    role="tooltip"
                                    class="pointer-events-none absolute bottom-full left-1/2 z-20 mb-2 hidden w-52 max-w-[calc(100vw-3rem)] -translate-x-1/2 rounded-lg border border-white/12 bg-plum-850 px-3 py-2 text-xs/relaxed text-plum-200 shadow-xl shadow-black/60 group-hover:block group-focus-within:block"
                                >{{ $command['help'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>

            {{-- Plugins --}}
            <section id="plugins" class="border-t border-white/5">
                <div class="mx-auto max-w-6xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Plugins in the box</h2>
                    <p class="mt-4 max-w-xl text-pretty text-plum-400">
                        Load only what a server needs. Each one is a single PHP file you can read,
                        fork, or use as the template for your own.
                    </p>

                    <dl class="mt-12 grid gap-x-10 gap-y-7 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (config('leelabot.plugins') as $plugin)
                            <div class="flex flex-col gap-1.5 border-l border-orchid-400/30 pl-4">
                                <dt class="font-mono text-sm text-orchid-300">{{ $plugin['name'] }}</dt>
                                <dd class="text-sm/relaxed text-pretty text-plum-400">{{ $plugin['body'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </section>

            {{-- Install --}}
            <section id="install" class="border-t border-white/5">
                <div class="mx-auto grid max-w-6xl gap-10 px-6 py-20 lg:grid-cols-2 lg:gap-16">
                    <div class="flex flex-col gap-5">
                        <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Get it running</h2>
                        <p class="text-pretty text-plum-400">
                            Clone it, point the config at your server's RCon, and start the bot.
                            It runs as a long-lived CLI process — screen, tmux or a systemd unit all work.
                        </p>

                        <dl class="flex flex-col gap-2.5 text-sm">
                            @foreach (config('leelabot.requirements') as $requirement)
                                <div class="flex gap-3">
                                    <dt class="w-20 shrink-0 font-mono text-plum-200">{{ $requirement['name'] }}</dt>
                                    <dd class="text-plum-400">{{ $requirement['detail'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>

                    <div class="min-w-0 overflow-x-auto rounded-xl border border-white/10 bg-plum-900/70 p-5 font-mono text-[13px]/relaxed text-plum-200 shadow-xl shadow-black/40">
                        <p class="whitespace-nowrap"><span class="text-orchid-300">$</span> git clone {{ config('leelabot.repository') }}.git</p>
                        <p class="whitespace-nowrap"><span class="text-orchid-300">$</span> cd Leelabot</p>
                        <p class="mt-3 whitespace-nowrap text-plum-500"># edit the config, then:</p>
                        <p class="whitespace-nowrap"><span class="text-orchid-300">$</span> php bot.php</p>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-white/5">
            <div class="mx-auto flex max-w-6xl flex-col gap-6 px-6 py-12 sm:flex-row sm:items-center">
                <div class="flex flex-col gap-1.5 text-sm text-plum-500">
                    <p>
                        Free software under the
                        <a href="{{ config('leelabot.license') }}" class="text-plum-300 underline underline-offset-2 transition-colors hover:text-orchid-300">GNU GPL v2 or later</a>.
                    </p>
                    <p>Built by Yohann Lorant and Eser Deniz.</p>
                </div>

                <div class="flex items-center gap-6 sm:ml-auto">
                    <a href="{{ config('leelabot.issues') }}" class="text-sm text-plum-400 transition-colors hover:text-orchid-300">Issues</a>
                    <a href="{{ config('leelabot.repository') }}" class="text-sm text-plum-400 transition-colors hover:text-orchid-300">GitHub</a>
                    <img src="/leelabot-badge.png" alt="LeelaBot — UrT Bot" width="88" height="31" class="rounded-xs opacity-80 transition-opacity hover:opacity-100">
                </div>
            </div>
        </footer>
    </body>
</html>
