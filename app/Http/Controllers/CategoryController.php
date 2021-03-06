<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private $data;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Category::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoryRequest $request)
    {

     $validator = \Validator::make($request->all(),$this->categoryRules() );

     if ($validator->fails()) {
         return response()->json(['errors'=>$validator->errors()]);
     }
     $this->data['name']= $request['name'];
     $this->data['slug'] = Str::slug($request['name'],"-");
    $data =  category::create($this->data);
     return response()->json($data,Response::HTTP_CREATED);
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
       $validator = \Validator::make($request->all(),$this->categoryRules() );

       if ($validator->fails()) {
         return response()->json(['errors'=>$validator->errors()]);
     }
     $category->update(['name'=> $request->name,'slug'=>Str::slug($request->name,'-')]);
     return response($category,Response::HTTP_ACCEPTED);

 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response(null,Response::HTTP_NO_CONTENT);

    }
    public function categoryRules (){

      return[
        "name"=>"required",
    ];
}
}
