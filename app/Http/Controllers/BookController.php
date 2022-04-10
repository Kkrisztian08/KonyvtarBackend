<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $book =new Book();
        $book->fill($request->all());
        $book->save();
        return response()->json($book, 201);
    }

    public function rent(Request $request, Book $book)
    {
       $count=Rental::where('book_id', $book->id)
        ->where('start_date', '<=', Carbon::now())
        ->where('end_date', '>=', Carbon::now())
        ->count();
        if($count>0){
            return response()->json(["message" => "A könyv már foglalt."], 409);
        }
        $rental=new Rental();
        $rental->book_id=$book->id;
        $rental->start_date=Carbon::now();
        $rental->end_date=Carbon::now()->addDays(7);
        $rental->save();
        return response()->json($rental);
    }

    
}
