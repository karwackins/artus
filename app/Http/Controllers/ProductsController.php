<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Plate;
use App\Plate_item;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->flush();
        dd(session()->get('cart'));
        $categories = Category::with('products')->get();
        $plates = Plate::with('products')->get();


            return view('layouts/content', ['categories.csv' => $categories, 'plates' => $plates]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart');

        if($request->plate == 1)
        {

            $plate = Plate::with('products')->where('id', $request->plate_id)->get();
            foreach ($plate[0]->products as $product)
            {
                $item = Plate_item::where('plate_id', $request->plate_id)->where('product_id', $product->id)->first();
                $cart[$product->id] = [
                    "id" => $product->id,
                    "nazwa" => $product->nazwa,
                    "quantity" => $item['ilosc'],
                    "cena" => $product->cena,
                    "jm" => $product->jm,
                    "wybor" => $item['wybor'],
                ];
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Patera dodana do zamówienia');
        }

            $id = $request->product_id;
            $product = Product::find($id);

            if(!$product) {

                abort(404);

            }


            // if cart is empty then this the first product
            if(!$cart) {

                $cart = [
                    $id => [
                        "id" => $product->id,
                        "nazwa" => $product->nazwa,
                        "quantity" => $request->quantity,
                        "jm" => $request->jm,
                        "cena" => $product->cena*$request->quantity,
                        "wybor" => $product->wybor,
                    ]
                ];

                session()->put('cart', $cart);

                return redirect()->back()->with('success', $product->nazwa. ' dodane do zamowienia');
            }



        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity'] = $request->quantity;

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id" => $product->id,
            "nazwa" => $product->nazwa,
            "quantity" => $request->quantity,
            "jm" => $request->jm,
            "wybor" => $product->wybor,
            "cena" => $product->cena*$request->quantity,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function editCart()
    {
        return view('layouts/edit');
    }

    public function updateCart()
    {
        $cart = session()->get('cart');
        $cart['edit'] = 0;
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back()->with('success', 'Product usuniety');
    }
}
