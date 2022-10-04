<?php

use App\Models\Post;

uses()->group('post');

it('has post page')->get('/post')->assertStatus(200);

it('has create post page', function () {

    UserData::authUser();

    $this->get('/post/create')->assertStatus(200);

});

it('cannot access create post page')->get('/post/create')->assertStatus(403);

it('can create a post', function () {

    UserData::authUser();

    $attributes = Post::factory()->raw();

    $this->post(route('post.store', $attributes))->assertStatus(302);

    $this->assertDatabaseHas('posts', $attributes);

});

it('cannot create a new post')->post('/post')->assertStatus(403);

it('can view a new post', function () {

    $post = Post::inRandomOrder()->first();

    $this->get(route('post.show', $post->id))->assertStatus(200);

});

it('cannot view a post that does not exist', function () {

    $id = Data::noIdExists(rand(), Post::class);

    $this->get(route('post.show', $id))->assertStatus(404);

});

it('can access the post editing form', function () {

    $user = UserData::authUser();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->get(route('post.edit', $post->id))->assertStatus(200);

});

it('cannot access the post editing form if the post does not exist', function () {

    $id = Data::noIdExists(rand(), Post::class);

    $this->get(route('post.edit', $id))->assertStatus(404);

});

it('cannot access the post edit form if you are not the owner', function () {

    $user = UserData::authUser();

    $post = Post::inRandomOrder()->first();

    $this->get(route('post.edit', $post->id))->assertStatus(403);

});