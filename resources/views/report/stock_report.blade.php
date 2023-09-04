@extends('layout.app')

@section('pageTitle',trans('Stock Report'))
@section('pageSubTitle',trans('Report'))

@section('content')


    <!-- Bordered table start -->
    <section class="section">
        <div class="row" id="table-bordered">
            <div class="col-12">
                <div class="card">
                        <!-- table bordered -->
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <td scope="col">{{__('#SL')}}</td>
                                        <td scope="col">{{__('Product')}}</td>
                                        <td scope="col">{{__('Quantity')}}</td>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stock as $pur)
                                    <tr>
                                        <td scope="row">{{ ++$loop->index }}</td>
                                        <td>{{$pur->product}}</td>
                                        <td>{{$pur->qty}}</td>                                    </tr>
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

@endsection

