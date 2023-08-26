@extends('layout.app')

@section('pageTitle',trans('Update Sale'))
@section('pageSubTitle',trans('Update'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="post" action="{{route(currentUser().'.customer.update',encryptor('encrypt',$customer->id))}}">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="uptoken" value="{{encryptor('encrypt',$customer->id)}}">
                            <div class="row">

                                    @if( currentUser()=='owner')
                                        <div class="col-md-4 col-12">
                                            <div class="form-group">
                                                <label for="branch_id">Branches Name</label>
                                                <select class="form-control" name="branch_id" id="branch_id">
                                                    @forelse($branches as $b)
                                                        <option value="{{ $b->id }}" {{old('branch_id',$customer->branch_id)==$b->id?'selected':''}}>{{ $b->name }}</option>
                                                    @empty
                                                        <option value="">No branch found</option>
                                                    @endforelse
                                                </select>
                                                @if($errors->has('customer_name'))
                                                <span class="text-danger"> {{ $errors->first('customer_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <input type="hidden" value="{{ branch()['branch_id']}}" name="branch_id">
                                    @endif

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="customer_name">customer Name</label>
                                        <input type="text" id="customer_name" class="form-control" value="{{ old('customer_name',$customer->customer_name)}}" name="customer_name">
                                        @if($errors->has('customer_name'))
                                        <span class="text-danger"> {{ $errors->first('customer_name') }}</span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="contact">Contact</label>
                                        <input type="text" id="contact" class="form-control" value="{{ old('contact',$customer->contact)}}" name="contact">
                                        @if($errors->has('contact'))
                                        <span class="text-danger"> {{ $errors->first('contact') }}</span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" class="form-control" value="{{ old('email',$customer->email)}}" name="email">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" class="form-control" value="{{ old('phone',$customer->phone)}}" name="phone">
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="taxNumber">TAX Number</label>
                                        <input type="text" id="taxNumber" class="form-control" value="{{ old('taxNumber',$customer->tax_number)}}" name="taxNumber">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="gstNumber">GST Number</label>
                                        <input type="text" id="gstNumber" class="form-control" value="{{ old('gstNumber',$customer->gst_number)}}" name="gstNumber">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="openingAmount">Opening Balance</label>
                                        <input type="text" id="openingAmount" class="form-control" value="{{ old('openingAmount',$customer->opening_balance)}}" name="openingAmount">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="countryName">Country</label>
                                        <select class="form-control" name="countryName" id="countryName">
                                            <option value="">Select Country</option>
                                            @forelse($countries as $d)
                                                <option value="{{$d->id}}" {{ old('countryName',$customer->country_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No Category found</option>
                                            @endforelse
                                        </select>
                                        @if($errors->has('countryName'))
                                        <span class="text-danger"> {{ $errors->first('countryName') }}</span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="divisionName">Division</label>
                                        <select class="form-control" name="divisionName" id="divisionName">
                                            <option value="">Select Country</option>
                                            @forelse($divisions as $d)
                                                <option value="{{$d->id}}" {{ old('divisionName',$customer->division_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No Category found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="districtName">Division</label>
                                        <select class="form-control" name="districtName" id="districtName">
                                            <option value="">Select Country</option>
                                            @forelse($districts as $d)
                                                <option value="{{$d->id}}" {{ old('districtName',$customer->district_id)==$d->id?"selected":""}}> {{ $d->name}}</option>
                                            @empty
                                                <option value="">No Category found</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="postCode">Post Code</label>
                                        <input type="text" id="postCode" class="form-control" value="{{ old('postCode',$customer->post_code)}}" name="postCode">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" name="address" id="address" rows="2">{{ old('address',$customer->address)}}</textarea>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
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
