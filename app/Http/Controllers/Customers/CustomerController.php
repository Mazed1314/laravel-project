<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\AddNewRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use Exception;

class CustomerController extends Controller
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
            $customers = customer::paginate(10);
        else
            $customers = customer::paginate(10);

        return view('customer.index',compact('customers'));
    }
    public function create()
    {
        
        return view('customer.create');
    }
    public function store(AddNewRequest $request)
    {
        try{
            $cus= new Customer;
            $cus->customer=$request->customer;
            if($request->has('image'))
                $cus->image=$this->resizeImage($request->image,'images/customer',true,200,200,false);
            
            if($cus->save())
                return redirect()->route(currentUser().'.customer.index')->with($this->resMessageHtml(true,null,'Successfully created'));
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
        $customer=Customer::findOrFail(encryptor('decrypt',$id));
        return view('customer.edit',compact('customer'));
    }
    public function update(UpdateRequest $request, $id)
    {
        try{
            $cus= Customer::findOrFail(encryptor('decrypt',$id));
            $cus->customer=$request->customer;
            $path='images/customer';
            if($request->has('image') && $request->image)
                if($this->deleteImage($cus->image,$path))
                    $cus->image=$this->resizeImage($request->image,$path,true,200,200,false);
                
            if($cus->save())
                return redirect()->route(currentUser().'.customer.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
    public function destroy($id)
    {
        
        $cus= Customer::findOrFail(encryptor('decrypt',$id));
        $cus->delete();
        return redirect()->back();
    }
}
