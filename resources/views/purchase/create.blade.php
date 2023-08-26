@extends('layout.app')

@section('pageTitle',trans('Create Purchase'))
@section('pageSubTitle',trans('Create'))

@section('content')
  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12"> 
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" action="{{route(currentUser().'.purchase.store')}}">
                            @csrf
                              <div class="row">
                                  <div class="col-md-4 col-12">
                                      <div class="form-group">
                                        <label for="name">{{__('Supplier Name')}}<span class="text-danger">*</span></label>
                                        <select class="form-control form-select" name="supplier_id" id="supplier_id">
                                            <option value="">Select Supplier</option>
                                            @forelse($suppliers as $s)
                                                <option value="{{$s->id}}" {{ old('supplier_id')==$s->id?"selected":""}}> {{ $s->supplier_name}}</option>
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
                                                <option value="{{$p->id}}" {{ old('product_id')==$p->id?"selected":""}}> {{ $p->product_name}}</option>
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
                                          <label for="price">{{__('Price')}}</label>
                                          <input type="number" onkeyup="checkPrice()" id="price" class="form-control" placeholder="Price" name="price">
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                      <div class="form-group">
                                          <label for="quantity">{{__('Quantity')}}</label>
                                          <input type="number" onkeyup="checkPrice()" id="quantity" class="form-control"
                                              placeholder="Quantity" name="quantity">
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                      <div class="form-group">
                                          <label for="discount">{{__('Discount')}} %</label>
                                          <input type="number" onkeyup="checkPrice()" id="discount" class="form-control"
                                              placeholder="Discount" name="discount">
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-12">
                                      <div class="form-group">
                                          <label for="vat">{{__('Vat')}} %</label>
                                          <input type="number" onkeyup="checkPrice()" id="vat" class="form-control"
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
                                    <button type="submit" class="btn btn-danger me-1 mb-1">{{__('Save')}}</button>
                                      
                                  </div>
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