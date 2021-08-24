<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Models\Author;

class AuthorController extends Controller
{
    use ApiResponser;
    //
    public function index(){
        $authors =  Author::all();
        return $this->successResponse($authors);
    }

    public function store(Request $request){

       $validation = [
           'name' => 'required',
           'gender' => 'required|in:male,female',
           'country' => 'required'
       ];

       $this->validate($request, $validation);

       $author = Author::create($request->all());
       return $this->successResponse($author, Response::HTTP_CREATED);
        
    }

    public function show($author){
        $author = Author::findOrFail($author);
        return $this->successResponse($author);
    }

    public function update(Request $request, $author){

        $validation = [
            'name' => 'required',
            'gender' => 'required|in:male,female',
            'country' => 'required'
        ];
 
        $this->validate($request, $validation);

        $author = Author::findOrFail($author);

        $author->fill($request->all());
        if($author->isClean()){
            return $this->errorResponse('At Least You Have To Update One Value', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();
        return $this->successResponse($author);
    }

    public function delete($author){
        $author = Author::findOrFail($author);
        $author->delete();
        return $this->successResponse($author);
    }
}
