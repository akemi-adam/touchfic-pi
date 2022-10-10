<?php

use function Pest\Livewire\livewire;
use App\Models\{
    Storie, Genre, User
};
use App\Http\Livewire\Like;

uses()->group('storie');

/**
 * View stories
 */

it('has a page of stories')->get('/storie')->assertStatus(200);

it('view a story', function () {

    $storie = StorieData::createRandom();

    $this->get(route('storie.show', $storie->id))->assertStatus(200);

});

/**
 * Create a new story
 */

it('has story creation form', function () {

    UserData::authUser();

    $this->get(route('storie.create'))->assertStatus(200);

});

it('saves a story', function () {

    UserData::authUser();

    $attributes = [
        'title' => fake()->words(4, true),
        'synopsis' => fake()->paragraphs(4, true),
        'agegroup' => random_int(1, 6),
        'genres' => [
            2, 4, 5
        ]
    ];

    $this->post(route('storie.store', $attributes))->assertStatus(302);

    Arr::forget($attributes, 'genres');

    $agegroup = Arr::get($attributes, 'agegroup');

    Arr::forget($attributes, 'agegroup');

    Arr::add($attributes, 'agegroup_id', $agegroup);

    $this->assertDatabaseHas('stories', $attributes);    

});

/**
 * Update a story
 */

it('has story edit form', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    $this->get(route('storie.edit', $storie->id))->assertStatus(200);

});

it('can update a story', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    $data = [
        'title' => fake()->sentence(5),
        'synopsis' => fake()->paragraphs(random_int(2, 6), true),
        'agegroup_id' => random_int(1, 6),
    ];

    $this->put(route('storie.update', $storie->id), $data)->assertStatus(302);
    
    $this->assertModelExists($storie);

});
 
/**
 * Delete a story
 */

it('can delete a story', function () {

UserData::authUser();

$storie = StorieData::createOwn();

$this->delete(route('storie.destroy', $storie->id))->assertStatus(302);

$this->assertModelMissing($storie);

});

/**
 * Likes
 */

it('can liked a story', function () {

    $user = UserData::authUser();

    $storie = StorieData::createOwn();

    livewire(Like::class, [
        'storieId' => $storie->id, 'authorId' => $user->id
    ])->call('enjoy');

    $this->assertDatabaseHas('likes', [
        'user_id' => $user->id,
        'storie_id' => $storie->id,
    ]);

});

it('can unliked a story', function () {

    $user = UserData::authUser();

    $storie = StorieData::createOwn();

    $ids = [
        'storieId' => $storie->id, 'authorId' => $user->id
    ];

    livewire(Like::class, $ids)->call('enjoy');

    livewire(Like::class, $ids)->call('unlike');

    $this->assertDatabaseMissing('likes', [
        'user_id' => $user->id,
        'storie_id' => $storie->id,
    ]);

});

/**
 * Infos of a story
 */

it('has likes of a story page', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    for ($i=0; $i < random_int(1, 10); $i++) {

        $user = User::factory()->create();

        livewire(Like::class, [
            'storieId' => $storie->id, 'authorId' => $user->id,
        ])->call('enjoy');

    }

    $this->get(route('likes.of.storie', $storie->id))->assertStatus(200);

});

it('has my stories page', function () {

    $user = UserData::authUser();

    for ($i=0; $i < random_int(1, 10); $i++) { 
        
        StorieData::createOwn(random_int(4, 10));

    }

    $this->get(route('storie.mystories', $user->id))->assertStatus(200);

});

it('has liked stories page', function () {

    $user = UserData::authUser();

    $this->get(route('storie.likes', $user->id))->assertStatus(200);

});