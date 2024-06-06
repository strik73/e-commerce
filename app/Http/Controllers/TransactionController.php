<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function storeCart(Request $request)
    {
       $validated = $request->validate([
            'item_no_item' => 'required|string',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        $user = Auth::user();

        $transaction = Transaction::create([
            'item_no_item' => $validated['item_no_item'],
            'quantity' => $validated['quantity'],
            'total_price' => $validated['total_price'],
            'status' => 'Pending',
            'user_id' => $user->id,
            'no_transaction' => ''
        ]);

        $transaction->no_transaction = Transaction::generateTransaction($transaction->created_at);
        $transaction->save();

        $item = Item::where('no_item', $validated['item_no_item'])->first();

        if ($item->stock >= $validated['quantity']) {
            $item->stock = $item->stock - $validated['quantity'];
            if ($item->stock == 0) {
                $item->status = 0;
            }
            $item->save();
        }

        return redirect()->route('shopping-cart')->with('success', 'Barang berhasil ditambahkan');
    }

    public function batal($id)
    {
        if (Transaction::where('no_transaction', $id)->exists()) {
            $transaction = Transaction::where('no_transaction', $id)->first();
            $item = Item::where('no_item', $transaction->item_no_item)->first();
            $item->stock = $item->stock + $transaction->quantity;
            $transaction->status = 'Batal';

            $item->update();
            $transaction->update();
        }

        return redirect()->route('shopping-cart')->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function approve($id)
    {
        if (Transaction::where('no_transaction', $id)->exists()) {
            $transaction = Transaction::where('no_transaction', $id)->first();
            $transaction->status = 'Success';
            $payment = Payment::where('transaction_no_transaction', $transaction->no_transaction)->first();
            $payment->status = 'Success';

            $transaction->update();
            $payment->update();
        }

        return redirect()->route('home.merchant')->with('success', 'Pesanan berhasil disetujui');
    }
}
