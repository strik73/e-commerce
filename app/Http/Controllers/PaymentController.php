<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
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
}
