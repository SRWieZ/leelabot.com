<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Leelabot — an administration bot for Urban Terror</title>
        <meta name="description" content="Leelabot runs your Urban Terror servers: RCon from the chat box, automatic warns and bans, player stats, and an IRC bridge. Free software, written in PHP.">
        <link rel="canonical" href="{{ url('/') }}">

        <meta property="og:type" content="website">
        <meta property="og:title" content="Leelabot — an administration bot for Urban Terror">
        <meta property="og:description" content="RCon from the chat box, automatic warns and bans, player stats, and an IRC bridge. Free software, written in PHP.">
        <meta property="og:url" content="{{ url('/') }}">

        @fonts

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-white font-sans text-zinc-800 antialiased dark:bg-zinc-950 dark:text-zinc-300">
        <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:rounded-md focus:bg-ember-600 focus:px-4 focus:py-2 focus:text-white">
            Skip to content
        </a>

        <header class="sticky top-0 z-40 border-b border-zinc-200/80 bg-white/85 backdrop-blur-sm dark:border-zinc-800/80 dark:bg-zinc-950/85">
            <div class="mx-auto flex max-w-5xl items-center gap-6 px-6 py-4">
                <a href="/" class="flex items-center gap-2.5 font-semibold tracking-tight text-zinc-900 dark:text-white">
                    <x-mark class="size-7 text-ember-600 dark:text-ember-500" />
                    Leelabot
                </a>

                <nav class="ml-auto flex items-center gap-6 text-sm">
                    <a href="#features" class="hidden text-zinc-600 transition-colors hover:text-ember-700 sm:block dark:text-zinc-400 dark:hover:text-ember-400">Features</a>
                    <a href="#plugins" class="hidden text-zinc-600 transition-colors hover:text-ember-700 sm:block dark:text-zinc-400 dark:hover:text-ember-400">Plugins</a>
                    <a href="#install" class="hidden text-zinc-600 transition-colors hover:text-ember-700 sm:block dark:text-zinc-400 dark:hover:text-ember-400">Install</a>
                    <a href="{{ config('leelabot.repository') }}" class="font-medium text-zinc-900 transition-colors hover:text-ember-700 dark:text-white dark:hover:text-ember-400">GitHub&nbsp;&rarr;</a>
                </nav>
            </div>
        </header>

        <main id="content">
            {{-- Hero --}}
            <section class="border-b border-zinc-200 dark:border-zinc-800">
                <div class="mx-auto grid max-w-5xl gap-12 px-6 py-20 lg:grid-cols-2 lg:items-center lg:py-28">
                    <div class="flex flex-col items-start gap-6">
                        <span class="inline-flex items-center gap-2 rounded-full border border-ember-200 bg-ember-50 px-3 py-1 font-mono text-xs text-ember-800 dark:border-ember-900 dark:bg-ember-900/25 dark:text-ember-300">
                            Urban Terror &middot; PHP &middot; GPL-2.0+
                        </span>

                        <h1 class="text-4xl font-semibold tracking-tight text-balance text-zinc-900 sm:text-5xl dark:text-white">
                            Run your Urban Terror servers from the chat box.
                        </h1>

                        <p class="max-w-lg text-lg/relaxed text-pretty text-zinc-600 dark:text-zinc-400">
                            Leelabot sits between you and RCon. It watches every server you point it at,
                            answers admin commands typed in game, hands out warns and bans on its own,
                            and keeps the stats.
                        </p>

                        <div class="flex flex-wrap items-center gap-3">
                            <a href="#install" class="rounded-md bg-ember-600 px-5 py-2.5 text-sm font-medium text-white shadow-sm transition-colors hover:bg-ember-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-ember-600">
                                Get started
                            </a>
                            <a href="{{ config('leelabot.repository') }}" class="rounded-md border border-zinc-300 px-5 py-2.5 text-sm font-medium text-zinc-800 transition-colors hover:border-zinc-400 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:border-zinc-600 dark:hover:bg-zinc-900">
                                Source on GitHub
                            </a>
                        </div>
                    </div>

                    {{-- A slice of what the bot looks like in game. --}}
                    <div class="min-w-0 overflow-hidden rounded-xl border border-zinc-200 bg-zinc-900 shadow-xl dark:border-zinc-800">
                        <div class="flex items-center gap-1.5 border-b border-zinc-800 px-4 py-3">
                            <span class="size-2.5 rounded-full bg-zinc-700"></span>
                            <span class="size-2.5 rounded-full bg-zinc-700"></span>
                            <span class="size-2.5 rounded-full bg-zinc-700"></span>
                            <span class="ml-2 font-mono text-xs text-zinc-500">ut4_casa &middot; 12/16 players</span>
                        </div>

                        <div class="overflow-x-auto px-4 py-4 font-mono text-[13px]/relaxed">
                            <p class="whitespace-nowrap"><span class="text-zinc-600">19:04</span> <span class="text-zinc-300">Zaki:</span> <span class="text-white">!stats</span></p>
                            <p class="whitespace-nowrap"><span class="text-zinc-600">19:04</span> <span class="text-ember-500">Leelabot:</span> <span class="text-zinc-400">Zaki &mdash; 24 kills, 9 deaths, ratio 2.66</span></p>
                            <p class="mt-2 whitespace-nowrap"><span class="text-zinc-600">19:06</span> <span class="text-zinc-300">Duke:</span> <span class="text-white">!nextmap</span></p>
                            <p class="whitespace-nowrap"><span class="text-zinc-600">19:06</span> <span class="text-ember-500">Leelabot:</span> <span class="text-zinc-400">Next map is ut4_turnpike</span></p>
                            <p class="mt-2 whitespace-nowrap"><span class="text-zinc-600">19:11</span> <span class="text-ember-500">Leelabot:</span> <span class="text-zinc-400">Rook warned (2/3) &mdash; teamkill</span></p>
                            <p class="mt-2 whitespace-nowrap"><span class="text-zinc-600">19:12</span> <span class="text-zinc-300">admin:</span> <span class="text-white">!cyclemap</span></p>
                            <p class="whitespace-nowrap"><span class="text-zinc-600">19:12</span> <span class="text-ember-500">Leelabot:</span> <span class="text-zinc-400">Cycling map&hellip;</span></p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Features --}}
            <section id="features" class="border-b border-zinc-200 dark:border-zinc-800">
                <div class="mx-auto max-w-5xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">What it does</h2>

                    <div class="mt-10 grid gap-x-10 gap-y-8 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (config('leelabot.features') as $feature)
                            <div class="flex flex-col gap-2">
                                <h3 class="font-medium text-zinc-900 dark:text-white">{{ $feature['title'] }}</h3>
                                <p class="text-sm/relaxed text-pretty text-zinc-600 dark:text-zinc-400">{{ $feature['body'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Commands --}}
            <section class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900/40">
                <div class="mx-auto max-w-5xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Commands, typed in game</h2>
                    <p class="mt-3 max-w-xl text-pretty text-zinc-600 dark:text-zinc-400">
                        Rights are per command and per admin level, so trusted regulars can call a vote
                        without ever getting near your RCon password.
                    </p>

                    <ul class="mt-8 flex flex-wrap gap-2">
                        @foreach (config('leelabot.commands') as $command)
                            <li class="rounded-md border border-zinc-200 bg-white px-2.5 py-1 font-mono text-sm text-zinc-700 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300">{{ $command }}</li>
                        @endforeach
                    </ul>
                </div>
            </section>

            {{-- Plugins --}}
            <section id="plugins" class="border-b border-zinc-200 dark:border-zinc-800">
                <div class="mx-auto max-w-5xl px-6 py-20">
                    <h2 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Plugins in the box</h2>
                    <p class="mt-3 max-w-xl text-pretty text-zinc-600 dark:text-zinc-400">
                        Load only what a server needs. Each one is a single PHP file you can read,
                        fork, or use as the template for your own.
                    </p>

                    <dl class="mt-10 grid gap-x-10 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (config('leelabot.plugins') as $plugin)
                            <div class="flex flex-col gap-1">
                                <dt class="font-mono text-sm text-ember-700 dark:text-ember-400">{{ $plugin['name'] }}</dt>
                                <dd class="text-sm/relaxed text-pretty text-zinc-600 dark:text-zinc-400">{{ $plugin['body'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </section>

            {{-- Install --}}
            <section id="install" class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900/40">
                <div class="mx-auto grid max-w-5xl gap-12 px-6 py-20 lg:grid-cols-2">
                    <div class="flex flex-col gap-4">
                        <h2 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">Get it running</h2>
                        <p class="text-pretty text-zinc-600 dark:text-zinc-400">
                            Clone it, point the config at your server's RCon, and start the bot.
                            It runs as a long-lived CLI process — screen, tmux or a systemd unit all work.
                        </p>

                        <dl class="mt-2 flex flex-col gap-2 text-sm">
                            @foreach (config('leelabot.requirements') as $requirement)
                                <div class="flex gap-2">
                                    <dt class="font-mono text-zinc-900 dark:text-zinc-200">{{ $requirement['name'] }}</dt>
                                    <dd class="text-zinc-600 dark:text-zinc-400">{{ $requirement['detail'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>

                    <div class="min-w-0 overflow-x-auto rounded-xl border border-zinc-200 bg-zinc-900 p-5 font-mono text-[13px]/relaxed text-zinc-300 shadow-sm dark:border-zinc-800">
                        <p class="whitespace-nowrap"><span class="text-zinc-600">$</span> git clone {{ config('leelabot.repository') }}.git</p>
                        <p class="whitespace-nowrap"><span class="text-zinc-600">$</span> cd Leelabot</p>
                        <p class="mt-3 whitespace-nowrap text-zinc-500"># edit the config, then:</p>
                        <p class="whitespace-nowrap"><span class="text-zinc-600">$</span> php bot.php</p>
                    </div>
                </div>
            </section>
        </main>

        <footer class="mx-auto flex max-w-5xl flex-col gap-6 px-6 py-12 sm:flex-row sm:items-center">
            <div class="flex flex-col gap-1 text-sm text-zinc-500 dark:text-zinc-500">
                <p>
                    Free software under the
                    <a href="{{ config('leelabot.license') }}" class="text-zinc-700 underline underline-offset-2 hover:text-ember-700 dark:text-zinc-300 dark:hover:text-ember-400">GNU GPL v2 or later</a>.
                </p>
                <p>Built by Yohann Lorant and Eser Deniz.</p>
            </div>

            <div class="flex items-center gap-6 sm:ml-auto">
                <a href="{{ config('leelabot.issues') }}" class="text-sm text-zinc-600 hover:text-ember-700 dark:text-zinc-400 dark:hover:text-ember-400">Issues</a>
                <a href="{{ config('leelabot.repository') }}" class="text-sm text-zinc-600 hover:text-ember-700 dark:text-zinc-400 dark:hover:text-ember-400">GitHub</a>
                <img src="/leelabot-badge.png" alt="LeelaBot — UrT Bot" width="88" height="31" class="rounded-xs">
            </div>
        </footer>
    </body>
</html>
