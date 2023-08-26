@extends('layout.app')

@section('pageTitle',trans('Category List'))
@section('pageSubTitle',trans('List'))

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                    <div>
                        <a class="float-right btn btn-primary btn-sm mr-2" href="{{route(currentUser().'.category.create')}}">Add</a>
                    </div>
                    
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{__('#SL')}}</th>
                                        <th scope="col">{{__('Name')}}</th>
                                        <th scope="col">{{__('Image')}}</th>
                                        <th class="white-space-nowrap">{{__('ACTION')}}</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @forelse($categories as $cat)
                                    <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                        <td>{{$cat->category}} ({{$cat->products->count()}})</td>
                                        <td><img width="80px" height="40px" class="float-first" src="{{asset('public/images/category/'.$cat->image)}}" alt=""></td>
                                        <td class="white-space-nowrap">
                                            <a href="{{route(currentUser().'.category.edit',encryptor('encrypt',$cat->id))}}" class="btn btn-info btn-sm">
                                                Edit
                                            </a>
                                             <a href="javascript:void()" onclick="$('#form{{$cat->id}}').submit()" class="btn btn-success btn-sm">
                                             Delete
                                            </a> 
                                            <form id="form{{$cat->id}}" action="{{route(currentUser().'.category.destroy',encryptor('encrypt',$cat->id))}}" method="post">
                                                @csrf
                                                @method('delete')
                                                
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Category Found</th>
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

