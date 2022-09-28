<?php

namespace App\Http\Controllers\Storie;

use App\Http\Requests\Storie\Chapter\{
    StoreChapterRequest, UpdateChapterRequest
};
use App\Http\Controllers\Controller;
use App\Events\DeletePublication;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Storie;
use RequestSupport;

class ChapterController extends Controller
{

    /**
     * Apply middleware exists show actions
     */
    public function __construct()
    {
        $this->middleware('exists:' . Chapter::class, [
            'only' => [
                'show',
            ]
        ]);
    }

    /**
     * Creates a chapter for the story specified by the id
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        $storie = Storie::findOrFail($id);

        $this->authorize('create', $storie);

        return view('storie.chapter.create', [
            'storie' => $storie,
        ]);
    }

    /**
     * Retrieves the story, checks the authorization, creates a chapter object, defines its properties (uses a regex to find the number of words) and saves the chapter. Then it updates the word count of the respective story and redirects the page
     * 
     * @param App\Http\Requests\Storie\Chapter\StoreChapterRequest $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreChapterRequest $request, $id)
    {
        $storie = Storie::findOrFail($id);

        $this->authorize('create', $storie);
        
        $chapter = Chapter::create([
            'title' => $request->title,
            'content' => $request->content,
            'numberofwords' => count(preg_split('~[^\p{L}\p{N}\']+~u', $request->content)),
            'authornotes' => $request->authornotes,
            'storie_id' => $id,
            'spotify_track' => $request->track,
        ]);

        $storie->numberofwords += $chapter->numberofwords;

        $storie->save();

        return redirect()->to(route('chapter.show', $chapter->id))->with('success_msg', 'Capítulo registrado com sucesso!');
    }

    /**
     * Displays the chapter specified by the id, along with prev and next buttons
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
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

    /**
     * Shows the edit form for the chapter specified by id
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);

        $this->authorize('update', $chapter);

        return view('storie.chapter.edit', [
            'chapter' => $chapter,
        ]);
    }

    /**
     * It retrieves the chapter, checks which fields have changed, and if the content has changed, the word count of the entire story is adapted and reformulated. Finally it saves the chapter in the database and redirects the page
     * 
     * @param App\Http\Requests\Storie\Chapter\UpdateChapterRequest $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateChapterRequest $request, $id)
    {
        $chapter = Chapter::findOrFail($id);

        $this->authorize('update', $chapter);

        RequestSupport::setEditValues($request, $chapter, ['title', 'authornotes']);

        if ($chapter->content !== $request->content) {

            $chapter->content = $request->content;

            $storie = Storie::findOrFail($chapter->storie_id);
            
            $oldWordsNumber = $chapter->numberofwords;

            $chapter->numberofwords = count(preg_split('~[^\p{L}\p{N}\']+~u', $request->content));

            $storie->numberofwords = (($storie->numberofwords - $oldWordsNumber) + $chapter->numberofwords);

            $storie->save();
        }

        if (is_null($chapter->spotify_track) || $chapter->spotify_track !== $request->track) {
            $chapter->spotify_track = $request->track;
        }

        $chapter->save();

        return redirect()->to(route('chapter.show', $id))->with('success_msg', 'Capítulo editado com sucesso!');
    }

    /**
     * Retrieves the specific chapter, takes its story, decrements the total number of words, fires a DeletePublication event, and deletes the chapter
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);

        $this->authorize('delete', $chapter);

        $storie = Storie::findOrFail($chapter->storie->id);

        $storie->numberofwords -= $chapter->numberofwords;
        
        $storie->save();
 
        DeletePublication::dispatch($chapter);

        $chapter->delete();

        return redirect()->to(route('storie.show', $storie->id))->with('success_msg', 'Capítulo deletado com sucesso!');
    }
}
