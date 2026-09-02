<?php

test('the homepage renders the project pitch and links to the repository', function () {
    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('Run your Urban Terror servers from the chat box.')
        ->assertSee(config('leelabot.repository'));
});

test('the homepage lists every configured plugin', function () {
    $response = $this->get('/');

    foreach (config('leelabot.plugins') as $plugin) {
        $response->assertSee($plugin['name']);
    }
});

test('the homepage exposes no dev server asset urls', function () {
    $this->get('/')->assertDontSee('localhost:5173');
});

test('the homepage shows both teams and the bot between them', function () {
    $board = config('leelabot.scoreboard');

    $response = $this->get('/');

    $response->assertSee('Blue team')
        ->assertSee('Red team')
        ->assertSee($board['map']);

    foreach ([...$board['blue'], ...$board['red']] as $player) {
        $response->assertSee($player['name']);
    }
});

test('every feature icon exists in the icon component', function () {
    $available = collect(explode('@case(', file_get_contents(resource_path('views/components/icon.blade.php'))))
        ->skip(1)
        ->map(fn (string $chunk) => trim(explode(')', $chunk)[0], "'\""));

    foreach (config('leelabot.features') as $feature) {
        expect($available)->toContain($feature['icon']);
    }
});
