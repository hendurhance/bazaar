@extends('partials.app')
@section('title', 'Add Listing')
@section('description', 'Add your listing to the auction, and get the best price for your item.')
@section('content')

@include('layouts.breadcrumb', ['pageTitle' => 'Add Listing'])

<div class="pt-120 pb-120">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-10">
                <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s"
                    style="visibility: visible; animation-duration: 1.5s; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <form class="w-100" action="#" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-section">
                                <h4>Lisiting Information</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="title" type="text" label="Ad Title" placeholder="Enter Ad Title" />
                            </div>
                            <div class="col-md-12">
                                <x-textarea-field name="description" label="Ad Description" placeholder="Enter Description" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="price" type="number" label="Starting Price" placeholder="Enter Starting Price" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="start_date" type="datetime-local" label="Start Date" placeholder="Enter Start Date" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="end_date" type="datetime-local" label="End Date" placeholder="Enter End Date" />
                            </div>
                            <div class="form-section">
                                <h4>Category</h4>
                            </div>
                            <div class="col-md-6">
                                <x-input-field name="category" type="text" label="Category" placeholder="Enter Category" />
                            </div>
                            <div class="col-md-6">
                                <x-input-field name="sub_category" type="text" label="Sub Category" placeholder="Enter Sub Category" :required="false" />
                            </div>
                            <div class="form-section">
                                <h4>Images</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="image[]" type="file" label="Upload Image" placeholder="Upload Image" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="image[]" type="file" label="Upload Image" placeholder="Upload Image" />
                            </div>
                            {{-- add more images button --}}
                            <div class="col-md-12">
                                <button type="button" class="images-btn"><i class="bi bi-plus"></i> Add More Images</button>
                            </div>
                            <div class="form-section">
                                <h4>Video</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="video" type="url" label="Video URL" placeholder="Enter Video URL" />
                                <p class="text-muted">Please enter a valid video URL from YouTube or Vimeo, ex. https://www.youtube.com/watch?v=video_id </p>
                            </div>
                            <div class="form-section">
                                <h4>Location</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="location" type="text" label="Location" placeholder="Enter Country" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="state" type="text" label="State" placeholder="Enter State" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="city" type="text" label="City" placeholder="Enter City" />
                            </div>
                            <div class="form-section">
                                <h4>Seller Information</h4>
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_name" type="text" label="Seller Name" placeholder="Enter Seller Name" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_email" type="email" label="Seller Email" placeholder="Enter Seller Email" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_phone" type="tel" label="Seller Phone" placeholder="Enter Seller Phone" />
                            </div>
                            <div class="col-md-12">
                                <x-input-field name="seller_address" type="text" label="Seller Address" placeholder="Enter Seller Address" />
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
                        <p>By clicking the "create listing" button, you create a Bazaar account, and you agree to Bazaar's <a
                                href="#">Terms &amp; Conditions</a> &amp; <a href="#">Privacy Policy.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.metrics')

@endsection
@push('scripts')
<script>
    // Create a new input field for images
    function createNewInputField() {
        return `<div class="col-md-12">
                    <x-input-field name="image[]" type="file" label="Upload Image" placeholder="Upload Image" />
                </div>`;
    }

    // Add new input field for images
    function addNewInputField() {
        let newInputField = createNewInputField();
        let imagesBtn = document.querySelector('.images-btn');
        let newInputFieldElement = document.createElement('div');
        newInputFieldElement.innerHTML = newInputField;
        imagesBtn.parentNode.insertBefore(newInputFieldElement, imagesBtn);
    }

    // Add event listener to the button
    document.querySelector('.images-btn').addEventListener('click', addNewInputField);

</script>
@endpush