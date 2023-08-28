@extends('layout.app')

@section('pageTitle',trans('Purchase List'))
@section('pageSubTitle',trans('List'))

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    @if(Session::has('response'))
                        {!!Session::get('response')['message']!!}
                    @endif
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <a class="float-right btn btn-primary btn-sm mr-2" href="{{route(currentUser().'.purchase.create')}}">Add</a>
                                <thead>
                                    <tr>
                                        <td scope="col">{{__('#SL')}}</td>
                                        <td scope="col">{{__('Supplier')}}</td>
                                        <td scope="col">{{__('Product')}}</td>
                                        <td scope="col">{{__('Price')}}</td>
                                        <td scope="col">{{__('Quantity')}}</td>
                                        <td scope="col">{{__('Discount')}}</td>
                                        <td scope="col">{{__('Vat')}}</td>
                                        <td scope="col">{{__('Total')}}</td>
                                        <td scope="col">{{__('Action')}}</td>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($purchases as $pur)
                                    <tr>
                                        <td scope="row">{{ ++$loop->index }}</td>
                                        <td>{{$pur->supplier?->supplier_name}}</td>
                                        <td>{{$pur->product?->product_name}}</td>
                                        <td>{{$pur->price}}</td>
                                        <td>{{$pur->quantity}}</td>
                                        <td>{{$pur->discount}}</td>
                                        <td>{{$pur->vat}}</td>
                                        <td>{{$pur->total_amount}}</td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.purchase.edit',encryptor('encrypt',$pur->id))}}" class="btn btn-info btn-sm">
                                                Edit
                                            </a>
                                            <a href="javascript:void()" onclick="$('#form{{$pur->id}}').submit()" class="btn btn-success btn-sm">
                                                delete
                                            </a>
                                            <form id="form{{$pur->id}}" action="{{route(currentUser().'.purchase.destroy',encryptor('encrypt',$pur->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No product Found</th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
        </div>
    </section>
    <!-- Bordered table end -->
</div>

@endsection

