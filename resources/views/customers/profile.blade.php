@extends('layouts.app')

@section('content') <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $customer->custData->cust_name ?? 'N/A' }}</p>
                        <p><strong>Email:</strong> {{ $customer->custContact->cust_email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $customer->custContact->cust_phone_num ?? 'N/A' }}</p>
                        <p><strong>Gender:</strong> {{ $customer->custData->cust_gender ?? 'N/A' }}</p>
                        <p><strong>Age:</strong> {{ $customer->custData->cust_age ?? 'N/A' }}</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-success">Adatok frissítése</a>
                        <!-- Add more profile information as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection