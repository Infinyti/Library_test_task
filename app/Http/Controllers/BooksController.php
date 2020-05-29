<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InputRequest;
use App\Book;
use App\Author;



class BooksController extends Controller
{

    public function index()
    {
        $books = Book::orderBy('name')->get();
        $authors = Author::all();

        return view('books', compact('books', 'authors'));
    }


    public function create()
    {
        return view('books');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'img' => 'image|mimes:jpeg,png|max:2000',
            'author_id'=>'required'
        ]);

        $books = new Book();
        $books->name =$request->input('name');
        $books->description =$request->input('description');
        $books->author_id =$request->input('author_id');

        if ($request->hasFile('img')){
            $file = $request->file('img');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/b_covers/', $filename);
            $books->img = $filename;
        }

        $books->save();
        return redirect('books')->with('success', 'Данные были успешно добавлены');
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
        ]);

        $books = Book::find($id);
        $books->name = $request->get('name');
        $books->description = $request->get('description');
        $books->author_id = $request->get('author_id');
        if ($request->hasFile('img')){
            $file = $request->file('img');
            $extension =$file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/b_covers/', $filename);
            $books->img = $filename;
        }

        $books->save();

        return redirect('books')->with('success', 'Данные были успешно обновлены');
    }


    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect('books')->with('success', 'Книга была успешно удалена');
    }
}
