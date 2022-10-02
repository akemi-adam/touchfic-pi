<?php

it('has homepage page')->get('/')->assertStatus(200);

it('has about page')->get('/about')->assertStatus(200);

it('has faq page')->get('/faq')->assertStatus(200);

it('has terms of services page')->get('/terms-of-services')->assertStatus(200);

it('has privacy policy page')->get('/privacy-policy')->assertStatus(200);