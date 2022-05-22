<?php

namespace App\Http\Controllers\ReportsController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Orders;
use App\Models\OrdersBuy;
use App\Models\OrdersHalk;
use App\Models\DetailsOrder;
use App\Models\Exchange;
use App\Models\Supply;

class CustomerController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    // Reports
    public function Customer_Report_view(Request $request){
        $customers = Customer::get()->all();
        return view('Reports.customers',compact('customers'));
    }

    public function customer_report(Request $request){
        $orders_seales = '';
        $orders_buy    = '';
        $halk          = '';
        $exchange      = '';
        $supply        = '';
        $customer      = '';

        $customer = Customer::limit(1)->where(['id'=>$request->customer])->first();

        // Search For Exchange
        if($request->date_from == 0 || $request->date_to == 0)
        {
            $supply = Supply::where(['customer'=>$request->customer])->orderBy('id', 'desc')->get();
        }else{
            $supply = Supply::where(['customer'=>$request->customer])
            ->whereBetween('date', array($request->date_from, $request->date_to))
            ->orderBy('id', 'desc')->get();
        }
        // Search For Exchange
        if($request->date_from == 0 || $request->date_to == 0)
        {
            $exchange = Exchange::where(['customer'=>$request->customer])->orderBy('id', 'desc')->get();
        }else{
            $exchange = Exchange::where(['customer'=>$request->customer])
            ->whereBetween('date', array($request->date_from, $request->date_to))
            ->orderBy('id', 'desc')->get();
        }

        // Search For Sales
        if($request->date_from == 0 || $request->date_to == 0)
        {
            $orders_seales = Orders::where(['customer'=>$request->customer])->orderBy('id', 'desc')->get();
        }else{
            $orders_seales = Orders::where(['customer'=>$request->customer])
            ->whereBetween('date', array($request->date_from, $request->date_to))
            ->orderBy('id', 'desc')->get();
        }
        // Search For Buy
        if($request->date_from == 0 || $request->date_to == 0)
        {
            $orders_buy = OrdersBuy::where(['customer'=>$request->customer])->orderBy('id', 'desc')->get();
        }else{
            $orders_buy = OrdersBuy::where(['customer'=>$request->customer])
            ->whereBetween('date', array($request->date_from, $request->date_to))
            ->orderBy('id', 'desc')->get();
        }

        // Search For Halk
        if($request->date_from == 0 || $request->date_to == 0)
        {
            $halk = OrdersHalk::where(['customer'=>$request->customer])->orderBy('id', 'desc')->get();
        }else{
            $halk = OrdersHalk::where(['customer'=>$request->customer])
            ->whereBetween('date', array($request->date_from, $request->date_to))
            ->orderBy('id', 'desc')->get();
        }

        return response()->json([
            'sales'   =>$orders_seales,
            'buy'     =>$orders_buy,
            'halk'    =>$halk,
            'Exchange'=>$exchange,
            'supply'  => $supply,
            'customer' =>$customer
        ]);
    }
}
