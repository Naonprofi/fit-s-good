@extends('layouts.app')

@section('content') <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Here is your profile') }}</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $customer->custData->cust_name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $customer->custContact->cust_email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $customer->custContact->cust_phone_num ?? 'N/A' }}</p>
                        <p><strong>Gender:</strong> {{ $customer->custData->cust_gender ?? 'N/A' }}</p>
                        <p><strong>Age:</strong> {{ $customer->custData->cust_age ?? 'N/A' }}</p>
                        <hr>
                        <a href="{{ route('profile.edit') }}" class="btn btn-success">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection