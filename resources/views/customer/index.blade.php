@extends('layout.app')
@section('pageTitle',trans('Customer List'))
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
                <div class="p-0 m-0">
                    <a href="{{route(currentUser().'.customer.create')}}" class="btn btn-danger btn-sm float-right">Add</a>
                </div>
                <!-- table bordered -->
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{__('#SL')}}</th>
                                <th scope="col">{{__('Customer')}}</th>
                                <th scope="col">{{__('Contact')}}</th>
                                <th class="white-space-nowrap">{{__('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $cus)
                            <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                <td>{{$cus->customer_name}}</td>
                                <td>{{$cus->contact}}</td>
                                <td class="white-space-nowrap">
                                    <a href="{{route(currentUser().'.customer.edit',encryptor('encrypt',$cus->id))}}" class="btn btn-info btn-sm">
                                        Edit
                                    </a>
                                    <a href="javascript:void()" onclick="$('#form{{$cus->id}}').submit()" class="btn btn-success btn-sm">
                                        Delete
                                    </a>
                                    <form id="form{{$cus->id}}" action="{{route(currentUser().'.customer.destroy',encryptor('encrypt',$cus->id))}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="8" class="text-center">No Pruduct Found</th>
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