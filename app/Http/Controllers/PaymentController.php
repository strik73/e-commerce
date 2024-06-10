<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payments.index', compact('payments'));;
    }
    public function history()
    {
        // $payments = Payment::where('user_id', auth()->user()->id)->sortByDesc('created_at')->get();
        $payments = DB::table('payments')
                ->join('transactions', 'payments.transaction_no_transaction', '=', 'transactions.no_transaction')
                ->join('items', 'transactions.item_no_item', '=', 'items.no_item')
                ->join('users', 'transactions.user_id', '=', 'users.id')
                ->select('payments.id', 'payments.method', 'payments.amount', 'payments.status', 'payments.created_at', 'transactions.no_transaction', 'items.name', 'transactions.quantity', 'transactions.total_price', 'items.image', 'users.name as user_name', 'users.address', 'users.phone', 'users.city')
                ->where('transactions.user_id', auth()->user()->id)
                ->orderBy('payments.created_at', 'desc')
                ->paginate(5);

        return view('history', compact('payments'));;
    }

    public function createPayment($id)
    {
        $transactions = DB::table('transactions')
            ->join('items', 'transactions.item_no_item', '=', 'items.no_item')
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->select('transactions.no_transaction', 'items.name', 'transactions.quantity', 'transactions.total_price', 'items.image', 'users.name as user_name', 'users.address', 'users.phone', 'users.city')
            ->where('transactions.no_transaction', $id)
            ->first();

        // $transactions = Transaction::find($id);

        return view('payment.create', compact('transactions'));
    }

    public function storePayment(Request $request, $id)
    {
        $transactions = Transaction::find($id);

        $validated = $request->validate([
            'method' => 'string|required',
            'amount' => 'required|numeric',
        ]);

        $payment = Payment::create([
            'transaction_no_transaction' => $transactions->no_transaction,
            'method' => $validated['method'],
            'amount' => $validated['amount'],
            'status' => 'Waiting Approval',
        ]);

        $transactions->update([
           'status' => 'Processed',
        ]);

        return redirect()->route('home')->with('success', 'Payment has been made successfully');
    }

    public function directPayment($id)
    {
        $transactions = DB::table('items')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->select('items.name', 'items.price', 'items.stock', 'items.no_item', 'items.image', 'users.name as user_name', 'users.address', 'users.phone', 'users.city')
            ->where('items.no_item', $id)
            ->first();

        // $transactions = Transaction::find($id);

        return view('payment.direct', compact('transactions'));
    }

    public function storeDirect(Request $request, $id)
    {
        $transactions = Item::find($id);
        $user = Auth::user();

        $validated = $request->validate([
            'method' => 'string|required',
            'amount' => 'required|numeric',

            'item_no_item' => 'required|string',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'item_no_item' => $validated['item_no_item'],
            'quantity' => $validated['quantity'],
            'total_price' => $validated['total_price'],
            'status' => 'Processed',
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

        sleep(2);

        $payment = Payment::create([
            'transaction_no_transaction' => $transaction->no_transaction,
            'method' => $validated['method'],
            'amount' => $validated['amount'],
            'status' => 'Waiting Approval',
        ]);

        return redirect()->route('home')->with('success', 'Payment has been made successfully');
    }
}
