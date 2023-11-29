<?php

namespace Modules\Book\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Book\app\Http\Requests\AuthorBookRequest;
use Modules\Book\app\Http\Requests\updateAuthorBookRequest;
use Modules\Book\app\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Book\app\Resources\BookResource;
use Modules\Book\app\Http\Requests\BookRequest;

class BookController extends Controller
{
    public function index()
    {
        $responseData = Book::with('authors')->get();
        if ($responseData) {
            return response()->json([
                'data' => [
                    "Books" => BookResource::collection($responseData)
                ],
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'data not found',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }
    public function show($id)
    {
        $responseData = Book::with('authors')->find($id);
        if ($responseData) {
            return response()->json([
                'data' => [
                    "Books" => BookResource::make($responseData),
                ],
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'Book not Exist',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }
    public function store(BookRequest $request)
    {
        $createdBook = Book::create([
            'title' => $request->title,
        ]);
        if ($createdBook) {
            return response()->json([
                'data' => [
                    "Books" => BookResource::make($createdBook),
                ],
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'Book not Created',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }

    public function update(BookRequest $request, $id)
    {
        $ifBookExist = Book::with('authors')->find($id);
        if ($ifBookExist) {
            $ifBookExist->update([
                'title' => $request->title,
            ]);
            return response()->json([
                'data' => [
                    "Books" => BookResource::make($ifBookExist),
                ],
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
                'message' => 'Book Updated'
            ]);
        }
        return response()->json([
            'message' => 'Book not Exist',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }
    public function destroy($id)
    {
        $ifBookExist = Book::with('authors')->find($id);
        if ($ifBookExist) {
            $ifBookExist->delete();
            return response()->json([
                'message' => 'Book deletd',
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'Book not Exist',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }
    public function setBookAuthor(AuthorBookRequest $request){
        $book = Book::find($request->book_id);
        $synced = $book->authors()->sync([((int)($request->author_id))],false);
        return $synced;

    }
    public function updateBookAuthor(updateAuthorBookRequest $request,$id){
        $book = Book::find($id);
        if(count($book->authors)!=0){
            $book->authors()->detach($request->old_author);
            $book->authors()->attach($request->new_author);
            return response()->json([
                'message'=> 'Data has updated',
                'status'=>true,
                'statusCode'=>200,
            ]);
        }
        return response()->json([
            'message'=> 'Book Not found',
            'status'=>false,
            'statusCode'=>404,
        ]);

    }
    public function deleteBookAuthor(AuthorBookRequest $request){
        $book = Book::find($request->book_id);
        $detched = $book->authors()->detach($request->author_id);
        return response()->json([
            'message'=>'author don\'t auth book & deleted ',
            'type'=>'success',
            'status'=>true,
            'statusCode'=>200,
        ]);
    }
}
