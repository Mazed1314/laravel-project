@extends('layout.app')
@section('pageTitle',trans('Childcategory List'))
@section('pageSubTitle',trans('List'))

@section('content')

<!-- Bordered table start -->
<section class="section">
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                    <div>
                        <a class="float-right btn btn-primary btn-sm mr-2" href="{{route(currentUser().'.childcategory.create')}}">Add</a>
                    </div>
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <?php 
                        
                        //print_r($childcategories);
                        ?>
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">{{__('#SL')}}</th>
                                    <th scope="col">{{__('Sub Category')}}</th>
                                    <th scope="col">{{__('Child Category')}}</th>
                                    <th class="white-space-nowrap">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($childcategories as $child)
                                <tr>
                                <th scope="row">{{ ++$loop->index }}</th>
                                    <td>{{$child->subcategory?->name}}</td>
                                    <td>{{$child->name}}</td>
                                    <td class="white-space-nowrap">
                                        <a href="{{route(currentUser().'.childcategory.edit',encryptor('encrypt',$child->id))}}" class="btn btn-info btn-sm">
                                                Edit
                                        </a>
                                        <a href="javascript:void()" onclick="$('#form{{$child->id}}').submit()" class="btn btn-success btn-sm">
                                         Delete
                                        </a>
                                        <form id="form{{$child->id}}" action="{{route(currentUser().'.childcategory.destroy',encryptor('encrypt',$child->id))}}" method="post">
                                            @csrf
                                            @method('delete')
                                            
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <th colspan="3" class="text-center">No Pruduct Found</th>
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