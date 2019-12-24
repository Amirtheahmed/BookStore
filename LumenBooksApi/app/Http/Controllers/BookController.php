<?php

namespace App\Http\Controllers;

use App\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{

    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * return  list of all books
     * @return Illuminate\http\response
     */
    public function index() {
        $books = Book::all();

        return $this->successResponse($books);
    }

        /**
         * Shows deatils of a book
         *
         * @param [type] $book
         * @return void
         */
    public function show($book) {
        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }

    /**
     * create one new Book
     * @return Illuminate\http\response
     */
    public function store(Request $request) {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request,$rules);
        
        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    /**
     * Updates book
     * @return Illuminate\http\response
     */
    public function update(Request $request, $book) {

        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request,$rules);

        $book = Book::findOrFail($book);

        $book->fill($request->all());
        //if no data has changed
        if($book->isClean()) {
           return $this->errorResponse("Atleast one value must change", Response::HTTP_UNPROCESSABLE_ENTITY); 
        }

        $book->save();

        return $this->successresponse($book);
    }

    /**
     * Destroy a specific Book
     * @return Illuminate\http\response
     */
    public function destroy(Request $request, $book) {
        $book = Book::findOrFail($book);
        $book->delete();
        return $this->successResponse($book); 
    }
}
