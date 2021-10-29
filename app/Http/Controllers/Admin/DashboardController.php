<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\TransactionDetail;

class DashboardController extends Controller
{

    public function index()
    {
         $transactions = TransactionDetail::with(['transaction.user', 'product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            })->orderBy('created_at','desc')->take(5);

         $transactionss = TransactionDetail::with(['transaction.user', 'product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });

        $revenue = $transactionss->get()->reduce(function($carry, $item){
            return $carry + $item->price;
        });

        $customer = User::count();

        return view('pages.admin.dashboard',[
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer
        ]);
    }
}
