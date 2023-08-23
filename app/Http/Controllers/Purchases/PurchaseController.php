<?php
namespace App\Http\Controllers\Purchases;

use App\Http\Controllers\Controller;

use App\Models\Purchases\Purchase;
use App\Models\Purchases\Purchase_details;
use App\Models\Stock\Stock;
use App\Models\Suppliers\Supplier;
use App\Models\Products\Product;
use App\Models\Settings\Branch;
use App\Models\Settings\Warehouse;
use App\Models\Settings\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Purchases\AddNewRequest;
use App\Http\Requests\Purchases\UpdateRequest;
use App\Http\Traits\ResponseTrait;
use Exception;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if( currentUser()=='owner')
            $purchases = Purchase::where(company())->paginate(10);
        else
            $purchases = Purchase::where(company())->where(branch())->paginate(10);
            
        
        return view('purchase.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $pur= new purchase;
            $pur->name=$request->purchaseName;
            if($request->has('image'))
                $cat->image=$this->resizeImage($request->image,'images/purchase',true,200,200,false);

            if($pur->save())
                return redirect()->route(currentUser().'.purchase.index')->with($this->resMessageHtml(true,null,'Successfully created'));
            else
                return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(purchase $purchase)
    {
        $purchase=purchase::findOrFail(encryptor('decrypt',$id));
        return view('purchase.edit',compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, purchase $purchase)
    {
        try{
            $pur= purchase::findOrFail(encryptor('decrypt',$id));
            $pur->name=$request->purchaseName;
            if($pur->save())
                return redirect()->route(currentUser().'.purchase.index')->with($this->resMessageHtml(true,null,'Successfully created'));
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
    public function destroy(purchase $purchase)
    {
        $pur= purchase::findOrFail(encryptor('decrypt',$id));
        $pur->delete();
        return redirect()->back();
    }
}
