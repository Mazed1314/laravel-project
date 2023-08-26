  @extends('layout.app')

  @section('pageTitle',trans('Create Supplier'))
@section('pageSubTitle',trans('Create'))

  @section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.supplier.store')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name">{{__('Supplier')}}<span class="text-danger">*</span></label>
                                            <input type="text" id="name" class="form-control"
                                                placeholder="Supplier Name" name="supplier">
                                                @if($errors->has('supplier'))
                                                <span class="text-danger"> {{ $errors->first('supplier') }}</span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="contact_no">{{__('Contact No')}}<span class="text-danger">*</span></label>
                                        <input type="text" id="contact_no" class="form-control" value="{{ old('contact_no')}}" name="contact_no" required>
                                        @if($errors->has('contact_no'))
                                        <span class="text-danger"> {{ $errors->first('contact_no') }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-danger me-1 mb-1">{{__('Save')}}</button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection