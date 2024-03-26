<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{


    /*
    * Get book of {id} or all books
    */
    public function getBooks(Request $req, string $id): string
    {

    }

    /*
    * Add new book to table
    */
    public function newBook(Request $req): void
    {
        $this->validate($req, [
            'title' => 'required',
            'authors_array' => 'array',
            'published' => 'date',
            'genres_array' => 'array',
            'length_pages' => 'required|integer',
            'complete' => 'boolean',
            'current_page' => 'integer',
            'started_reading' => 'date',
            'finished_reading' => 'date',
            'cover_image_url' => 'url',
        ]);

        if ($req->complete && !$req->finished_reading) {
            // Set the finished_reading date to current timestamp
            $finished_reading = date('Y-m-d');
        } else {
            $finished_reading = $req->finished_reading;
        }

        Book::create([
            'title' => $req->title,
            'authors_array' => $req->authors_array,
            'published' => $req->published,
            'genres_array' => $req->genres_array,
            'length_pages' => $req->length_pages,
            'complete' => $req->complete,
            'current_page' => $req->current_page,
            'current_chapter' => $req->current_chapter,
            'started_reading' => $req->started_reading,
            'finished_reading' => $finished_reading,
            'cover_image_url' => $req->cover_image_url,
        ]);
    }

    /*
    * Edit an existing book entry
    */
    public function editBook(Request $req, string $id): void
    {

    }

    /*
    * Delete a book entry
    */
    public function deleteBook(Request $req, string $id): void
    {

    }

}
