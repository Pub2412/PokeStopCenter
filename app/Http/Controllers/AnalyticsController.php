<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect('/shop')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    /**
     * Show analytics dashboard
     */
    public function index()
    {
        return $this->getAnalyticsData(request());
    }

    public function getAnalyticsData(Request $request)
    {
        $startDateInput = $request->get('start_date') ?: date('Y-m-d', strtotime('-12 months'));
        $endDateInput = $request->get('end_date') ?: date('Y-m-d');

        $startDate = Carbon::parse($startDateInput)->startOfDay();
        $endDate = Carbon::parse($endDateInput)->endOfDay();

        // Yearly Sales Data (Bar Chart)
        $yearlySalesData = $this->getYearlySalesData($startDate, $endDate);

        // Sales within selected date range (Bar Chart)
        $salesByDateData = $this->getSalesByDateRangeData($startDate, $endDate);
        
        // Product Sales Distribution (Pie Chart)
        $productSalesData = $this->getSalesByProduct($startDate, $endDate);

        // Summary Statistics
        $totalRevenue = Order::whereBetween('created_at', [$startDate, $endDate])
            ->whereRaw('LOWER(status) = ?', ['completed'])
            ->sum('total_amount');
        
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->whereRaw('LOWER(status) = ?', ['completed'])
            ->count();
        
        $totalProducts = Product::count();
        
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        return view('admin.analytics.index', [
            'yearlySalesData' => $yearlySalesData,
            'salesByDateData' => $salesByDateData,
            'productSalesData' => $productSalesData,
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'avgOrderValue' => $avgOrderValue,
            'startDate' => $startDateInput,
            'endDate' => $endDateInput,
        ]);
    }

    /**
     * Get yearly sales data
     */
    public function getYearlySalesData($startDate, $endDate)
    {
        $salesByYear = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('SUM(total_amount) as total')
        )
        ->whereRaw('LOWER(status) = ?', ['completed'])
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy(DB::raw('YEAR(created_at)'))
        ->orderBy('year')
        ->get();

        $yearLabels = [];
        $salesData = [];

        foreach ($salesByYear as $sale) {
            $yearLabels[] = (string) $sale->year;
            $salesData[] = round($sale->total, 2);
        }

        return [
            'labels' => $yearLabels,
            'data' => $salesData,
        ];
    }

    /**
     * Get sales totals by day inside selected date range
     */
    public function getSalesByDateRangeData($startDate, $endDate)
    {
        $salesByDate = Order::select(
            DB::raw('DATE(created_at) as sale_date'),
            DB::raw('SUM(total_amount) as total')
        )
        ->whereRaw('LOWER(status) = ?', ['completed'])
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('sale_date')
        ->get();

        return [
            'labels' => $salesByDate->pluck('sale_date')->toArray(),
            'data' => $salesByDate->pluck('total')->map(fn($v) => round((float) $v, 2))->toArray(),
        ];
    }

    /**
     * Get product sales distribution
     */
    public function getSalesByProduct($startDate, $endDate)
    {
        $productSales = Product::select('products.name', DB::raw('SUM(order_items.quantity * order_items.unit_price) as total_sales_amount'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereRaw('LOWER(orders.status) = ?', ['completed'])
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sales_amount')
            ->limit(10)
            ->get();

        $totalSalesAllProducts = (float) Product::join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->whereRaw('LOWER(orders.status) = ?', ['completed'])
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->sum(DB::raw('order_items.quantity * order_items.unit_price'));

        $productNames = $productSales->pluck('name')->toArray();
        $percentageData = $productSales->map(function ($row) use ($totalSalesAllProducts) {
            if ($totalSalesAllProducts <= 0) {
                return 0;
            }

            return round((((float) $row->total_sales_amount) / $totalSalesAllProducts) * 100, 2);
        })->toArray();

        $topPercentTotal = array_sum($percentageData);
        $othersPercent = max(0, round(100 - $topPercentTotal, 2));
        // Only add "Others" category if there are actual products with sales
        if ($othersPercent > 0 && count($productSales) > 0) {
            $productNames[] = 'Others';
            $percentageData[] = $othersPercent;
        }

        return [
            'labels' => $productNames,
            'data' => $percentageData,
        ];
    }
}
