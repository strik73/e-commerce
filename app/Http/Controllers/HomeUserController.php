<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeUserController extends Controller
{
    public function index()
    {
        $items = Item::where('status', 1)->paginate(8);
        return view('home', compact('items'));
    }

    public function showCart()
    {
        $user = Auth::user();
        //$transactions = Transaction::where('user_id', $user->id)->paginate(5);
        $transactions = DB::table('transactions')
            ->join('items', 'transactions.item_no_item', '=', 'items.no_item')
            ->join('users as buyer', 'transactions.user_id', '=', 'buyer.id')
            ->join('users as seller', 'items.user_id', '=', 'seller.id')
            ->select('transactions.*', 'items.name', 'items.price', 'items.image', 'buyer.name as buyer_name', 'seller.name as seller_name')
            ->where('transactions.user_id', $user->id)
            ->whereNot('transactions.status', 'Success')
            ->paginate(5);

        return view('cart', compact('transactions', 'user'));
    }

    public function showDone()
    {
        $user = Auth::user();
        //$transactions = Transaction::where('user_id', $user->id)->paginate(5);
        $transactions = DB::table('transactions')
            ->join('items', 'transactions.item_no_item', '=', 'items.no_item')
            ->join('users as buyer', 'transactions.user_id', '=', 'buyer.id')
            ->join('users as seller', 'items.user_id', '=', 'seller.id')
            ->select('transactions.*', 'items.name', 'items.price', 'items.image', 'buyer.name as buyer_name', 'seller.name as seller_name')
            ->where('transactions.user_id', $user->id)
            ->where('transactions.status', 'Success')
            ->paginate(5);

        return view('cart', compact('transactions', 'user'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $items = Item::where('name', 'LIKE', '%' . $search . '%')
            ->where('status', 1)
            ->paginate(8);
        return view('home', compact('items'));
    }

    public function itemDetail($id)
    {
        if (Item::where('no_item', $id)->exists()) {
            $item = Item::where('no_item', $id)->first();
            return view('detail', compact('item'));
        } else {
            return redirect()->back()->with('error', 'Item not found');
        }
    }
}
