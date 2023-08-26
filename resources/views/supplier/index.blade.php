@extends('layout.app')

@section('pageTitle',trans('Supplier List'))
@section('pageSubTitle',trans('List'))

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div>
                        <a class="float-right btn btn-primary btn-sm mr-2" href="{{route(currentUser().'.supplier.create')}}">Add</a>
                    </div>
                    
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Contact')}}</th>
                                        <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @forelse($suppliers as $sup)
                                    <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$sup->supplier_name}}</td>
                                        <td>{{$sup->contact_no}}</td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.supplier.edit',encryptor('encrypt',$sup->id))}}" class="btn btn-info btn-sm">
                                                Edit
                                            </a>
                                             <a href="javascript:void()" onclick="$('#form{{$sup->id}}').submit()" class="btn btn-success btn-sm">
                                             Delete
                                            </a> 
                                            <form id="form{{$sup->id}}" action="{{route(currentUser().'.supplier.destroy',encryptor('encrypt',$sup->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Supplier Found</th>
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

