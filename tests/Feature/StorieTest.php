<?php

use App\Models\{
    Storie, Genre, User
};

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

    $storie->update([
        'title' => fake()->sentence(5),
        'synopsis' => fake()->paragraphs(random_int(2, 6), true),
    ]);

    $this->put(route('storie.update', $storie->id))->assertStatus(302);
    
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