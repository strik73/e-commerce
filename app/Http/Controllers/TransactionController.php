<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $items = DB::table('items')
                ->select('no_item','name')
                ->get();

        return view('admin.transactions.index', compact('transactions', 'items'));
    }

    public function create()
    {
        return view('admin.transactions.create');
    }
}
