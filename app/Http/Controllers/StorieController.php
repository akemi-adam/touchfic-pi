<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storie;
use App\Models\User;

class StorieController extends Controller
{

    public function index()
    {
        $stories = Storie::all();
        return view('storie.index', [
            'stories' => $stories,
        ]);
    }


    public function create()
    {
        return view('storie.create');
    }

    public function store(Request $request)
    {
        return 'Em construção';
    }

    public function show($id)
    {
        return view('storie.show');
    }


    public function edit($id)
    {
        return view('storie.edit');
    }


    public function update(Request $request, $id)
    {
        return 'Em construção';
    }


    public function destroy($id)
    {
        return 'Em construção';
    }
}
