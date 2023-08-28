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
    use ResponseTrait;

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
        $suppliers = Supplier::get();
        $products = Product::get();
        $purchase=Purchase::findOrFail(encryptor('decrypt',$id));
        return view('purchase.edit',compact('purchase','suppliers','products'));
    }
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $pur= Purchase::findOrFail(encryptor('decrypt',$id));
            $pur->supplier_id=$request->supplier_id;
            $pur->product_id=$request->product_id;
            $pur->price=$request->price;
            $pur->quantity=$request->quantity;
            $pur->discount=$request->discount;
            $pur->vat=$request->vat;
            $pur->total_amount=$request->total_amount;
                
            if($pur->save()){
                $stock=Stock::where('purchase_id',$pur->id)->first();
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
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
    public function destroy($id)
    {
        
        $pur= Purchase::findOrFail(encryptor('decrypt',$id));
        $quantity=Stock::where('product_id',$pur->product_id)->sum('quantity');
        if($quantity){
            if($quantity >= $pur->quantity){
                $stock=Stock::where('purchase_id',$pur->id)->delete();
                $pur->delete();
            }else{
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','You already sales from this purchase'));
            }
        }else{
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','You already sales from this purchase'));
        }
        
        return redirect()->back();
    }
    
}
