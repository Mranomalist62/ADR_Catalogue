<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        // Get cart items from session (or you can use localStorage in frontend)
        $cartItems = session('cart', []);
        
        // If cart is empty, create sample cart items for demonstration
        if (empty($cartItems)) {
            // For demonstration purposes, create sample cart items
            // In production, you might want to redirect to home with an error message
            $sampleProducts = [
                1 => ['quantity' => 2],
                2 => ['quantity' => 1],
                3 => ['quantity' => 3]
            ];
            session(['cart' => $sampleProducts]);
            $cartItems = $sampleProducts;
        }
        
        // Get product details for cart items
        $products = [];
        $total = 0;
        
        foreach ($cartItems as $itemId => $item) {
            $product = Product::find($itemId);
            if ($product) {
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;
                
                $products[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $subtotal
                ];
            }
        }
        
        // If still no products found, create dummy data for demonstration
        if (empty($products)) {
            $products = [
                [
                    'id' => 1,
                    'name' => 'Produk Contoh 1',
                    'price' => 150000,
                    'quantity' => 2,
                    'subtotal' => 300000
                ],
                [
                    'id' => 2,
                    'name' => 'Produk Contoh 2',
                    'price' => 250000,
                    'quantity' => 1,
                    'subtotal' => 250000
                ]
            ];
            $total = 550000;
        }
        
        return view('checkout', compact('products', 'total'));
    }
    
    /**
     * Process the checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'payment_method' => 'required|string|in:transfer,credit_card,ewallet,cod'
        ]);
        
        // Get cart items from session
        $cartItems = session('cart', []);
        
        // If cart is empty, redirect back with error
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong');
        }
        
        // Create order
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address . ', ' . $request->city . ', ' . $request->province . ' ' . $request->postal_code,
            'total' => 0, // Will be calculated below
            'status' => 'pending'
        ]);
        
        // Create order items and calculate total
        $total = 0;
        foreach ($cartItems as $itemId => $item) {
            $product = Product::find($itemId);
            if ($product) {
                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal
                ]);
            }
        }
        
        // Update order total
        $order->total = $total;
        $order->save();
        
        // Create payment record
        Payment::create([
            'order_id' => $order->id,
            'method' => $request->payment_method,
            'amount' => $total,
            'status' => 'pending'
        ]);
        
        // Clear cart
        session()->forget('cart');
        
        // Redirect to order confirmation
        return redirect()->route('order.confirmation', $order->id)->with('success', 'Pesanan Anda telah berhasil dibuat!');
    }
    
    /**
     * Display order confirmation page
     */
    public function confirmation($orderId)
    {
        $order = Order::with(['items.product', 'payment'])->findOrFail($orderId);
        
        // Check if order belongs to current user
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        return view('order_confirmation', compact('order'));
    }
}