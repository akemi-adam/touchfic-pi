<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Models\Gender;

class GenderController extends Controller
{

    public function index()
    {
        $genders = Gender::all();
        return view('admin.gender.index',[
            'genders' => $genders
        ]);
    }

    public function create()
    {
        return view('admin.gender.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return "Teste função show $id";
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
