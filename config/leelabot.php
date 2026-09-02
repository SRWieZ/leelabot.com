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
     * The headline capabilities, shown as cards on the homepage.
     */
    'features' => [
        [
            'title' => 'One process, every server',
            'body' => 'Leelabot dispatches to as many Urban Terror instances as you throw at it, each with its own configuration and its own set of plugins.',
        ],
        [
            'title' => 'Everything is a plugin',
            'body' => 'The core parses the server and fires events. Features live in plugins — drop a PHP file in plugins/, hook the events you care about, reload.',
        ],
        [
            'title' => 'RCon from the chat box',
            'body' => 'Change maps, force teams, veto votes, pause the round or slap someone, all typed straight into in-game chat instead of a console.',
        ],
        [
            'title' => 'Moderation on autopilot',
            'body' => 'Warns fire automatically on teamkilling and insults, and kick the players who keep at it. Bans persist to disk and survive a restart.',
        ],
        [
            'title' => 'Stats and awards',
            'body' => 'Per-player statistics tracked across the round, with end-of-game awards announced in chat. Players pull their own with !stats.',
        ],
        [
            'title' => 'Bridged to IRC and TeamSpeak',
            'body' => 'A full IRC bot relays the server chat to your channel, and the TeamSpeak plugin reports who is sitting in voice.',
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
     * A sample of the in-game commands, used to fill the hero terminal.
     */
    'commands' => [
        '!kick', '!ban', '!mute', '!slap', '!warn', '!clearwarns',
        '!map', '!cyclemap', '!nextmap', '!veto', '!pause', '!shuffleteams',
        '!swap', '!force', '!bigtext', '!say', '!stats', '!awards',
        '!setadmin', '!giverights', '!list', '!rcon', '!reload', '!die',
    ],

];
