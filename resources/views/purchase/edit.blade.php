@extends('layout.app')

@section('pageTitle',trans('Edit Purchase'))
@section('pageSubTitle',trans('Update'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.purchase.update',encryptor('encrypt',$purchase->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$purchase->id)}}">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">{{__('Supplier Name')}}<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="supplier_id" id="supplier_id">
                                            <option value="">Select Supplier</option>
                                            @forelse($suppliers as $s)
                                                <option value="{{$s->id}}" {{ old('supplier_id',$purchase->supplier_id)==$s->id?"selected":""}}> {{ $s->supplier_name}}</option>
                                            @empty
                                                <option value="">No Supplier found</option>
                                            @endforelse
                                        </select>
                                        @if($errors->has('supplier_id'))
                                            <span class="text-danger"> {{ $errors->first('supplier_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="name">{{__('Product Name')}}<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="product_id" id="product_id">
                                            <option value="">Select Product</option>
                                            @forelse($products as $p)
                                                <option value="{{$p->id}}" {{ old('product_id',$purchase->product_id)==$p->id?"selected":""}}> {{ $p->product_name}}</option>
                                            @empty
                                                <option value="">No Product found</option>
                                            @endforelse
                                        </select>
                                        @if($errors->has('product_id'))
                                        <span class="text-danger"> {{ $errors->first('product_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="text" readonly onkeyup="checkPrice()" id="price" class="form-control" value="{{$purchase->price}}" placeholder="Price" name="price">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="quantity">'Quantity'</label>
                                        <input type="text" onkeyup="checkPrice()" id="quantity" class="form-control" value="{{$purchase->quantity}}"
                                            placeholder="Quantity" name="quantity">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="discount">Discount %</label>
                                        <input type="text" onkeyup="checkPrice()" id="discount" class="form-control" value="{{$purchase->discount}}"
                                            placeholder="Discount" name="discount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="vat">Vat %</label>
                                        <input type="text" onkeyup="checkPrice()" id="vat" class="form-control" value="{{$purchase->vat}}"
                                            placeholder="Vat" name="vat">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="total_amount">{{__('Total Amount')}}</label>
                                        <input type="text" id="total_amount" class="form-control" value="{{$purchase->total_amount}}"
                                            placeholder="Total Price" name="total_amount">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@push('scripts')

<script>
    function checkPrice(){
        var price=$('#price').val()?parseFloat($('#price').val()):0;
        var quantity=$('#quantity').val()?parseFloat($('#quantity').val()):0;
        var vat=$('#vat').val()?parseFloat($('#vat').val()):0;
        var discount=$('#discount').val()?parseFloat($('#discount').val()):0;

        var subprice=price*quantity;
        if(discount){
            subprice= (subprice - (subprice*(discount/100)))
        }
        if(vat){
            subprice= (subprice + (subprice*(vat/100)))
        }
        $("#total_amount").val(subprice)
    }
</script>
@endpush