<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDatatable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(OrderDatatable $dataTable)
    {
        return $dataTable->render('order.index');
    }

    public function create()
    {
        return view('order.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'total_price'  => 'required',
            'shipping'     => 'required',
            'payment_type' => 'required',
            'order_status' => 'required',
        ]);
        $order = Order::create([
            'total_price'  => $request->total_price,
            'shipping'     => $request->shipping,
            'payment_type' => $request->payment_type,
            'order_status' => $request->order_status,
        ]);
        $order->user_id = Auth::user()->id;
        $order->save();
        return redirect()->route('order.index')->with('success', 'Order Created Successfully');


    }

    public function edit(Order $order)
    {
        return view('order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'total_price'  => 'required',
            'shipping'     => 'required',
            'payment_type' => 'required',
            'order_status' => 'required',
        ]);


        $order->total_price = $request->total_price;
        $order->shipping = $request->shipping;
        $order->payment_type = $request->payment_type;
        $order->order_status = $request->order_status;
        $order->save();
        return redirect()->route('order.index')->with('success', 'Order Updated Successfully');


    }

    public function delete(Request $request)
    {
        $order = Order::where('uuid', $request->uuid)->first();

        if (empty($order)) {
            return response()->json([
                'status'  => false,
                'data'    => '',
                'message' => 'Order not found!'
            ]);
        }

        $order->delete();

        return response()->json([
            'status'  => true,
            'data'    => $order,
            'message' => 'Order deleted successfully'
        ]);
    }

}
