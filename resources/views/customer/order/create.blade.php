@extends('customer.master')

@section('content')

    <div class="lg:mx-5 ">
        <div class="container mx-auto mt-4 p-2 px-5 md:p-6 bg-orange-50 rounded-lg shadow-md max-w-full">
            <h5 class="text-3xl font-bold text-center text-orange-600 mb-4">Create Order</h5>

            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-2 md:space-y-4">
                @csrf

                @if (session('success'))
                    <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md shadow">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger bg-red-100 text-red-800 p-4 rounded-md shadow">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Customer ID -->
                <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">

                <!-- Order Items -->
                <div id="orderItems">
                    <div class="order-item p-4 border border-gray-300 rounded-lg bg-gray-50 shadow-sm mb-4">
                        <p class="text-lg font-semibold text-orange-600 mb-1">Item 1</p>

                        <div class="grid grid-cols-1 gap-1 md:gap-2 mb-2">
                            <input type="text"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][product_name]" placeholder="Product Name" required>

                            <input type="url"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][product_link]" placeholder="Product Link">

                            <input type="text"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][size]" placeholder="Size">

                            <input type="number"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][quantity]" placeholder="Quantity">

                            <input type="number"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][price_inr]" placeholder="Price (INR)">

                            <input type="number"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][price_bdt]" placeholder="Price (BDT)">

                            <input type="text"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][note]" placeholder="Note">

                            <input type="file"
                                class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200"
                                name="items[0][files][]" multiple>
                        </div>

                        <!-- Delete Button -->
                        <button type="button"
                            class="deleteItem bg-red-500 text-white font-semibold py-1 px-2 rounded-lg mt-2 hover:bg-red-600 transition">X</button>
                    </div>
                </div>

                <div class="flex justify-between mb-2">
                    <button type="button" id="addItem"
                        class="bg-orange-500 text-white font-semibold py-2 px-4 md:px-6 rounded-lg shadow hover:bg-orange-600 transition">+
                    </button>
                    <button type="submit"
                        class="bg-orange-600 text-white font-semibold py-2 px-4 md:px-6 rounded-lg shadow hover:bg-orange-700 transition">Create
                        Order</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('addItem').addEventListener('click', function() {
            const orderItems = document.getElementById('orderItems');
            const itemCount = orderItems.getElementsByClassName('order-item').length;

            const newItem = `
            <div class="order-item p-4 border border-gray-300 rounded-lg bg-gray-50 shadow-sm mb-4">
                <p class="text-lg font-semibold text-orange-600 mb-2">Item ${itemCount + 1}</p>
                <div class="grid grid-cols-1 gap-1 md:gap-2">
                    <input type="text" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][product_name]" placeholder="Product Name" required>

                    <input type="url" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][product_link]" placeholder="Product Link" required>

                    <input type="text" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][size]" placeholder="Size" required>

                    <input type="number" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][quantity]" placeholder="Quantity" required>

                    <input type="number" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][price_inr]" placeholder="Price (INR)" required>

                    <input type="number" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][price_bdt]" placeholder="Price (BDT)" required>

                    <input type="text" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][note]" placeholder="Note">

                    <input type="file" class="form-control block w-full border rounded-lg p-2 focus:outline-none focus:ring focus:ring-orange-200" name="items[${itemCount}][files][]" multiple>
                </div>

                <!-- Delete Button -->
                <button type="button" class="deleteItem bg-red-500 text-white font-semibold py-1 px-2 rounded-lg mt-2 hover:bg-red-600 transition">Delete</button>
            </div>
        `;
            orderItems.insertAdjacentHTML('beforeend', newItem);
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('deleteItem')) {
                event.target.closest('.order-item').remove();
            }
        });
    </script>
@endsection
