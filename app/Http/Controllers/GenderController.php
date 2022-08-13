<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;

class GenderController extends Controller
{

    /**
     * 
     * Resgata os dados do banco e devolve pra página /admin/gender/index
     */

    public function index()
    {
        $genders = Gender::all();
        return view('admin.gender.index',[
            'genders' => $genders
        ]);
    }

    /**
     * Retorna um formulário para criação de gêneros
     */

    public function create()
    {
        return view('admin.gender.create');
    }

    /**
     * Action que vai operar no banco salvando as informações e redirecionar a página para mostrar os dados salvos
     */

    public function store(Request $request)
    {
        $gender = new Gender;
        $gender->gen_gender = $request->gender;

        $gender->save();

        return redirect('/admin/gender')->with('success_msg', 'O gênero foi cadastrado com sucesso!');
    }

    /**
     * Procura o gênero pelo seu id específico e retorna um objeto dele para a página show
     */

    public function show($id)
    {
        $gender = Gender::findOrFail($id);
        return view('admin.gender.show', [
            'gender' => $gender
        ]);
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
