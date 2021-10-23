@extends('myLayout.app')

@section('content')

<div class="row">
    <div class="col-md-6 offset-3">
        <div class="card ">
            <div class="card-header fs-3 text-center ">
                Customer Data
            </div>
            <div class="card-body fs-4 ps-5 ms-5 ">
                <div class="my-3">
                    <label>ID</label> : <label>{{ $customer[0]['renters_id'] }}</label>
                </div>
                <div class="my-3">
                    <label>Name</label> : <label>{{$customer[0]['name']}}</label>
                </div>
                <div class="my-3">
                    <label>Email</label> : <label>{{$customer[0]['email']}}</label>
                </div>
                <div class="my-3">
                    <label>Address</label> : <label>{{$customer[0]['address']}}</label>
                </div>
                <div class="my-3">
                    <label>Phone</label> : <label>{{$customer[0]['phone']}}</label>
                </div>
                <div class="my-3">
                    <label>Gender</label> :
                    <label>
                        @if ($customer[0]['gender']==1)
                        Male
                        @elseif ($customer[0]['gender']==2)
                        Female
                        @elseif ($customer[0]['gender']==0)
                        Other
                        @endif
                    </label>
                </div>
                <div class="my-3">
                    <label>DOB</label> : <label>{{$customer[0]['date_of_birth']}}</label>
                </div>
                <div class="card-footer">
                    <a href="{{ route('customer#list') }}"><button
                            class="btn btn-sm bg-dark text-white">Back</button></a>
                </div>
            </div>
        </div>
    </div>
    @endsection