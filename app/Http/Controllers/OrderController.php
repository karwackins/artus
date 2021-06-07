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
            $orders = Order::all()->where('status', '=', 1);

            return view('layouts/odrers/list', ['orders' => $orders]);
        }

    public function listHistory()
    {
        $orders = Order::all()->where('status', '=', 0);

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

            if(isset($request->customer))
            {
                $order->customer_name = $request->customer_name;
                $order->customer_tel = $request->customer_tel;
                $order->customer_tel = $request->customer_email;
                $order->delivery = $request->delivery;
                $order->comments = $request->comments;
            }else
            {
                $items = session()->get('cart');
//                $total = session()->get('total');
                $order->order = json_encode($items);
                $order->total = $request->total;
            }
            $order->save();
            session()->flush();
            return redirect('/orders');
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus($id)
    {
        $order = Order::find($id);
        $order->status = 0;
        $order->save();
        session()->flush();
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
            $order = Order::find($id);
            $order->delete();
            session()->flush();
            return redirect('/orders');
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

    public function editCustomer($id, Request $request)
    {
        $order = Order::find($id);
        $customer = [
            "order_id" => $order->id,
            "customer_name" => $order->customer_name,
            "customer_tel" => $order->customer_tel,
            "customer_email" => $order->customer_email,
            "delivery" => $order->delivery,
            "comments" => $order->comments
        ];
        return view('layouts/odrers/edit_customer', ['customer' => $customer]);
    }

        public function saveOrder(Request $request)
        {
            $items = session()->get('cart');
            $customer = session()->get('customer');

            Order::create([
                'date' => date('YmdHis'),
                'user_id' => '1',
                'customer_name' => $customer['customer_name'],
                'customer_tel' => $customer['customer_tel'],
                'customer_email' => $customer['customer_email'],
                'order' => json_encode($items),
                'delivery' => $customer['delivery'],
                'total' => $request->total,
                'comments' => $customer['comments'],
                'status' => 1,
            ]);

            session()->flush();
            return redirect('/orders');

        }
}
