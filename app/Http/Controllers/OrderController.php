<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Plate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $categories = Category::with('products')->get();
            $plates = Plate::with('products')->get();

            return view('layouts/content', ['categories' => $categories, 'plates' => $plates]);
        }

        public function list()
        {
            $orders = Order::all();

            return view('layouts/odrers/list', ['orders' => $orders]);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {

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
            $order = Order::find($id);
            if(empty(session()->get('cart')))
            {
                $items = json_decode($order->order, true);
                session()->put('cart', $items);
            }
            $categories = Category::with('products')->get();
            $plates = Plate::with('products')->get();
            return view('layouts/odrers/edit', ['order' => $order, 'categories' => $categories, 'plates' => $plates]);
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
            $order = Order::find($id);
            $items = session()->get('cart');
            $order->customer_name = $request->customer_name;
            $order->customer_tel = $request->customer_tel;
            $order->order = json_encode($items);
            $order->delivery = $request->delivery;
            $order->comments = $request->comments;
            $order->save();
            return redirect()->back();
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

        public function customer()
        {
            return view('layouts/odrers/customer');
        }

        public function addCustomer(Request $request)
        {

            $customer = [
                "customer_name" => $request->customer_name,
                "customer_tel" => $request->customer_tel,
                "customer_email" => $request->customer_email,
                "delivery" => $request->delivery,
                "comments" => $request->comments
            ];
            session()->put('customer', $customer);

            return redirect('/order');
        }

        public function saveOrder(Request $request)
        {
            $items = session()->get('cart');
            $customer = session()->get('customer');
            $total = session()->get('total');


            Order::create([
                'date' => date('YmdHis'),
                'user_id' => '1',
                'customer_name' => $customer['customer_name'],
                'customer_tel' => $customer['customer_tel'],
                'order' => json_encode($items),
                'delivery' => $customer['delivery'],
                'total' => $request->total,
//                'comments' => $customer['comments'],
                'comments' => 'testowy',
                'status' => 1,
            ]);


            session()->flush();
//            Session::flash('succes', 'Successfully created shark!');

//            return Redirect::to('/');
            return redirect('/order');
        }
}
