<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{


    /*
    * Get book of {id} or all books
    */
    public function getBooks(string $id = null): string
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
    public function newBook(Request $req): void
    {
        $this->validate($req, [
            'title' => 'required|string',
            'authors_array' => 'array',
            'published' => 'date',
            'genres_array' => 'array',
            'length_pages' => 'required|integer',
            'complete' => 'boolean',
            'current_page' => 'integer',
            'current_chapter' => 'string',
            'started_reading' => 'date',
            'finished_reading' => 'date',
            'cover_image_url' => 'url',
        ]);

        if ($req->complete && !$req->finished_reading) {
            // Set the finished_reading date to current timestamp
            $req["finished_reading"] = date('Y-m-d');
        }

        Book::create([
            'title' => $req->title,
            'authors_array' => json_encode($req->authors_array),
            'published' => $req->published,
            'genres_array' => json_encode($req->genres_array),
            'length_pages' => $req->length_pages,
            'complete' => $req->complete,
            'current_page' => $req->current_page,
            'current_chapter' => $req->current_chapter,
            'started_reading' => $req->started_reading,
            'finished_reading' => $req->finished_reading,
            'cover_image_url' => $req->cover_image_url,
        ]);
    }

    /*
    * Edit an existing book entry
    */
    public function editBook(Request $req, string $id): void
    {
        $this->validate($req, [
            'title' => 'string',
            'authors_array' => 'array',
            'published' => 'date',
            'genres_array' => 'array',
            'length_pages' => 'integer',
            'complete' => 'boolean',
            'current_page' => 'integer',
            'current_chapter' => 'string',
            'started_reading' => 'date',
            'finished_reading' => 'date',
            'cover_image_url' => 'url',
        ]);

        $book = Book::findOrFail($id);

        if ($req->complete && !$req->finished_reading) {
            // Set the finished_reading date to current timestamp
            $req["finished_reading"] = date('Y-m-d');
        }

        $book->update($req->all());
        $book->save();
    }

    /*
    * Delete a book entry
    */
    public function deleteBook(string $id): void
    {
        $book = Book::findOrFail($id);
        $book->delete();
    }

}
