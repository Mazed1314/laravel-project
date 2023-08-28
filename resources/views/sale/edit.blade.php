@extends('layout.app')

@section('pageTitle',trans('Edit Sale'))
@section('pageSubTitle',trans('Update'))

@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route(currentUser().'.customer.update',encryptor('encrypt',$sale->id))}}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$sale->id)}}">
                                <div class="row">
                                    @if( currentUser()=='owner')
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="customer">{{__('customer Name')}}</label>
                                                <select  class="form-control form-select" name="customer" id="customer">
                                                    <option value="">Select customer</option>
                                                    @forelse($customer as $s)
                                                        <option value="{{$s->id}}" {{ old('customer_id',$product->customer_id)==$s->id?"selected":""}}> {{ $s->name}}</option>
                                                    @empty
                                                        <option value="">No Customer found</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                    @endif 
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="product">Product</label>
                                            <input type="text" id="product_id" class="form-control" value="{{ old('product_id',$sale->product_id)}}" name="product_id">
                                            @if($errors->has('product_id'))
                                            <span class="text-danger"> {{ $errors->first('product_id') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" readonly onkeyup="checkPrice()" id="price" class="form-control" placeholder="Price" name="price">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="quantity">'Quantity'</label>
                                            <input type="text" onkeyup="checkPrice()" id="quantity" class="form-control"
                                                placeholder="Quantity" name="quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="discount">Discount %</label>
                                            <input type="text" onkeyup="checkPrice()" id="discount" class="form-control"
                                                placeholder="Discount" name="discount">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="vat">Vat %</label>
                                            <input type="text" onkeyup="checkPrice()" id="vat" class="form-control"
                                                placeholder="Vat" name="vat">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <div class="form-group">
                                            <label for="total_amount">{{__('Total Amount')}}</label>
                                            <input type="text" id="total_amount" class="form-control"
                                                placeholder="Total Price" name="total_amount">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning me-1 mb-1">Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection