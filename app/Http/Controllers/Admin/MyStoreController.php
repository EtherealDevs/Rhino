<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MyStoreController extends Controller
{
    public function index()
    {
        // Ventas en los últimos 30 días
        $salesLast30Days = Order::where('order_status_id', 4)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->sum('total');

        // Ventas en los últimos 6 meses
        $salesLast6Months = Order::where('order_status_id', 4)
            ->whereDate('created_at', '>=', Carbon::now()->subMonths(6))
            ->sum('total');

        // Productos vendidos en total
        $totalProductsSold = Order::where('order_status_id', 4)
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->sum('order_details.amount'); // Cambia 'quantity' por 'amount'

        // Ganancias generadas
        $totalGanancias = Order::where('order_status_id', 4)->sum('total');

        // Usuarios logueados
        $loggedUsers = User::count();

        // Categorías de productos más vendidos
        $topCategories = OrderDetail::select('products.category_id', DB::raw('SUM(order_details.amount) as total_sold'))
            ->join('products', 'order_details.product_item_id', '=', 'products.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.order_status_id', 4)
            ->groupBy('products.category_id')
            ->orderBy('total_sold', 'desc')
            ->limit(4)
            ->get();

        $earningsByCategory = OrderDetail::select('products.category_id', DB::raw('SUM(order_details.amount * order_details.price) as total_earnings'))
            ->join('products', 'order_details.product_item_id', '=', 'products.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.order_status_id', 4)
            ->groupBy('products.category_id')
            ->orderBy('total_earnings', 'desc')
            ->limit(4)
            ->get();

        $categories = Category::whereIn('id', $earningsByCategory->pluck('category_id'))->get()->keyBy('id');

        $categories = Category::whereIn('id', $topCategories->pluck('category_id'))->get()->keyBy('id');

        $earningsByProduct = OrderDetail::select('products.id', 'products.name', DB::raw('SUM(order_details.amount * order_details.price) as total_earnings'))
            ->join('products', 'order_details.product_item_id', '=', 'products.id')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('orders.order_status_id', 4)
            ->groupBy('products.id', 'products.name')
            ->orderBy('total_earnings', 'desc')
            ->get();

        // Calcular la ganancia más alta para el cálculo de porcentaje
        $highestEarning = $earningsByProduct->isEmpty() ? 1 : $earningsByProduct->max('total_earnings');

        return view('admin.mystore.index', compact(
            'salesLast30Days',
            'salesLast6Months',
            'totalProductsSold',
            'totalGanancias',
            'topCategories',
            'earningsByCategory',
            'earningsByProduct',
            'highestEarning',
            'loggedUsers',
            'categories'
        ));
    }
}
