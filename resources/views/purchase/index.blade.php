@extends('layout.app')
@section('pageTitle',trans('Purchase List'))
@section('pageSubTitle',trans('List'))
@section('content')
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                
                @if(Session::has('response'))
                    {!!Session::get('response')['message']!!}
                @endif
                <div>
                    <a class="float-end" href="{{route(currentUser().'.purchase.create')}}"style="font-size:1.7rem"><i class="bi bi-plus-square-fill"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Product Id')}}</th>
                                <th scope="col">{{__('Image')}}</th>
                                <th scope="col">{{__('Category')}}</th>
                                <th scope="col">{{__('Sub Category')}}</th>
                                <th scope="col">{{__('Child Category')}}</th>
                                <th scope="col">{{__('Purches Price')}}</th>
                                <th scope="col">{{__('Supplier Id')}}</th>
                                <th scope="col">{{__('QTY')}}</th>
                                <th scope="col">{{__('Status')}}</th>
                                <th scope="col">{{__('Date')}}</th>
                                <th scope="col">{{__('Sub Amount')}}</th>
                                <th scope="col">{{__('GrandTotal')}}</th>
                                <th scope="col">{{__('Payment Status')}}</th>
                                <!-- <th scope="col">{{__('TAX')}}</th>
                                <th scope="col">{{__('Discount Type')}}</th>
                                <th scope="col">{{__('RoundOf')}}</th> -->
                                <th class="white-space-nowrap">{{__('ACTION')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($purchases as $pur)
                            <tr>
                                <td scope="row">{{ ++$loop->index }}</td>
                                <td>{{$pur->product?->product_name}}</td>
                                <td>{{$pur->Product_id}}</td>
                                <td><img width="80px" height="40px" class="float-first" src="{{asset('public/images/purchase/'.$pur->image)}}" alt="Product Image"></td>
                                <td>{{$pur->category?->category}}</td>
                                <td>{{$pur->subcategory?->name}}</td>
                                <td>{{$pur->childcategory?->name}}</td>
                                <td>{{$pur->purches_price}}</td>
                                <td>{{$pur->supplier_id}}</td>
                                <td>{{$pur->quantity}}</td>
                                <td>{{$pur->status}}</td>
                                <td>{{$pur->purchase_date}}</td>
                                <td>{{$pur->sub_amount}}</td>
                                <td>{{$pur->grand_total}}</td>
                                <td>{{$pur->payment_status}}</td>
                                <!-- <td>{{$pur->tax}}</td>
                                <td>{{$pur->discount_type}}</td>
                                <td>{{$pur->round_of}}</td> -->
                                <td class="white-space-nowrap">
                                    {{-- <a href="{{route(currentUser().'.purchase.edit',encryptor('encrypt',$pur->id))}}">
                                        Edit
                                    </a>
                                    <a href="javascript:void()" onclick="$('#form{{$pur->id}}').submit()">
                                        Delete
                                    </a>
                                    <form id="form{{$pur->id}}" action="{{route(currentUser().'.purchase.destroy',encryptor('encrypt',$pur->id))}}" metdod="post">
                                        @csrf
                                        @method('delete')
                                    </form> --}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="12" class="text-center">No Pruduct Found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection