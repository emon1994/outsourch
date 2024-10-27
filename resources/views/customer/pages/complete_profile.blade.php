@extends('customer.master')

@section('content')
    <div class="p-5">
        <div class="card card-primary p-5">
            <div class="card-header" style="background-color: orange">
                <h3 class="card-title">Add Additional Information</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            @php
                $customer = Auth::guard('customer')->user();
                $customer_id = $customer ? $customer->id : null;
                // dd($customer_id);
            @endphp
            <form action="{{ route('profile.additional', ['customer_id' => $customer_id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" name="country" class="form-control" id="exampleInputEmail1"
                            placeholder="Enter Country">
                    </div>
                    <div class="form-group">
                        <label for="fb_id_linkk">Facebook Id Link</label>
                        <input type="text" name="fb_id_link" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter facebook link">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter date Of Birth">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter your address">
                    </div>
                    <div class="form-group">
                        <label for="dress_size">Dress Size</label>
                        <input type="text" name="dress_size" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter Your Dress Size">
                    </div>
                    <div class="form-group">
                        <label for="shoe_size">Shoe Size</label>
                        <input type="text" name="shoe_size" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter Your Shoe Size">
                    </div>

                  
                    {{-- <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" name="status" class="form-control" id="exampleInputPassword1"
                            placeholder="your status">
                    </div> --}}
                    <div class="form-group">
                        <label for="review">Review</label>
                        <input type="file" name="review" class="form-control" id="exampleInputPassword1"
                            placeholder="Add a review">
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" style="background-color: orange">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
