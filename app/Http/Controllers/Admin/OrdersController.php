<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = order::orderBy('id', 'desc')->with('orderDetails.product.brand', 'orderDetails.product.category', 'user', 'payment', 'shipping')
                        ->get();

        return view('admin.order.index', compact('orders'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('orderDetails', 'orderDetails.product.brand', 'orderDetails.product.category', 'user', 'shipping')
            ->where('id', $id)
            ->first();

        if ($order->seen == false){
            $this->changeSeenStatus($id);
        }

        return view('admin.order.view', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
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
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        if($order->delete()){
            return back()->with('success', 'Order delete successfully');
        }else{
            return back()->with('error', 'Order could not be delete');
        }
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    function changeStatus(Request $request, Order $order){

        $request['status'] = ($request['old'] == 1)?0:1;
        $update = $order->update($request->all());

        if ($update){
            return back()->with('success', 'Order status change successfully');
        }else{
            return back()->with('error', 'Order status could not be change');
        }
    }

    /**
     * Change seen status
     *
     * @param $id
     */
    function changeSeenStatus($id){

        $order = Order::where('id', $id)->first();
        $order->update(['seen' => 1]);
    }
}
