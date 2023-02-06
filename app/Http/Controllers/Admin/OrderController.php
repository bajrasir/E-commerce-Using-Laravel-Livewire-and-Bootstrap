<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMailable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at',$todayDate)->paginate(10);

       $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date !=null, function($query) use($request)
        {
           return $query->whereDate('created_at',$request->date);
        }, function($query) use($todayDate)
        {
            $query->whereDate('created_at',$todayDate);
        })
        ->when($request->status !=null, function($query) use($request)
        {
           return $query->where('status_message',$request->status);
        })
        ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    public function show(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if($order)
        {
            return view('admin.orders.view', compact('order'));
        }
        else
        {
            return redirect('admin/orders')->with('message', 'Order Id Not Found');
        }

    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->first();
        if($order)
        {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect('admin/orders/'.$orderId)->with('message', 'Order Status Updated');
        }
        else
        {
            return redirect('admin/orders/'.$orderId)->with('message', 'Order Id Not Found');
        }
    }
    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }
    public function generateInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);

        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);
$todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $orderId)
    {
        try
        {
            $order = Order::findOrFail($orderId);
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
            return redirect('admin/orders/'.$order->id)->with('message', 'Invoice Mail Has Been sent to ' . $order->email);

        }
        catch(\Exception $e)
        {
            return redirect('admin/orders/'.$order->id)->with('message', 'Something Went Wrong');

        }

    }
}
