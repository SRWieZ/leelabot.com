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
