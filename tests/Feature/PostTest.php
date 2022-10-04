<?php

use App\Models\Post;

uses()->group('post');

/**
 * View all posts
 */

it('has post page')->get('/post')->assertStatus(200);

/**
 * Store post
 */

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

/**
 * Show a post
 */

it('can view a new post', function () {

    $post = Post::inRandomOrder()->first();

    $this->get(route('post.show', $post->id))->assertStatus(200);

});

it('cannot view a post that does not exist', function () {

    $id = Data::noIdExists(rand(), Post::class);

    $this->get(route('post.show', $id))->assertStatus(404);

});

/**
 * Update a post
 */

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

    UserData::authUser();

    $post = Post::inRandomOrder()->first();

    $this->get(route('post.edit', $post->id))->assertStatus(403);

});

it('can update a post', function () {

    $user = UserData::authUser();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $data = [
        'id' => $post->id,
        'content' => fake()->text(300),
    ];

    $this->put(route('post.update', $post->id), $data)->assertStatus(302);

    $this->assertDatabaseHas('posts', $data);

});

it('cannot update an existing post if the post does not exist', function () {

    $id = Data::noIdExists(rand(), Post::class);

    $this->put(route('post.update', $id))->assertStatus(404);

});

it('cannot update an existing post if you are not the owner', function () {

    UserData::authUser();

    $post = Post::inRandomOrder()->first();

    $this->put(route('post.update', $post->id))->assertStatus(403);

});

/**
 * Delete a post
 */

it('can delete a post', function () {

    $user = UserData::authUser();
   
    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $postId = $post->id;

    $this->delete(route('post.destroy', $postId))->assertStatus(302);

});

it('cannot delete a post with invalid id', function () {
    
    $id = Data::noIdExists(rand(), Post::class);

    $this->delete(route('post.destroy', $id))->assertStatus(404);

});

it('cannot delete an existing post if you are not the owner', function () {

    UserData::authUser();

    $post = Post::inRandomOrder()->first();

    $this->put(route('post.update', $post->id))->assertStatus(403);

});