<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\question;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class questionController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  QuestionResource::collection(question::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = Auth()->user()->question()->create($request->all());
        return response()->json(new QuestionResource($question),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {


     Auth()->user()->question()->update($request->all());
     return response('accepted',Response::HTTP_ACCEPTED);
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {

        $question->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }
    public function QuestionRules(){

        return[
            'title' => 'required|max:255',
            "slug"=>"required",
            "body"=>"required",
            "user_id"=>"required",
            "category_id"=>"required",
        ];
    }
}
