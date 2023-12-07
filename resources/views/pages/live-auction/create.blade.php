@extends('partials.app')
@section('title', 'Add Listing')
@section('description', 'Add your listing to the auction, and get the best price for your item.')
@section('content')

@include('layouts.breadcrumb', ['admin' => false, 'pageTitle' => 'Add Listing'])

<div class="pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    @guest('web')
                    <x-alert type="warning" icon="exclamation-triangle">
                        <p class="mb-0">You are posting as a guest. If you have an account, please <a class="fw-bold"
                                href="{{ route('user.login') }}">login</a> to have your listing associated with your account.</p>
                    </x-alert>
                    @endguest
                    <x-alert type="info" icon="info-circle" dismissible="true">
                        <p class="mb-0">Once you submit your listing, it will be reviewed by our team. Once approved, it will be
                            listed on the auction.</p>
                    </x-alert>
                    <form class="w-100" action="{{ route('add-listing.handle') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-section">
                                <h4>Lisiting Information</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="title" type="text" label="Ad Title" placeholder="Enter Ad Title" value="{{ old('title') }}" />
                            </div>
                            <div class="col-md-12">
                                <x-textarea-field name="description" label="Ad Description"
                                    placeholder="Enter Description" value="{{ old('description') }}" :admin="false" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="price" type="number" label="Starting Price"
                                    placeholder="Enter Starting Price" value="{{ old('price') }}" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="start_date" type="datetime-local" label="Start Date"
                                    placeholder="Enter Start Date" value="{{ old('start_date') }}" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="end_date" type="datetime-local" label="End Date"
                                    placeholder="Enter End Date" value="{{ old('end_date') }}" />
                            </div>
                            <div class="form-section">
                                <h4>Category</h4>
                            </div>
                            <x-category-selectable :admin="false" />
                            <div class="form-section">
                                <h4>Images</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="images[]" type="file" label="Upload Image"
                                    placeholder="Upload Image" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="images[]" type="file" label="Upload Image"
                                    placeholder="Upload Image" />
                            </div>
                            {{-- add more images button --}}
                            <div class="col-md-12">
                                <button type="button" class="images-btn"><i class="bi bi-plus"></i> Add More
                                    Images</button>
                            </div>
                            <div class="form-section">
                                <h4>Video</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="video_url" type="url" label="Video URL"
                                    placeholder="Enter Video URL" value="{{ old('video_url') }}" />
                                <p class="text-muted">Please enter a valid video URL from YouTube or Vimeo, ex.
                                    https://www.youtube.com/watch?v=video_id </p>
                            </div>
                            <div class="form-section">
                                <h4>Location</h4>
                            </div>
                            <x-countries-selectable :admin="false"/>
                            <div class="form-section">
                                <h4>Seller Information</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_name" type="text" label="Seller Name"
                                    placeholder="Enter Seller Name" :value="old('seller_name') ?? auth()->user()->name ?? '' " />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_email" type="email" label="Seller Email"
                                    placeholder="Enter Seller Email" :value="old('seller_email') ?? auth()->user()->email ?? ''" />
                            </div>
                            <x-phone-selectable name="seller_mobile" label="Seller Phone"
                                placeholder="Enter Seller Phone" :value="old('seller_mobile') ?? auth()->user()->mobile ?? ''" />
                            <div class="col-md-12">
                                <x-input-field name="seller_address" type="text" label="Seller Address"
                                    placeholder="Enter Seller Address" :value="old('seller_address') ?? auth()->user()->address ?? ''" />
                            </div>
                            <div class="col-md-12">
                                <x-agree-checkbox
                                    class="form-agreement form-inner d-flex justify-content-between flex-wrap" id="html"
                                    name="terms" label="I agree to the Terms & Policy" />
                            </div>
                        </div>
                        <button class="account-btn">Create Listing</button>
                    </form>
                    <div class="form-poicy-area">
                        <p>By clicking the "create listing" button, you create a Bazaar account, and you agree to
                            Bazaar's <a href="#">Terms &amp; Conditions</a> &amp; <a href="#">Privacy Policy.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<x-metric-card />

@endsection
@push('scripts')
<script>
    // Create a new input field for images
    function createNewInputField() {
        return `<div class="col-md-12">
                    <x-input-field name="images[]" type="file" label="Upload Image" placeholder="Upload Image" />
                </div>`;
    }

    // Add new input field for images
    function addNewInputField() {
        let newInputField = createNewInputField();
        let imagesBtn = document.querySelector('.images-btn');
        let newInputFieldElement = document.createElement('div');
        newInputFieldElement.innerHTML = newInputField;
        imagesBtn.parentNode.insertBefore(newInputFieldElement, imagesBtn);
        if (document.querySelectorAll('input[name="images[]"]').length == 5) {
            imagesBtn.style.display = 'none';
        }
    }

    // Add event listener to the button
    document.querySelector('.images-btn').addEventListener('click', addNewInputField);

</script>
@endpush