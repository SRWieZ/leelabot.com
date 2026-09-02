<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Leelabot — an administration bot for Urban Terror</title>
        <meta name="description" content="Leelabot runs your Urban Terror servers: RCon from the chat box, automatic warns and bans, player stats, and an IRC bridge. Free software, written in PHP.">
        <link rel="canonical" href="{{ url('/') }}">
        <meta name="theme-color" content="#191320">

        <meta property="og:type" content="website">
        <meta property="og:title" content="Leelabot — an administration bot for Urban Terror">
        <meta property="og:description" content="RCon from the chat box, automatic warns and bans, player stats, and an IRC bridge. Free software, written in PHP.">
        <meta property="og:url" content="{{ url('/') }}">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="relative min-h-screen bg-plum-950 font-sans text-plum-400 antialiased">
        {{-- Backdrop: blue on the left, red on the right, orchid pooled in the middle. --}}
        <div class="team-wash pointer-events-none fixed inset-0 -z-20"></div>
        <div class="field-grid pointer-events-none fixed inset-0 -z-20"></div>
        <div class="pointer-events-none fixed inset-y-0 left-0 -z-10 w-px bg-gradient-to-b from-transparent via-team-blue/40 to-transparent"></div>
        <div class="pointer-events-none fixed inset-y-0 right-0 -z-10 w-px bg-gradient-to-b from-transparent via-team-red/40 to-transparent"></div>

        <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:rounded-md focus:bg-orchid-600 focus:px-4 focus:py-2 focus:text-white">
            Skip to content
        </a>

        <header class="sticky top-0 z-40 border-b border-white/5 bg-plum-950/70 backdrop-blur-md">
            <div class="mx-auto flex max-w-6xl items-center gap-6 px-6 py-4">
                <a href="/" class="flex items-center gap-2.5 font-semibold tracking-tight text-white">
                    <x-mark class="size-7 text-orchid-400" />
                    Leelabot
                </a>

                <nav class="ml-auto flex items-center gap-6 text-sm">
                    <a href="#features" class="hidden text-plum-400 transition-colors hover:text-orchid-300 sm:block">Features</a>
                    <a href="#plugins" class="hidden text-plum-400 transition-colors hover:text-orchid-300 sm:block">Plugins</a>
                    <a href="#install" class="hidden text-plum-400 transition-colors hover:text-orchid-300 sm:block">Install</a>
                    <a href="{{ config('leelabot.repository') }}" class="font-medium text-plum-100 transition-colors hover:text-orchid-300">GitHub&nbsp;&rarr;</a>
                </nav>
            </div>
        </header>

        <main id="content">
            {{-- Hero --}}
            <section class="mx-auto flex max-w-3xl flex-col items-center gap-7 px-6 pt-20 pb-16 text-center lg:pt-28">
                <span class="inline-flex items-center gap-2 rounded-full border border-orchid-500/30 bg-orchid-500/10 px-3.5 py-1 font-mono text-xs text-orchid-200">
                    Urban Terror &middot; PHP &middot; GPL-2.0+
                </span>

                <h1 class="text-4xl/[1.08] font-semibold tracking-tight text-balance text-white sm:text-5xl/[1.06] lg:text-6xl/[1.05]">
                    Run your Urban Terror servers from the chat box.
                </h1>

                <p class="max-w-xl text-lg/relaxed text-pretty text-plum-400">
                    Leelabot sits between the two teams and your RCon. It answers admin commands typed
                    in game, hands out warns and bans on its own, and keeps the stats.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="#install" class="rounded-lg bg-orchid-600 px-5 py-2.5 text-sm font-medium text-white shadow-lg shadow-orchid-950/50 transition-colors hover:bg-orchid-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orchid-400">
                        Get started
                    </a>
                    <a href="{{ config('leelabot.repository') }}" class="rounded-lg border border-white/12 bg-white/4 px-5 py-2.5 text-sm font-medium text-plum-100 transition-colors hover:border-white/25 hover:bg-white/8">
                        Source on GitHub
                    </a>
                </div>
            </section>

            {{-- The showpiece: both sides of the server, with the bot in the middle. --}}
            @php($board = config('leelabot.scoreboard'))
            <section class="mx-auto max-w-6xl px-6 pb-24">
                <div class="overflow-hidden rounded-2xl border border-white/8 bg-plum-900/50 shadow-2xl shadow-black/50 backdrop-blur-sm">
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 border-b border-white/8 px-5 py-3 font-mono text-xs text-plum-500">
                        <span class="text-plum-300">{{ $board['map'] }}</span>
                        <span aria-hidden="true">&middot;</span>
                        <span>{{ $board['gametype'] }}</span>
                        <span aria-hidden="true">&middot;</span>
                        <span>{{ count($board['blue']) + count($board['red']) }} players</span>
                    </div>

                    <div class="grid lg:grid-cols-[minmax(0,1fr)_minmax(0,1.2fr)_minmax(0,1fr)]">
                        <x-team-panel side="blue" :players="$board['blue']" />

                        {{-- Leelabot, centre stage. --}}
                        <div class="relative isolate flex flex-col gap-5 border-y border-white/8 bg-orchid-950/40 p-5 sm:p-6 lg:border-x lg:border-y-0">
                            <div class="bot-glow pointer-events-none absolute inset-x-0 top-0 -z-10 h-40"></div>

                            <div class="flex flex-col items-center gap-2 pt-1">
                                <span class="grid size-14 place-items-center rounded-2xl border border-orchid-400/25 bg-orchid-500/12 text-orchid-300 shadow-lg shadow-orchid-950/60">
                                    <x-mark class="size-8" />
                                </span>
                                <span class="font-semibold tracking-tight text-white">Leelabot</span>
                                <span class="font-mono text-[11px] tracking-widest uppercase text-orchid-300/70">refereeing</span>
                            </div>

                            {{-- Lines wrap against the timestamp gutter rather than scrolling out of view. --}}
                            <div class="min-w-0 rounded-lg border border-white/8 bg-plum-950/60 p-3.5">
                                <div class="flex flex-col gap-2 font-mono text-[13px]/relaxed">
                                    @foreach ($board['feed'] as $line)
                                        @php($speaker = match ($line['team']) {
                                            'blue' => 'text-team-blue-bright',
                                            'red' => 'text-team-red-bright',
                                            default => 'text-orchid-300',
                                        })
                                        <p class="flex gap-2">
                                            <span class="shrink-0 text-plum-500">{{ $line['time'] }}</span>
                                            <span class="min-w-0 break-words">
                                                <span class="{{ $speaker }}">{{ $line['who'] }}:</span>
                                                <span class="{{ $line['team'] === 'bot' ? 'text-plum-300' : 'text-plum-100' }}">{{ $line['text'] }}</span>
                                            </span>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <x-team-panel side="red" :players="$board['red']" />
                    </div>
                </div>
            </section>

            {{-- Features --}}
            <section id="features" class="border-t border-white/5 bg-plum-950/40">
                <div class="mx-auto max-w-6xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">What it does</h2>

                    <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (config('leelabot.features') as $feature)
                            <div class="flex flex-col gap-3 rounded-xl border border-white/8 bg-white/3 p-5 transition-colors hover:border-orchid-500/30 hover:bg-orchid-500/5">
                                <span class="grid size-10 place-items-center rounded-lg border border-orchid-400/20 bg-orchid-500/10 text-orchid-300">
                                    <x-icon :name="$feature['icon']" class="size-5" />
                                </span>
                                <h3 class="font-medium text-white">{{ $feature['title'] }}</h3>
                                <p class="text-sm/relaxed text-pretty text-plum-400">{{ $feature['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Commands --}}
            <section class="border-t border-white/5">
                <div class="mx-auto max-w-6xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Commands, typed in game</h2>
                    <p class="mt-4 max-w-xl text-pretty text-plum-400">
                        Rights are per command and per admin level, so trusted regulars can call a vote
                        without ever getting near your RCon password.
                    </p>

                    <ul class="mt-8 flex flex-wrap gap-2">
                        @foreach (config('leelabot.commands') as $command)
                            <li class="rounded-md border border-white/8 bg-white/4 px-2.5 py-1 font-mono text-sm text-plum-300">{{ $command }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>

            {{-- Plugins --}}
            <section id="plugins" class="border-t border-white/5 bg-plum-950/40">
                <div class="mx-auto max-w-6xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-white sm:text-3xl">Plugins in the box</h2>
                    <p class="mt-4 max-w-xl text-pretty text-plum-400">
                        Load only what a server needs. Each one is a single PHP file you can read,
                        fork, or use as the template for your own.
                    </p>

                    <dl class="mt-12 grid gap-x-10 gap-y-7 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (config('leelabot.plugins') as $plugin)
                            <div class="flex flex-col gap-1.5 border-l border-orchid-500/25 pl-4">
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

                    <div class="min-w-0 overflow-x-auto rounded-xl border border-white/8 bg-plum-950/70 p-5 font-mono text-[13px]/relaxed text-plum-300 shadow-xl shadow-black/40">
                        <p class="whitespace-nowrap"><span class="text-orchid-400">$</span> git clone {{ config('leelabot.repository') }}.git</p>
                        <p class="whitespace-nowrap"><span class="text-orchid-400">$</span> cd Leelabot</p>
                        <p class="mt-3 whitespace-nowrap text-plum-500"># edit the config, then:</p>
                        <p class="whitespace-nowrap"><span class="text-orchid-400">$</span> php bot.php</p>
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
