@extends('partials.app')
@section('title', 'Profile')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Profile'])

<div class="dashboard-section pt-120 pb-120">
    <div class="container">
        <div class="row g-4">
            @include('layouts.sidebar', ['active' => 'profile', 'admin' => false])
            <div class="col-lg-9">
                <div class="tab-pane">
                    <div class="dashboard-profile">
                        <div class="owner">
                           <div class="image">
                              <img alt="image" src="{{ $user->avatar ?? get_random_avatar() }}">
                           </div>
                           <div class="content">
                              <h3>{{ $user->name }}</h3>
                              <p class="para">{{ $user->email }}</p>
                           </div>
                        </div>
                        <div class="form-wrapper">
                           <form action="{{ route('user.profile.handle') }}" method="POST">
                              @method('PUT')
                              @csrf
                              <div class="row">
                                 <div class="col-xl-6 col-lg-12 col-md-6">
                                    <x-input-field name="first_name" type="text" label="First Name" placeholder="Your first name" value="{{ $user->first_name }}"/>
                                 </div>
                                 <div class="col-xl-6 col-lg-12 col-md-6">
                                    <x-input-field name="last_name" type="text" label="Last Name" placeholder="Your last name" value="{{ $user->last_name }}"/>
                                 </div>
                                 <div class="col-xl-6 col-lg-12 col-md-6">
                                    <x-phone-selectable name="mobile" label="Phone" placeholder="Your phone number" value="{{ $user->mobile }}"/>
                                 </div>
                                 <div class="col-xl-6 col-lg-12 col-md-6">
                                    <x-input-field name="email" type="email" label="Email" placeholder="Your email address" value="{{ $user->email }}" :disabled="true" :readonly="true"/>
                                 </div>
                                 <div class="col-xl-6 col-lg-12 col-md-6">
                                    <x-input-field name="username" type="text" label="Username" placeholder="Your username" value="{{ $user->username }}" :disabled="true" :readonly="true"/>
                                 </div>
                                 <x-gender-selectable label="Gender" name="gender" :selected="$user->gender"/>
                                 <div class="col-12">
                                     <x-input-field name="address" type="text" label="Address" placeholder="Your address" value="{{ $user->address }}"/>
                                 </div>
                                 <x-countries-selectable :admin="false" has-labels="true"/>
                                 <div class="col-xl-6 col-lg-12 col-md-6">
                                    <x-input-field name="zip_code" type="text" label="Zip Code" placeholder="Your zip code" :required="false" value="{{ $user->zip_code }}"/>
                                 </div> 
                                 <div class="col-12">
                                    <x-input-field name="current_password" type="password" label="Current Password" placeholder="Enter Current password" :required="false"/>
                                    <x-input-field name="password" type="password" label="Change Password" placeholder="Create a password" :required="false"/>
                                 </div>
                                 <div class="col-12">
                                    <div class="button-group">
                                       <button type="submit" class="eg-btn profile-btn">Update Profile</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-metric-card />

@endsection