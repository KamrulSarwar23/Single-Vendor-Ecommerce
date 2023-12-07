<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\DeliveredOrderDataTable;
use App\DataTables\processedReadyShipOrderDataTable;
use App\DataTables\outForDeliveryOrderDataTable;
use App\DataTables\shippedOrderDataTable;
use App\DataTables\droppedOffOrderDataTable;
use App\DataTables\cancelOrderDataTable;
use App\DataTables\OrderDataTable;
use App\DataTables\PendingOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.index');
    }

    public function pendingOrder(PendingOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.pending-order');
    }

    public function processedReadyShipOrder(processedReadyShipOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.processed_and_ready_to_ship_order');
    }

    public function droppedOffOrder(droppedOffOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.dropped_off_order');
    }


    public function shippedOrder(shippedOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.shipped_order');
    }

    public function outForDeliveryOrder(outForDeliveryOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.out_for_delivery_order');
    }

    public function cancelOrder(cancelOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.cancel-order');
    }

    public function deliveredOrder(DeliveredOrderDataTable $dataTable)
    {
        return $dataTable->render('admin.order.delivered-order');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteOrder = Order::findOrFail($id);
        $deleteOrder->orderProduct()->delete();
        $deleteOrder->transaction()->delete();
        $deleteOrder->delete();
        return response(['status' => 'success', 'message' => 'Order deleted successfully']);
    }

    public function changeOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->order_status = $request->status;
        $order->save();
        return response(['status' => 'success', 'message' => 'Order Status updated successfully']);
    }

    public function changePaymentStatus(Request $request)
    {
        $payment_status = Order::findOrFail($request->id);
        $payment_status->payment_status = $request->status;
        $payment_status->save();
        return response(['status' => 'success', 'message' => 'Payment Status Updated successfully']);
    }
}
