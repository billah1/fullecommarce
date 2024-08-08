<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Logo;
use App\Models\Order;
use App\Models\OrderedProduct;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(): View|Application|Factory
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $previousMonth = Carbon::now()->subMonth()->month;
        $previousYear = Carbon::now()->subMonth()->year;

        $currentMonthTotal = Order::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total_charge');

        $previousMonthTotal = Order::whereMonth('created_at', $previousMonth)
            ->whereYear('created_at', $previousYear)
            ->sum('total_charge');
        $itemSale = Cart::whereIn('id', OrderedProduct::pluck('cart_id'))
            ->sum('quantity');

        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::whereIs_admin(false)->count();

        return view('Admin.pages.dashboard', ['title' => 'Dashboard',
            'itemSale' => $itemSale,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'currentMonthTotal' => $currentMonthTotal,
            'previousMonthTotal' => $previousMonthTotal]);
    }

    public function getMonthlySalesData(): JsonResponse
    {
        $salesData = Order::select(
            DB::raw('sum(total_charge) as sums'),
            DB::raw("DATE_FORMAT(created_at, '%m') as monthKey")
        )
            ->groupBy('monthKey')
            ->orderBy('monthKey', 'ASC')
            ->get();

        $months = ['01' => 0, '02' => 0, '03' => 0, '04' => 0, '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0, '10' => 0, '11' => 0, '12' => 0];
        foreach ($salesData as $data) {
            $months[$data->monthKey] = (float) $data->sums;
        }

        return response()->json([
            'labels' => array_keys($months),
            'data' => array_values($months),
        ]);
    }

    public function getUniqueUserVisits(): JsonResponse
    {
        $visits = DB::table('visits')
            ->select(DB::raw('COUNT(DISTINCT user_id) as unique_visits'), DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"))
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $months = $visits->pluck('month')->toArray();
        $uniqueVisits = $visits->pluck('unique_visits')->toArray();

        return response()->json([
            'labels' => $months,
            'data' => $uniqueVisits,
        ]);
    }
}
