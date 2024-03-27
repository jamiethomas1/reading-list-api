<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{


    /*
    * Get book of {id} or all books
    */
    public function getBooks(string $id = null): string|false
    {
        if ($id) {
            $book = Book::findOrFail($id);
            return json_encode($book);
        }

        $books = Book::all();
        return json_encode($books);
    }

    /*
    * Add new book to table
    */
    public function newBook(Request $req): string|false
    {
        $this->validate($req, [
            'title' => 'required|string|max:256',
            'authors_array' => 'array|max:10',
            'published' => 'date',
            'genres_array' => 'array|max:10',
            'length_pages' => 'required|integer|gte:0|lte:65535',
            'complete' => 'boolean',
            'current_page' => 'integer|gte:0|lte:65535',
            'current_chapter' => 'string|max:256',
            'started_reading' => 'date',
            'finished_reading' => 'date',
            'cover_image_url' => 'url|max:1024',
        ]);

        if ($req->complete && !$req->finished_reading) {
            // Set the finished_reading date to current timestamp
            $req["finished_reading"] = date('Y-m-d');
        }

        $book = Book::create($req->all());

        return response()->json([
            "created" => $book
        ])->getContent();
    }

    /*
    * Edit an existing book entry
    */
    public function editBook(Request $req, string $id): string|false
    {
        $this->validate($req, [
            'title' => 'string|max:256',
            'authors_array' => 'array|max:10|nullable',
            'published' => 'date|nullable',
            'genres_array' => 'array|max:10|nullable',
            'length_pages' => 'integer|gte:0|lte:65535',
            'complete' => 'boolean',
            'current_page' => 'integer|gte:0|lte:65535|nullable',
            'current_chapter' => 'string|max:256|nullable',
            'started_reading' => 'date|nullable',
            'finished_reading' => 'date|nullable',
            'cover_image_url' => 'url|max:1024|nullable',
        ]);

        $book = Book::findOrFail($id);

        if ($req->complete && !$req->finished_reading) {
            // Set the finished_reading date to current timestamp
            $req["finished_reading"] = date('Y-m-d');
        }

        $book->update($req->all());
        $book->save();

        return response()->json([
            "updated" => $book
        ])->getContent();
    }

    /*
    * Delete a book entry
    */
    public function deleteBook(string $id): string|false
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            "deleted" => $book
        ])->getContent();
    }

}
