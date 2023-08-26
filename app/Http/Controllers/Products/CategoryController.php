<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;

use App\Models\Products\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Category\AddNewRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use App\Http\Traits\ImageHandleTraits;
use Exception;

class CategoryController extends Controller
{
    use ResponseTrait,ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::paginate(10);
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $cat= new Category;
            $cat->category=$request->category;
            if($request->has('image'))
                $cat->image=$this->resizeImage($request->image,'images/category',true,200,200,false);
            
            if($cat->save())
                return redirect()->route(currentUser().'.category.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findOrFail(encryptor('decrypt',$id));
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $cat= Category::findOrFail(encryptor('decrypt',$id));
            $cat->category=$request->category;
            if($request->has('image')){
                if($cat->image){
                    if($this->deleteImage($cat->image,'images/category/')){
                        $cat->image=$this->resizeImage($request->image,'images/category/',true,200,200,false);
                    }
                }else{
                    $cat->image=$this->resizeImage($request->image,'images/category/',true,200,200,false);
                }
            }
            
            if($cat->save())
                return redirect()->route(currentUser().'.category.index')->with($this->resMessageHtml(true,null,'Successfully created'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // try{
        //     if($category->products->count() > 0){
        //         return redirect()->back()->with('message','you have to delete all product under this category first.');
        //     }else{
        //         $category->delete();
        //         return redirect()->back();
        //     }
            
        // }catch(Exception $e){
        //     return redirect()->back();
        // }
        $cat= Category::findOrFail(encryptor('decrypt',$id));
        $cat->delete();
        return redirect()->back();
    }

}
