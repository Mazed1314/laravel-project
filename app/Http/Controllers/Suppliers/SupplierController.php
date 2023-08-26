<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Models\Suppliers\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\AddNewRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use Exception;

class SupplierController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( currentUser()=='owner')
            $suppliers = supplier::paginate(10);
        else
            $suppliers = supplier::paginate(10);

        return view('supplier.index',compact('suppliers'));
    }
    public function create()
    {
        
        return view('supplier.create');
    }
    public function store(AddNewRequest $request)
    {
        try{
            $sup= new Supplier;
            $sup->supplier_name=$request->supplier;
            $sup->contact_no=$request->contact_no;
            
            if($sup->save())
                return redirect()->route(currentUser().'.supplier.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $supplier=Supplier::findOrFail(encryptor('decrypt',$id));
        return view('supplier.edit',compact('supplier'));
    }
    public function update(UpdateRequest $request, $id)
    {
        try{
            $sup= Supplier::findOrFail(encryptor('decrypt',$id));
            $sup->supplier_name=$request->supplier;
            $sup->contact_no=$request->contact_no;
           
            if($sup->save())
                return redirect()->route(currentUser().'.supplier.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
    public function destroy($id)
    {
        
        $sup= Supplier::findOrFail(encryptor('decrypt',$id));
        $sup->delete();
        return redirect()->back();
    }
}
