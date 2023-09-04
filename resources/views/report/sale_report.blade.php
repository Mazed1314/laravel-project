@extends('layout.app')

@section('pageTitle',trans('Sale Report'))
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
                                        <td scope="col">{{__('Date')}}</td>
                                        <td scope="col">{{__('Amount')}}</td>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sales as $s)
                                    <tr>
                                        <td scope="row">{{ ++$loop->index }}</td>
                                        <td>{{$s->dt}}</td>
                                        <td>{{$s->amt}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="4" class="text-center">No Report Found</th>
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

