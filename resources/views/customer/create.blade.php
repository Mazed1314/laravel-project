@extends('layout.app')

@section('pageTitle',trans('Create Customer'))
@section('pageSubTitle',trans('Create'))

@section('content')
  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.customer.store')}}">
                              @csrf
                              <div class="row">
                                  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="name">{{__('Customer')}}<span class="text-danger">*</span></label>
                                          <input type="text" id="name" class="form-control"
                                              placeholder="Customer Name" name="customer">
                                              @if($errors->has('customer'))
                                              <span class="text-danger"> {{ $errors->first('customer') }}</span>
                                              @endif
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                    <label for="contact">{{__('Contact')}}<span class="text-danger">*</span></label>
                                    <input type="text" id="contact" class="form-control" value="{{ old('contact')}}" name="contact" required>
                                    @if($errors->has('contact'))
                                    <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                    @endif
                                </div>
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