<?php

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('it works with pest', function () {
    expect(true)->toBeTrue();
});
