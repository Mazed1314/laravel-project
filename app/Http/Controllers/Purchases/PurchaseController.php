<?php

namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;
use App\Models\Purchases\Purchase;
use App\Models\Stock;
use App\Models\Products\Product;
use App\Models\Suppliers\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\Purchase\AddNewRequest;
use App\Http\Requests\Purchase\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use Exception;
use DB;

class PurchaseController extends Controller
{
    public function index(){
        $purchases=Purchase::Paginate(10);
        return view('purchase.index',compact('purchases'));
    }
    public function create()
    {
        $suppliers = Supplier::get();
        $products = Product::get();
        return view('purchase.create',compact('suppliers','products'));
    }
    public function store(AddNewRequest $request)
    {
        DB::beginTransaction();
        try{
            $pur= new Purchase;
            $pur->supplier_id=$request->supplier_id;
            $pur->product_id=$request->product_id;
            $pur->price=$request->price;
            $pur->quantity=$request->quantity;
            $pur->discount=$request->discount;
            $pur->vat=$request->vat;
            $pur->total_amount=$request->total_amount;
            
            if($pur->save()){
                $stock=new Stock;
                $stock->purchase_id=$pur->id;
                $stock->product_id=$pur->product_id;
                $stock->quantity=$pur->quantity;
                $stock->price=($request->total_amount / $pur->quantity);
                //dd($stock);
                if($stock->save()){
                    DB::commit();
                    return redirect()->route(currentUser().'.purchase.index')->with($this->resMessageHtml(true,null,'Successfully created'));
                }else{
                    return redirect()->route(currentUser().'.purchase.index')->with($this->resMessageHtml(false,'error','Stock is not saved. Please try again'));
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
        $purchase=Purchase::findOrFail(encryptor('decrypt',$id));
        return view('purchase.edit',compact('purchase'));
    }
    public function update(UpdateRequest $request, $id)
    {
        try{
            $pur= Purchase::findOrFail(encryptor('decrypt',$id));
            $pur->purchase=$request->purchase;
            $path='images/purchase';
            if($request->has('image') && $request->image)
                if($this->deleteImage($pur->image,$path))
                    $pur->image=$this->resizeImage($request->image,$path,true,200,200,false);
                
            if($pur->save())
                return redirect()->route(currentUser().'.purchase.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
    public function destroy($id)
    {
        
        $pur= Purchase::findOrFail(encryptor('decrypt',$id));
        $pur->delete();
        return redirect()->back();
    }
    
}
