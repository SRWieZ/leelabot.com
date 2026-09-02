<?php

return [

    /*
     * Where the upstream project lives. Every outbound link on the site
     * is derived from these, so a fork only needs to change them here.
     */
    'repository' => 'https://github.com/ylorant/Leelabot',
    'issues' => 'https://github.com/ylorant/Leelabot/issues',
    'license' => 'https://www.gnu.org/licenses/old-licenses/gpl-2.0.html',

    'requirements' => [
        ['name' => 'PHP', 'detail' => '5.3.0 or newer'],
        ['name' => 'PHP-CLI', 'detail' => 'the bot runs from the terminal'],
        ['name' => 'intl', 'detail' => 'optional, for translations'],
    ],

    /*
     * What the bot actually does, as a pipeline: it tails the server logs,
     * dispatches each line to the loaded plugins, and answers on three
     * channels. Rendered as the three-column diagram on the homepage.
     */
    'pipeline' => [
        'reads' => [
            'title' => 'Reads',
            'caption' => 'One games.log per server. Leelabot follows them all at once and turns every line into an event.',
            'nodes' => [
                ['icon' => 'file', 'label' => 'games.log', 'meta' => 'server 1'],
                ['icon' => 'file', 'label' => 'games.log', 'meta' => 'server 2'],
                ['icon' => 'file', 'label' => 'games.log', 'meta' => 'server 3'],
            ],
        ],

        'core' => [
            'title' => 'Dispatches',
            'caption' => 'The core parses the server and fires events. Every feature is a plugin listening for the ones it cares about.',
            'plugins' => ['adminbase', 'basicrights', 'stats', 'bans', 'warns', 'logs'],
        ],

        'speaks' => [
            'title' => 'Answers',
            'caption' => 'Replies go back to the players over RCon, and out to the channels your admins are already sitting in.',
            'nodes' => [
                ['icon' => 'prompt', 'label' => 'RCon', 'meta' => 'back into the game'],
                ['icon' => 'relay', 'label' => 'IRC', 'meta' => 'your channel'],
                ['icon' => 'voice', 'label' => 'TeamSpeak', 'meta' => "who's in voice"],
            ],
        ],
    ],

    /*
     * The hero HUD: chat on the left, score on the right, over a shot of the
     * game. Illustrative round data, shaped like what the stats plugin tracks.
     */
    /*
     * The hero HUD: chat on the left, scoreboard on the right, over a shot of
     * the game. Rows mimic the in-game board — a square for players still
     * alive, then kills:deaths, then the name.
     */
    'scoreboard' => [
        'blue' => [
            ['name' => 'Zaki', 'kills' => 24, 'deaths' => 9, 'alive' => true],
            ['name' => 'Duke', 'kills' => 19, 'deaths' => 12, 'alive' => true],
            ['name' => 'Ash', 'kills' => 15, 'deaths' => 14, 'alive' => false],
            ['name' => 'Nyx', 'kills' => 11, 'deaths' => 13, 'alive' => true],
        ],

        'red' => [
            ['name' => 'Rook', 'kills' => 21, 'deaths' => 11, 'alive' => true],
            ['name' => 'Vex', 'kills' => 18, 'deaths' => 10, 'alive' => true],
            ['name' => 'Kilo', 'kills' => 14, 'deaths' => 16, 'alive' => true],
            ['name' => 'Sable', 'kills' => 9, 'deaths' => 15, 'alive' => false],
        ],

        'feed' => [
            ['time' => '19:04', 'who' => 'Zaki', 'team' => 'blue', 'text' => '!stats'],
            ['time' => '19:04', 'who' => 'Leelabot', 'team' => 'bot', 'text' => 'Zaki — 24 kills, 9 deaths, ratio 2.66'],
            ['time' => '19:06', 'who' => 'Rook', 'team' => 'red', 'text' => '!nextmap'],
            ['time' => '19:06', 'who' => 'Leelabot', 'team' => 'bot', 'text' => 'Next map is ut4_turnpike'],
            ['time' => '19:11', 'who' => 'Leelabot', 'team' => 'bot', 'text' => 'Kilo warned (2/3) — teamkill'],
            ['time' => '19:12', 'who' => 'Duke', 'team' => 'blue', 'text' => '!cyclemap'],
        ],
    ],

    /*
     * Plugins shipped in the repository, with the brief from each file header.
     */
    'plugins' => [
        ['name' => 'adminbase', 'body' => 'Most of the admin commands: kicks, maps, votes, server control.'],
        ['name' => 'assault', 'body' => 'Helpers for the Assault gametype.'],
        ['name' => 'bans', 'body' => 'Ban players and keep the ban list on disk.'],
        ['name' => 'basicrights', 'body' => 'Simple rights management, built for ease of configuration.'],
        ['name' => 'clientbase', 'body' => 'Player-facing commands: !teams, !time, !nextmap, !help.'],
        ['name' => 'dummy', 'body' => 'A skeleton to copy when you start your own plugin.'],
        ['name' => 'irc', 'body' => 'A full IRC bot bridging server chat to a channel.'],
        ['name' => 'logs', 'body' => 'Logs all activity on each server separately.'],
        ['name' => 'messages', 'body' => 'Recurring announcements posted in chat on a timer.'],
        ['name' => 'stats', 'body' => 'Game statistics for every player, plus end-of-round awards.'],
        ['name' => 'teamspeak', 'body' => 'Reports who is currently on the TeamSpeak server.'],
        ['name' => 'warns', 'body' => 'Auto-warns teamkilling and insults, kicks repeat offenders.'],
    ],

    /*
     * In-game commands and what each one does. Wording is taken from the
     * doc blocks in the plugin sources, so the tooltips match the code.
     */
    'commands' => [
        ['name' => '!kick', 'help' => 'Kicks a player from the server.'],
        ['name' => '!ban', 'help' => 'Bans a player. The ban list is kept on disk and survives a restart.'],
        ['name' => '!mute', 'help' => 'Mutes a player in the server.'],
        ['name' => '!slap', 'help' => 'Slaps a player from the server.'],
        ['name' => '!warn', 'help' => 'Warns a player. Enough warnings and they get kicked automatically.'],
        ['name' => '!clearwarns', 'help' => "Clears a player's accumulated warnings."],
        ['name' => '!map', 'help' => 'Change the current map. Reloads the server.'],
        ['name' => '!cyclemap', 'help' => 'Go to the next map.'],
        ['name' => '!nextmap', 'help' => 'Change the map that comes next.'],
        ['name' => '!veto', 'help' => 'Cancel a vote in progress.'],
        ['name' => '!pause', 'help' => 'Pause the game.'],
        ['name' => '!shuffleteams', 'help' => 'Shuffle the teams, with a restart.'],
        ['name' => '!swap', 'help' => 'Swap the two teams.'],
        ['name' => '!force', 'help' => 'Force a player into a team.'],
        ['name' => '!bigtext', 'help' => "Print a large message across everyone's screen."],
        ['name' => '!say', 'help' => 'Send a message to everyone.'],
        ['name' => '!stats', 'help' => 'Kills, deaths and ratio for the round.'],
        ['name' => '!awards', 'help' => 'Announce the end-of-round awards.'],
        ['name' => '!setadmin', 'help' => 'Promote a player to an admin level.'],
        ['name' => '!giverights', 'help' => 'Give a player a specific level.'],
        ['name' => '!list', 'help' => 'List the players on the server.'],
        ['name' => '!rcon', 'help' => 'Send an RCon command straight to the server.'],
        ['name' => '!reload', 'help' => 'Reload the game.'],
        ['name' => '!die', 'help' => 'Stop the bot.'],
    ],

];
