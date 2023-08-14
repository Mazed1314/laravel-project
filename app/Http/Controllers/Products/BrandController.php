<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;

use App\Models\Products\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\Brand\AddNewRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use Exception;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::where(company())->paginate(10);
        return view('brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddNewRequest $request)
    {
        try{
            $b=new Brand;
            $b->name=$request->brandName;
            $b->company_id=company()['company_id'];
            if($b->save())
                return redirect()->route(currentUser().'.brand.index')->with($ths->resMassageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));

        }catch(Exception $e){
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        $brand=Brand::findOrFail(encryptor('decrypt',$id));
        return view('brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        try{
            $b= Brand::findOrFail(encryptor('decrypt',$id));
            $b->name=$request->brandName;
            if($b->save())
                return redirect()->route(currentUser().'.brand.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
