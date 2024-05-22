<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowingRecord;
use App\Models\Book;
use App\Models\Member;

class BorrowingRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = BorrowingRecord::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $searchBy = $request->input('search_by');
            \Log::info('Search by: ' . $searchBy . ', Search term: ' . $search);

            if ($searchBy == 'ic') {
                $query->whereHas('member', function ($q) use ($search) {
                    $q->where('ic_no', 'like', "%{$search}%");
                });
            } elseif ($searchBy == 'book') {
                $query->where('book_id', $search); // Exact match for book_id
            }
        }

        $records = $query->with(['book', 'member'])->paginate(4);
        \Log::info('Records found: ' . $records->count());

        return view('borrowing_records.index', compact('records'));
    }

    public function create()
    {
        $books = Book::all();
        $members = Member::all();
        return view('borrowing_records.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
        ]);

        BorrowingRecord::create($request->all());

        return redirect()->route('borrowing_records.index')
            ->with('success', 'Borrowing record created successfully.');
    }

    public function show(BorrowingRecord $borrowingRecord)
    {
        return view('borrowing_records.show', compact('borrowingRecord'));
    }

    public function edit(BorrowingRecord $borrowingRecord)
    {
        $books = Book::all();
        $members = Member::all();
        return view('borrowing_records.edit', compact('borrowingRecord', 'books', 'members'));
    }

    public function update(Request $request, BorrowingRecord $borrowingRecord)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date',
        ]);

        $borrowingRecord->update($request->all());

        return redirect()->route('borrowing_records.index')
            ->with('success', 'Borrowing record updated successfully.');
    }

    public function destroy(BorrowingRecord $borrowingRecord)
    {
        $borrowingRecord->delete();

        return redirect()->route('borrowing_records.index')
            ->with('success', 'Borrowing record deleted successfully.');
    }
}
