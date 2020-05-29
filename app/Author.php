<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';
    protected $fillable = [
        'name',
        'last_name',
        'patronymic',
        'id'
    ];

    public function books()
    {
        $authors = DB::table('authors')->get();
        return $authors;
    }
}
