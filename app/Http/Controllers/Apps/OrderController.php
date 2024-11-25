<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Models\District;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItems;
use App\DataTables\OrderDataTable;
use Illuminate\Support\Facades\Cache;
use Auth;

class OrderController extends Controller
{
    private $cacheKey;

    public function __construct()
    {
        $this->cacheKey = config('dbcachekey.order');
        // set middlware for permession
        $this->middleware('can:all order')->only(['index', 'show']);
    }

    // order list show in order table
    public function index(OrderDataTable $dataTable){
        return $dataTable->render('pages.apps.order.list');
    }
    
    // add new order page
    public function create(){
        $ShippingMethods = ShippingMethod::orderBy('base_id', 'desc')->where('status', 1)->get();
        $districts = District::orderBy('name', 'asc')->where('status',1)->get();
        return view('pages.apps.order.create', compact('ShippingMethods', 'districts'));
    }

    // store new order
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'required|numeric|min:11',
            'payment_type' => 'required',
            'shipping_method' => 'required',
            'order_date' => 'required',
            'district_id' => 'required',
            'shipping_address' => 'required',
            'shipping_cost' => 'required',
        ],[
            'shipping_cost.required' => 'Shipping cost field is required',
            'shipping_method.required' => 'Please select a shipping method',
            'order_date.required' => 'Please select a date',
            'payment_type.required' => 'Please select a payment method type',
            'district_id.required' => 'Please select a city',
        ]);
    
        // Check if there are selected products in session
        $selectedProducts = session()->get('selectedProducts', []);
        $quantities = session()->get('quantities', []);
        if (empty($selectedProducts)) {
            return response()->json([
                'error' => 'No products selected for the order.'
            ], 400);
        }

        $grandTotal = session()->get('totalCost', 0);
    
        // Create the order
        $order = Order::create([
            'user_id' => Auth::id() ?? null,
            'user_type' => 'author',
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'payment_type' => $request->payment_type,
            'shipping_method' => $request->shipping_method,
            'order_date' => $request->order_date,
            'district_id' => $request->district_id,
            'shipping_address' => $request->shipping_address,
            'shipping_cost' => $request->shipping_cost,
            'note' => $request->note,

            'grand_total' => $grandTotal + $request->shipping_cost
        ]);
    
        // Loop through session data and save each product as order items
        foreach ($selectedProducts as $productId) {
            $quantity = $quantities[$productId] ?? 1;
        
            // Fetch the latest product information
            $product = Product::find($productId);
            if ($product) {
                // Check stock availability
                if ($product->quantity >= $quantity) {
                    // Determine price based on discount option
                    $price = ($product->discount_option != 1) ? $product->offer_price : $product->base_price;
                    $product->update(['quantity' => $product->quantity - $quantity]);
        
                    // Create the order item
                    $order->orderItems()->create([
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'price' => $price,
                    ]);
                } 
            } 
        }
        
        // Clear session data after order creation
        session()->forget(['selectedProducts', 'quantities', 'totalQuantity', 'totalCost']);
        $this->refreshCache();
        return response()->json([
            'message' => 'Order has been successfully created!',
            'order_id' => $order->id,
        ], 200);
    }

    // checkout page
    public function checkout()
    {
        // Fetch cart data from the session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop');
        }

        // Pass the cart data to the checkout view
        return view('frontend.pages.order.checkout', ['cart' => $cart]);
    }

    
    // edit the order
    public function edit(int $id){
       
    }

    // show the order details
    public function show(int $id){
        $order = Order::with([

        ])
        ->findOrFail($id);
        return view('pages.apps.order.order-details', compact('order'));
    }

    // order invoice genarate
    public function order_invoice(int $id){
        $order = Order::find($id);
        return view('pages.apps.order.order-invoice', compact('order'));
    }

     // Refresh the cache
     private function refreshCache()
     {
         Cache::forget($this->cacheKey);
         Cache::rememberForever($this->cacheKey, function () {
             return Order::orderBy('id', 'desc')->get();
         });
     }
}
