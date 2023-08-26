@extends('layout.app')
 
@section('pageTitle',trans('Update Supplier'))
@section('pageSubTitle',trans('Update'))

@section('content')

  <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12">
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <form class="form" method="post" enctype="multipart/form-data" action="{{route(currentUser().'.supplier.update',encryptor('encrypt',$supplier->id))}}">
                              @csrf
                              @method('patch')
                              <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$supplier->id)}}">
                              <div class="row">
                                  <div class="col-md-6 col-12">
                                      <div class="form-group">
                                          <label for="name">{{__('Supplier')}}<span class="text-danger">*</span></label>
                                          <input type="text" id="name" value="{{ old('supplier',$supplier->supplier)}}" class="form-control" placeholder="Supplier Name" name="supplier">
                                          @if($errors->has('supplier'))
                                          <span class="text-danger"> {{ $errors->first('supplier') }}</span>
                                          @endif
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="contact_no">{{__('Contact')}}<span class="text-danger">*</span></label>
                                            <input type="text" id="contact_no" class="form-control" value="{{ old('contact_no',$supplier->contact_no)}}" name="contact_no" required>
                                            @if($errors->has('contact_no'))
                                            <span class="text-danger"> {{ $errors->first('contact_no') }}</span>
                                            @endif
                                        </div>
                                  </div>
                                  
                                  <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning mb-1">{{__('Update')}}</button>
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