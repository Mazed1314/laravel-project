@extends('layout.app')
@section('pageTitle',trans('Product List'))
@section('pageSubTitle',trans('List'))

@section('content')

<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <a class="float-right btn btn-primary mr-2 py-2 btn-sm" href="{{route(currentUser().'.product.create')}}">Add</a>
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Category')}}</th>
                                    <th scope="col">{{__('Sub Category')}}</th>
                                    <th scope="col">{{__('Child Category')}}</th>
                                    <th scope="col">{{__('Name')}}</th>
                                    <th scope="col">{{__('Sales Price')}}</th>
                                    <th scope="col">{{__('Image')}}</th>
                                    <th scope="col">{{__('Status')}}</th>
                                    <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $p)
                                <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$p->category?->category}}</td>
                                    <td>{{$p->subcategory?->name}}</td>
                                    <td>{{$p->childcategory?->name}}</td>
                                    <td>{{$p->product_name}}</td>
                                    <td>{{$p->price}}</td>
                                     <td><img width="80px" height="40px" class="float-first" src="{{asset('public/images/product/'.$p->image)}}" alt=""></td>
                                    <td>@if($p->status == 1) Active @else Inactive @endif</td>
                                    <!-- or <td>{{ $p->status == 1?"Active":"Inactive" }}</td>-->
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.product.edit',encryptor('encrypt',$p->id))}}" class="btn btn-info btn-sm">
                                                Edit
                                        </a>
                                        <a href="javascript:void()" onclick="$('#form{{$p->id}}').submit()" class="btn btn-success btn-sm">
                                             Delete
                                        </a> 
                                        <form id="form{{$p->id}}" action="{{route(currentUser().'.product.destroy',encryptor('encrypt',$p->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                        </form>
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
<!-- Bordered table end -->


@endsection