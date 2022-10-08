<?php

uses()->group('public');

/**
 * Roots routes
 */

it('has homepage page')->get('/')->assertStatus(200);

it('has about page')->get('/about')->assertStatus(200);

it('has faq page')->get('/faq')->assertStatus(200);

it('has terms of services page')->get('/terms-of-services')->assertStatus(200);

it('has privacy policy page')->get('/privacy-policy')->assertStatus(200);

/**
 * Search a story or user
 */

it('can search a story', function () {

    $this->get(route('search', [
        'search' => 'teste',
    ]))->assertStatus(200);

});

it('cannot search a story without a search term', function () {

    $this->get(route('search', [
        'search' => '',
    ]))->assertStatus(302);

});