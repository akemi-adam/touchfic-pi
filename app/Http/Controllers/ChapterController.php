<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Storie;

class ChapterController extends Controller
{
    public function create($id)
    {
        $storie = Storie::findOrFail($id);

        return view('storie.chapter.create', [
            'storie' => $storie,
        ]);
    }

    public function store(Request $request, $id)
    {

        $chapter = new Chapter;

        $chapter->title = $request->title;
        $chapter->content = $request->content;
        $chapter->numberofwords = count(preg_split('~[^\p{L}\p{N}\']+~u', $request->content));
        $chapter->authornotes = $request->authornotes;
        $chapter->storie_id = $id;

        $chapter->save();

        $storie = Storie::findOrFail($id);
        $storie->numberofwords += $chapter->numberofwords;

        $storie->save();

        return redirect()->to(route('chapter.show', $chapter->id))->with('success_msg', 'História registrada com sucesso');
    }

    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);

        return view('storie.chapter.show', [
            'chapter' => $chapter,
        ]);
    }
}
