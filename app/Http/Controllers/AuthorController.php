<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::all();
        return view('authors')->with('authors', $authors);
    }


    public function create()
    {
        return view('authors');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
        ]);

        $authors = new Author();
        $authors->name =$request->input('name');
        $authors->last_name =$request->input('last_name');
        $authors->patronymic =$request->input('patronymic');

        $authors->save();
        return redirect('authors')->with('success', 'Автор был успешно добавлен');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|min:3',
            'last_name'=>'required',
        ]);

        $authors = Author::find($id);
        $authors->name =$request->get('name');
        $authors->last_name =$request->get('last_name');
        $authors->patronymic =$request->get('patronymic');
        $authors->save();

        return redirect('authors')->with('success', 'Автор был успешно обновлен');
    }


    public function destroy($id)
    {
        $authors = Author::find($id);
        $authors->delete();

        return redirect('authors');
    }
}