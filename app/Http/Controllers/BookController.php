<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function find($book_id)
    {
//        $book = Author::find(1)->books()->where('id',$book_id)->get();
        $book = Book::find($book_id);
        return mainResponse(true, __('okay'), $book, [], 200);
    }

    public function findBooks($author_id)
    {
        $book = Author::find(1)->books()->where('author_id',$author_id)->get();
        return mainResponse(true, __('okay'), $book, [], 200);
    }

    public function authors()
    {
        // All authors of Book Of Eli books
        $authors = Author::whereHas('books', function ($query) {
            $query->where('address', 'like', '%The Book Of Eli%');
        })->get();

        return mainResponse(true, __('okay'), $authors, [], 200);
    }
}
