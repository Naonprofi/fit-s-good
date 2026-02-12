@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('customer.update', ['customer' => $customer->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label> <input type="text" class="form-control" id="cust_name"
                    name="cust_name" value="{{ old('cust_name', $customer->custData->cust_name ?? '') }}" required>
            </div>
            <div class="mb-3"> <label for="email" class="form-label">Email</label> <input type="email" class="form-control"
                    id="cust_email" name="cust_email"
                    value="{{ old('cust_email', $customer->custContact->cust_email ?? '') }}" required> </div>
            <div class="mb-3"> <label for="phone" class="form-label">Phone</label> <input type="text" class="form-control"
                    id="cust_phone_num" name="cust_phone_num"
                    value="{{ old('cust_phone_num', $customer->custContact->cust_phone_num ?? '') }}" required> </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="cust_gender" id="cust_gender" class="form-control">
                    @php $currentGender = old('cust_gender', $customer->custData->cust_gender ?? ''); @endphp
                    <option value="" disabled {{ $currentGender == '' ? 'selected' : '' }}>Choose your gender...</option>
                    <option value="male" {{ $currentGender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $currentGender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $currentGender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="mb-3"> <label for="age" class="form-label">Age</label> <input type="text" class="form-control"
                    id="cust_age" name="cust_age" value="{{ old('cust_age', $customer->custData->cust_age ?? '') }}"
                    required> </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
@endsection