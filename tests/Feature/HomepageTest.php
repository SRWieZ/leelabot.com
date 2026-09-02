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

test('the scoreboard shows both teams with kills to deaths per player', function () {
    $board = config('leelabot.scoreboard');

    $response = $this->get('/');

    $response->assertSee('Blue')->assertSee('Red');

    foreach ([...$board['blue'], ...$board['red']] as $player) {
        $response->assertSee($player['name'])
            ->assertSee($player['kills'].':'.$player['deaths']);
    }

    foreach (['blue', 'red'] as $side) {
        $response->assertSee((string) array_sum(array_column($board[$side], 'kills')));
    }
});

test('the pipeline diagram renders every stage', function () {
    $pipeline = config('leelabot.pipeline');

    $response = $this->get('/');

    foreach ([$pipeline['reads'], $pipeline['core'], $pipeline['speaks']] as $stage) {
        $response->assertSee($stage['title'])->assertSee($stage['caption']);
    }

    foreach ($pipeline['core']['plugins'] as $plugin) {
        $response->assertSee($plugin);
    }

    foreach ([...$pipeline['reads']['nodes'], ...$pipeline['speaks']['nodes']] as $node) {
        $response->assertSee($node['label']);
    }
});

test('every command carries a tooltip describing it', function () {
    $response = $this->get('/');

    foreach (config('leelabot.commands') as $index => $command) {
        $response->assertSee($command['name'])
            ->assertSee($command['help'])
            ->assertSee('command-'.$index);
    }
});

test('every pipeline icon exists in the icon component', function () {
    $pipeline = config('leelabot.pipeline');

    $available = collect(explode('@case(', file_get_contents(resource_path('views/components/icon.blade.php'))))
        ->skip(1)
        ->map(fn (string $chunk) => trim(explode(')', $chunk)[0], "'\""));

    foreach ([...$pipeline['reads']['nodes'], ...$pipeline['speaks']['nodes']] as $node) {
        expect($available)->toContain($node['icon']);
    }
});
