<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\order;
use Illuminate\Support\Facades\DB;
class ProductsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $products = Product::all();
        return view('shopping.products', compact('products'));
    }
    public function cart()
    {
        return view('shopping.cart');
    }
    public function addToCart($id)
    {
        $product = Product::find($id);

        if(!$product) {

            abort(404);

        }

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                    $id => [
                        "title" => $product->title,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image" => $product->image
                    ]
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "title" => $product->title,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];

        session()->put('cart', $cart);
;
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Product removed successfully');
        }
    }
    public function order(Request $request)
    {
        $cart = session()->get('cart');
        if($cart)
        {
            foreach($cart as $key=>$value)
            {
                $order = new Order;
                $order->product_id = $key;
                $order->user_id =  auth()->user()->id;
                $order->quantity = $value['quantity'];
                $order->price = $value['quantity']*$value['price'];
                $order->save();
                unset($cart[$key]);
    
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success','Your order has been placed successfully.');
        }
        else
        {
            return redirect()->back()->with('error','Please add item into Cart.');

        }

    }
    public function orderlist()
    {
        $orders = Order::select(DB::raw('orders.price,quantity,users.name as username, products.title as productname,orders.created_at'))
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->paginate(5);
        return view('order',[
            'orderlist' => $orders,
          ]);
    }
    public function myorders()
    {
        $orders = Order::select(DB::raw('orders.price,quantity,users.name as username, products.title as productname,orders.created_at'))
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->Where('user_id','=',auth()->user()->id)
        ->paginate(5);
        return view('myorders',[
            'orderlist' => $orders,
          ]);
    }
}
