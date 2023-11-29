<?php

namespace Modules\Author\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Author\app\Http\Requests\AuthorRequest;
use Modules\Author\app\Models\Author;
use Modules\Author\app\Resources\AuthorResource;

class AuthorController extends Controller
{
    public function index()
    {
        $responseData = Author::with('books')->get();
        if ($responseData) {
            return response()->json([
                'data' => [
                    "Authors" => AuthorResource::collection($responseData)
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
        $responseData = Author::with('books')->find($id);
        if ($responseData) {
            return response()->json([
                'data' => [
                    "Authors" => AuthorResource::make($responseData),
                ],
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'Author not Exist',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }
    public function store(AuthorRequest $request)
    {
        $createdAuthor = Author::create([
            'name' => $request->name,
        ]);
        if ($createdAuthor) {
            return response()->json([
                'data' => [
                    "Authors" => AuthorResource::make($createdAuthor),
                ],
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'Author not Created',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }

    public function update(AuthorRequest $request, $id)
    {
        $ifAuthorExist = Author::with('books')->find($id);
        if ($ifAuthorExist) {
            $ifAuthorExist->update([
                'name' => $request->name,
            ]);
            return response()->json([
                'data' => [
                    "Authors" => AuthorResource::make($ifAuthorExist),
                ],
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
                'message' => 'Author Updated'
            ]);
        }
        return response()->json([
            'message' => 'Author not Exist',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }
    public function destroy($id)
    {
        $ifAuthorExist = Author::with('books')->find($id);
        if ($ifAuthorExist) {
            $ifAuthorExist->delete();
            return response()->json([
                'message' => 'Author deletd',
                'status' => true,
                'statusCode' => 200,
                'type' => 'success',
            ]);
        }
        return response()->json([
            'message' => 'Author not Exist',
            'status' => false,
            'statusCode' => 404,
            'type' => 'fail',
        ]);
    }
}
