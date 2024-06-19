<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(4); // Fetch 4 books per page
        return view('books.index', compact('books')); // Return the books index view with the paginated books
    }

    public function create()
    {
        return view('books.create'); // Return the view for creating a new book
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Add validation for title
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher, // Ensure publisher is provided
            'published_year' => $request->published_year,
            'category' => $request->category,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {

        return view('books.edit', compact('book')); // Return the view for editing a specific book
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255', // Add validation for publisher
            'published_year' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher, // Ensure publisher is provided
            'published_year' => $request->published_year,
            'category' => $request->category,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {

        $book->delete(); // Delete the specified book
        return redirect()->route('books.index')
                         ->with('success', 'Book deleted successfully.');
    }
}
