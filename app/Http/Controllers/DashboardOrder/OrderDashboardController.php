<?php

namespace App\Http\Controllers\DashboardOrder;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderDashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'orderItems.product.translations.language')->paginate(10);
        return view('admin.order.order', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,shipping,delivered'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');
    }

    public function viewOrder($id)
    {
        $order = Order::with('user', 'orderItems.product.translations.language')->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
    }

    public function search(Request $request)
{
    $search = $request->input('search');

    $orders = Order::with('user', 'orderItems.product.translations.language')
                ->when($search, function ($query, $search) {
                    return $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                              ->orWhere('phone', 'like', '%' . $search . '%');
                    })->orWhere('total_price', 'like', '%' . $search . '%')
                      ->orWhere('status', 'like', '%' . $search . '%');
                })
                ->paginate(10);

    return view('admin.order.order', compact('orders', 'search'));
}

}
