<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;

use App\Models\Sales\Sales;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;
use App\Models\Customers\Customer;
use App\Http\Requests\Sale\AddNewRequest;
use App\Http\Requests\Sale\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use Exception;
use DB;

class SaleController extends Controller
{
    public function index(){
        $sales=Sale::Paginate(10);
        return view('sale.index',compact('sales'));
    }
    public function create()
    {
        $customers = Customer::get();
        $products = Product::get();
        return view('sale.create',compact('customers','products'));
    }
    public function store(AddNewRequest $request)
    {
        DB::beginTransaction();
        try{
            $s= new Sale;
            $s->customer_id=$request->customer_id;
            $s->product_id=$request->product_id;
            $s->price=$request->price;
            $s->quantity=$request->quantity;
            $s->discount=$request->discount;
            $s->vat=$request->vat;
            $s->total_amount=$request->total_amount;
            
            if($s->save()){
                $stock=new Stock;
                $stock->sale_id=$s->id;
                $stock->product_id=$s->product_id;
                $stock->quantity=$s->quantity;
                $stock->price=($request->total_amount / $s->quantity);
                //dd($stock);
                if($stock->save()){
                    DB::commit();
                    return redirect()->route(currentUser().'.sale.index')->with($this->resMessageHtml(true,null,'Successfully created'));
                }else{
                    return redirect()->route(currentUser().'.sale.index')->with($this->resMessageHtml(false,'error','Stock is not saved. Please try again'));
                }
            }
        }catch(Exception $e){
            DB::rollback();
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
        $sale=Sale::findOrFail(encryptor('decrypt',$id));
        return view('sale.edit',compact('sale'));
    }
    public function update(UpdateRequest $request, $id)
    {
        try{
            $s= Sale::findOrFail(encryptor('decrypt',$id));
            $s->sale=$request->sale;
            $path='images/sale';
            if($request->has('image') && $request->image)
                if($this->deleteImage($s->image,$path))
                    $s->image=$this->resizeImage($request->image,$path,true,200,200,false);
                
            if($s->save())
                return redirect()->route(currentUser().'.sale.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
    public function destroy($id)
    {
        
        $s= Sale::findOrFail(encryptor('decrypt',$id));
        $s->delete();
        return redirect()->back();
    }
    
}
