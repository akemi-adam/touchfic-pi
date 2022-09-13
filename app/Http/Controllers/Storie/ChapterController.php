<?php

namespace App\Http\Controllers\Storie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Storie;

class ChapterController extends Controller
{
    public function create($id)
    {
        $storie = Storie::findOrFail($id);

        $this->authorize('create', $storie);

        return view('storie.chapter.create', [
            'storie' => $storie,
        ]);
    }

    public function store(Request $request, $id)
    {
        $storie = Storie::findOrFail($id);
        $this->authorize('create', $storie);
        
        $chapter = new Chapter;

        $chapter->title = $request->title;

        $chapter->content = $request->content;

        $chapter->numberofwords = count(preg_split('~[^\p{L}\p{N}\']+~u', $request->content)) - 1;

        $chapter->authornotes = $request->authornotes;

        $chapter->storie_id = $id;

        $chapter->save();

        $storie->numberofwords += $chapter->numberofwords;
        $storie->save();

        return redirect()->to(route('chapter.show', $chapter->id))->with('success_msg', 'História registrada com sucesso');
    }

    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);

        $previous = Chapter::where('storie_id', $chapter->storie_id)->where('id', '<', $chapter->id)->max('id');
        $next = Chapter::where('storie_id', $chapter->storie_id)->where('id', '>', $chapter->id)->min('id');

        return view('storie.chapter.show', [
            'chapter' => $chapter,
            'previous' => $previous,
            'next' => $next,
        ]);
    }

    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);

        $this->authorize('update', $chapter);

        return view('storie.chapter.edit', [
            'chapter' => $chapter,
        ]);
    }

    public function update(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);

        $this->authorize('update', $chapter);

        if ($chapter->title !== $request->title) {
            $chapter->title = $request->title;
        }

        if ($chapter->authornotes !== $request->authornotes) {
            $chapter->authornotes = $request->authornotes;
        }

        if ($chapter->content !== $request->content) {
            $chapter->content = $request->content;

            $storie = Storie::findOrFail($chapter->storie_id);
            
            $oldWordsNumber = $chapter->numberofwords;
            $chapter->numberofwords = count(preg_split('~[^\p{L}\p{N}\']+~u', $request->content));

            $storie->numberofwords = (($storie->numberofwords - $oldWordsNumber) + $chapter->numberofwords) - 1;
            $storie->save();
        }

        $chapter->save();

        return redirect()->to(route('chapter.show', $id))->with('success_msg', 'Capítulo editado com sucesso!');
    }

    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);

        $this->authorize('delete', $chapter);

        $storie = Storie::findOrFail($chapter->storie->id);
        $storie->numberofwords -= $chapter->numberofwords;
        $storie->save();

        $chapter->delete();

        return redirect()->to(route('storie.show', $storie->id))->with('success_msg', 'Capítulo deletado com sucesso!');
    }
}
