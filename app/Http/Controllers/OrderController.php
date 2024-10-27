<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemFile;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const INR_TO_BDT_CONVERSION_RATE = 1.16; // Define conversion rate here

    public function create()
    {
        return view('customer.order.create');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'customer_id' => 'required|string|max:255',
            'items.*.product_name' => 'required|string|max:255',
            'items.*.product_link' => 'required|url',
            'items.*.size' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price_inr' => 'required|numeric|min:0',
            'items.*.price_bdt' => 'required|numeric|min:0',
            'items.*.note' => 'nullable|string|max:500',
            'items.*.files.*' => 'nullable|file|mimes:jpg,png,pdf,webp|max:2048',
        ]);
    
        // Create the order
        $order = Order::create([
            'customer_id' => $validatedData['customer_id'],
            // Any other order fields can go here
        ]);
    
        // Process each order item
        foreach ($validatedData['items'] as $itemData) {
            // Create the order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $itemData['product_name'],
                'product_link' => $itemData['product_link'],
                'size' => $itemData['size'],
                'quantity' => $itemData['quantity'],
                'price_inr' => $itemData['price_inr'],
                'price_bdt' => $itemData['price_bdt'],
                'note' => $itemData['note'],
                // No need to store 'files' here
            ]);
    
            // Handle file uploads
            if (isset($itemData['files'])) {
                foreach ($itemData['files'] as $uploadedFile) {
                    // Store file in storage/app/public/files
                    $path = $uploadedFile->store('public/files');
    
                    // Create a new OrderItemFile instance
                    $orderItemFile = new OrderItemFile();
                    $orderItemFile->file_path = $path; // Store the file path
                    $orderItemFile->order_item_id = $orderItem->id; // Associate with the OrderItem
                    $orderItemFile->save(); // Save the OrderItemFile model
                }
            }
        }
    
        // Redirect or return response
        return redirect()->back()->with('success', 'Order created successfully!');
    }
    

    // Method to update individual item status
  
}
