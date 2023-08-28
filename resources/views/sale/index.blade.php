@extends('layout.app')

@section('pageTitle',trans('Sale List'))
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
                                <a class="float-right btn btn-primary btn-sm mr-2" href="{{route(currentUser().'.sale.create')}}">Add</a>
                                <thead>
                                    <tr>
                                        <td scope="col">{{__('#SL')}}</td>
                                        <td scope="col">{{__('Customer')}}</td>
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
                                    @forelse($sales as $s)
                                    <tr>
                                        <td scope="row">{{ ++$loop->index }}</td>
                                        <td>{{$s->customer?->customer_name}}</td>
                                        <td>{{$s->product?->product_name}}</td>
                                        <td>{{$s->price}}</td>
                                        <td>{{$s->quantity}}</td>
                                        <td>{{$s->discount}}</td>
                                        <td>{{$s->vat}}</td>
                                        <td>{{$s->total_amount}}</td>
                                        <td class="white-space-nowrap">
                                            <a  href="{{route(currentUser().'.sale.edit',encryptor('encrypt',$s->id))}}" class="btn btn-info btn-sm">
                                                Edit
                                            </a>
                                            <a href="javascript:void()"  onclick="$('#form{{$s->id}}').submit()" class="btn btn-success btn-sm">
                                                delete
                                            </a>
                                            <form id="form{{$s->id}}" action="{{route(currentUser().'.sale.destroy',encryptor('encrypt',$s->id))}}" method="post">
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

