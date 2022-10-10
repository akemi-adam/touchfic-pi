<?php

uses()->group('chapter');

it('has chapter create page', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    $this->get(route('chapter.create', $storie->id))->assertStatus(200);

});

it('saves a chapter', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    $content = fake()->paragraphs(random_int(1, 20), true);

    $attributes = [
        'title' => fake()->words(3, true),
        'authornotes' => fake()->paragraphs(1, true),
        'content' => $content,
        'numberofwords' => count(preg_split('~[^\p{L}\p{N}\']+~u', $content)),
    ];

    $this->post(route('chapter.store', $storie->id), $attributes)->assertStatus(302);

    $this->assertDatabaseHas('chapters', $attributes);

});

it('can view a chapter', function () {

    $storie = StorieData::createOwn();

    $chapter = ChapterData::create([
        'storie_id' => $storie->id,
    ]);

    $this->get(route('chapter.show', $chapter->id))->assertStatus(200);

});

it('can view the edit form for a capther', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    $chapter = ChapterData::create([
        'storie_id' => $storie->id,
    ]);

    $this->get(route('chapter.edit', $chapter->id))->assertStatus(200);

});

it('can update a chapter', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    $chapter = ChapterData::create([
        'storie_id' => $storie->id,
    ]);

    $data = [
        'title' => fake()->words(random_int(1, 5), true),
        'authornotes' => fake()->text(500),
        'content' => fake()->paragraphs(random_int(1, 10), true),
    ];

    $this->put(route('chapter.update', $chapter->id), $data)->assertStatus(302);

    $this->assertDatabaseHas('chapters', $data);

});

it('can delete a chapter', function () {

    UserData::authUser();

    $storie = StorieData::createOwn();

    $chapter = ChapterData::create([
        'storie_id' => $storie->id,
    ]);

    $this->delete(route('chapter.destroy', $chapter->id))->assertStatus(302);

    $this->assertModelMissing($chapter);

});