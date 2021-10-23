@extends('myLayout.app')

@section('content')

<div class="row">
    <div class="col-md-6 offset-3">
        <div class="card ">
            <div class="card-header fs-3 text-center bg-dark text-white ">
                Customer Edit
            </div>
            <div class="card-body fs-4 ps-5 ms-5 ">
                <form action="{{ route('customer#update', $customer->customer_id)}}" method="post">

                    @if (Session::has('updateSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{Session::get('updateSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (Session::has('deleteSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{Session::get('deleteSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @csrf
                    <div class="my-3">
                        <label>Name</label> :
                        <input type="text" name="name" class="form-control" value="{{ old('name',$customer->name)}}">
                        @if ($errors->has('name'))
                        <small class="text-danger">{{ $errors->first('name')}}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email',$customer->email)}}">
                        @if ($errors->has('email'))
                        <small class="text-danger">{{ $errors->first('email')}}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>Address</label>
                        <textarea name="address" cols="30" rows="4"
                            class="form-control">{{ old('address',$customer->address)}}</textarea>
                        @if ($errors->has('address'))
                        <small class="text-danger">{{ $errors->first('address')}}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>Phone</label>
                        <input type="number" name="phoneNumber" class="form-control"
                            value="{{ old('phoneNumber',$customer->phone)}}">
                        @if ($errors->has('phoneNumber'))
                        <small class="text-danger">{{ $errors->first('phoneNumber')}}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            @if ($customer->gender==1)
                            <option value="empty">Choose options...</option>
                            <option value="1" selected>Male</option>
                            <option value="2">Female</option>
                            <option value="0">Others</option>
                            @elseif ($customer->gender==2)
                            <option value="empty">Choose options...</option>
                            <option value="1">Male</option>
                            <option value="2" selected>Female</option>
                            <option value="0">Others</option>
                            @elseif ($customer->gender==0)
                            <option value="empty">Choose options...</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="0" selected>Others</option>
                            @else
                            <option value="empty" selected>Choose options...</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                            <option value="0">Others</option>
                            @endif
                        </select>
                        @if ($errors->has('gender'))
                        <small class="text-danger">{{ $errors->first('gender')}}</small>
                        @endif
                    </div>
                    <div class="my-3">
                        <label>DOB</label>
                        <input type="date" name="dateOfBirth" class="form-control value="
                            {{ old('dateOfBirth',$customer->date_of_birth)}}">
                        @if ($errors->has('dateOfBirth'))
                        <small class="text-danger">{{ $errors->first('dateOfBirth')}}</small>
                        @endif
                    </div>
                    <div class="my-3 float-end">
                        <input type="submit" value="Update" class="btn bg-danger text-white">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="{{ route('customer#list') }}"><button class="btn btn-sm bg-dark text-white">Back</button></a>
            </div>
        </div>
    </div>
</div>


@endsection