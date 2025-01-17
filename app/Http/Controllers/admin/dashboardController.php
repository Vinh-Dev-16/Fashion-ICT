<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\ChangeOrderStatus;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\MonthHelper;
use Illuminate\Support\Str;


class dashboardController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $sold = [];
        $month = [];
        $productName = [];
        $productView = [];
        $price = [];
        $productNameByComment = [];
        $comment = [];
        $recentMonths = DB::table('order_details')
            ->select(
                DB::raw('YEAR(time) as year'),
                DB::raw('MONTH(time) as month'),
                DB::raw('SUM(quantity) as total_quantity')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->where('status', '1')
            ->limit(5)
            ->get();
        $recentMonths = $recentMonths->reverse();
        foreach ($recentMonths as $month) {
            $year = $month->year;
            $monthNumber = $month->month;
            $monthName = MonthHelper::getMonthName($monthNumber);
            $totalQuantity = $month->total_quantity;
            $months[] = $monthName;
            $sold[] = $totalQuantity;
        }

        $productViews = DB::table('products')
            ->select(
                DB::raw('name'),
                DB::raw('view')
            )
            ->orderBy('view', 'desc')
            ->limit(6)
            ->get();
        $productViews = $productViews->reverse();
        foreach ($productViews as $item) {
            $productName[] = Str::of($item->name)->words(5, '...');
            $productView[] = $item->view;
        }

        $getPrice = DB::table('order_details')
            ->select(
                DB::raw('YEAR(time) as year'),
                DB::raw('MONTH(time) as month'),
                DB::raw('SUM(total_money) as total_money')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->where('status', '1')
            ->limit(5)
            ->get();
        $getPrice = $getPrice->reverse();

        foreach ($getPrice as $item) {
            $price[] = $item->total_money;
        }

        $productComments = DB::table('products')
            ->select(
                DB::raw('name'),
                DB::raw('count')
            )
            ->orderBy('count', 'desc')
            ->limit(6)
            ->get();
        $productComments = $productComments->reverse();
        foreach ($productComments as $item) {
            $productNameByComment[] = Str::of($item->name)->words(5, '...');
            $comment[] = $item->count;
        }

        return view('admin.dashboard.index', compact('sold', 'months' , 'productName', 'productView', 'price', 'productNameByComment', 'comment'));
    }
}
