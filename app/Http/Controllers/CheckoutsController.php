<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\ShippingRequest;
use App\Order;
use App\Order_detail;
use App\Shipping;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class CheckoutsController extends Controller
{
    /**
     * show check out page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    function index(){

        if (Cart::instance('cart')->content()->count() > 0){
            return view('frontend.pages.check_out');
        }else{
            return redirect(route('cart.index'));
        }
    }


    /**
     * save shipping info into session
     *
     * @param ShippingRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function saveShippingInfo(ShippingRequest $request){

        if (Session::get('shipping_info')){
            Session::forget('shipping_info');
        }

        Session::push('shipping_info', $request->all());

        return redirect(route('payment'));
    }


    /**
     * show payment page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function payment(){
        return view('frontend.pages.payment');
    }

    /**
     * final order place
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function orderPlace(Request $request){

        //store shipping info
        $shipping_id = $this->storeShippingInfo();

        if ($shipping_id){

            //store order info
            $order_id = $this->storeOrder($shipping_id, $request->payment_method_id);

            //store order details info
            if($order_id){
                $order_details_id = $this->storeOrderDetails($order_id);
            }

            //if all ok
            if(isset($order_details_id)){

                Cart::destroy();
                return redirect('/')->with('success', 'Order placement successful, We contact with you as soon as possible.');

            }else{
                return back()->with('error', 'There is a problem, please try again');
            }

        }else{
            return back()->with('warning', 'There is a problem, Please try again');
        }

    }

    /**
     * store shipping info into database
     *
     * @return bool|mixed
     */
    function storeShippingInfo(){

        $shipping = new Shipping(Session::get('shipping_info')[0]);

        if ($shipping->save()){
            Session::forget('shipping_info');
            return $shipping->id;
        }
        return false;
    }


    /**
     * store order info into database
     *
     * @param $shipping_id
     * @param $payment_method_id
     * @return mixed
     */
    function storeOrder($shipping_id, $payment_method_id){

        $order_data = [];
        $order_data['user_id'] = Auth::user()->id;
        $order_data['shipping_id'] = $shipping_id;
        $order_data['payment_id'] = $payment_method_id;
        $order_data['order_total'] = Cart::instance('cart')->total();
        $order_data['status'] = 0;

        $save_order = Order::create($order_data);

        return $save_order->id;
    }


    /**
     * store order details data into database
     *
     * @param $order_id
     * @return mixed
     */
    function storeOrderDetails($order_id){

        foreach (Cart::instance('cart')->content() as $item){

            $order_details_data = [];
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $item->id;
            $order_details_data['product_name'] = $item->name;;
            $order_details_data['product_price'] = $item->price;
            $order_details_data['product_qty'] = $item->qty;

            $save = Order_detail::create($order_details_data);

            return $save->id;
        }
    }
}
