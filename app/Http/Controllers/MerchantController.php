<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MerchantController extends Controller
{
    public function index()
    {
        $transaction = DB::table('transactions')
            ->join('items', 'transactions.item_no_item', '=', 'items.no_item')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->join('payments', 'transactions.no_transaction', '=', 'payments.transaction_no_transaction')
            ->select('transactions.no_transaction', 'payments.status as pay_status', 'transactions.status', 'transactions.created_at', 'items.name', 'transactions.quantity', 'transactions.total_price', 'items.image', 'users.name as user_name', 'users.address', 'users.phone', 'users.city')
            ->where('items.user_id', auth()->user()->id)
            ->where('transactions.status', '=', 'Pending')
            ->orWhere('transactions.status', '=', 'Processed')
            ->paginate(10);

        return view('merchant.index', compact('transaction'));
    }

    public function history()
    {
        $transaction = DB::table('transactions')
            ->join('items', 'transactions.item_no_item', '=', 'items.no_item')
            ->join('users', 'items.user_id', '=', 'users.id')
            ->join('payments', 'transactions.no_transaction', '=', 'payments.transaction_no_transaction')
            ->select('transactions.no_transaction', 'payments.status as pay_status', 'transactions.status', 'transactions.created_at', 'items.name', 'transactions.quantity', 'transactions.total_price', 'items.image', 'users.name as user_name', 'users.address', 'users.phone', 'users.city')
            ->where('items.user_id', auth()->user()->id)
            ->where('transactions.status', '!=', 'Pending')
            ->orWhere('transactions.status', '!=', 'Processed')
            ->paginate(10);

        return view('merchant.history', compact('transaction'));
    }

    public function dashboard()
    {
        $items = Item::where('user_id', auth()->user()->id)->paginate(10);
        return view('merchant.dashboard', compact('items'));
    }

    function create()
    {
        $categories = Category::all();
        return view('merchant.items.create', compact('categories'));
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|string',
            'condition' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        $status = $request->boolean('status');
        $itemId = request('id');
        $user = Auth::user();

        $namaUser = DB::table('users')
            ->select('name')
            ->where('id', $user->id)
            ->value('name');

        $idUser = DB::table('users')
            ->select('id')
            ->where('id', $user->id)
            ->value('id');

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:4096',
            ], [
                'image.mimes' => 'The attribute must be a file of type: png, jpg, jpeg, gif, or svg.',
                'image.max' => 'The image size cannot greater than 4 MB',
            ]);

            $image = $request->file('image');
            $imageName = Str::slug($validated['name']) . '-' . $itemId . '.' . $image->getClientOriginalExtension();
            $pathImage = 'images/item/' . $imageName;

            $request->image->move(public_path('images/item'), $imageName);
        }

        if ($request->hasFile('imageSec')) {
            $request->validate([
                'imageSec' => 'image|mimes:png,jpg,jpeg,gif,svg|max:4096',
            ], [
                'imageSec.mimes' => 'The attribute must be a file of type: png, jpg, jpeg, gif, or svg.',
                'foto.max' => 'The image size cannot greater than 4 MB',
            ]);

            $imageSec = $request->file('imageSec');
            $imageNameSec = Str::slug($validated['nama']) . '2' . '-' . $itemId . '.' . $imageSec->getClientOriginalExtension();
            $pathImageSec = 'images/item/' . $imageNameSec;

            $request->imageSec->move(public_path('images/item'), $imageNameSec);
        } else {
            $pathImageSec = null;
        }

        if ($request->hasFile('imageThird')) {
            $request->validate([
                'imageThird' => 'image|mimes:png,jpg,jpeg,gif,svg|max:4096',
            ], [
                'imageThird.mimes' => 'The attribute must be a file of type: png, jpg, jpeg, gif, or svg.',
                'foto.max' => 'The image size cannot greater than 4 MB',
            ]);

            $imageTrd = $request->file('imageThird');
            $imageNameTrd = Str::slug($validated['nama']) . '3' . '-' . $itemId . '.' . $imageTrd->getClientOriginalExtension();
            $pathImageTrd = 'images/item/' . $imageNameTrd;

            $request->imageThird->move(public_path('images/item'), $imageNameTrd);
        } else {
            $pathImageTrd = null;
        }

        $items = Item::create([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'condition' => $validated['condition'],
            'stock' => $validated['stock'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'status' => $status,
            'image' => $pathImage,
            'imageSec' => $pathImageSec,
            'imageThird' => $pathImageTrd,
            'user_id' => $user->id,
            'no_item' => ''
        ]);

        $items->no_item = Item::generateItem($items->created_at, $namaUser, $idUser);
        $items->save();

        return redirect()->route('merchant.dashboard')->with('success', 'Item berhasil ditambahkan');
    }

    public function edit($id)
    {
        $items = Item::find($id);
        $categories = Category::all();

        return view('merchant.items.edit', compact('categories', 'items'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|string',
            'condition' => 'required|string',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        $status = $request->boolean('status');
        $itemId = request('id');
        $user = Auth::user();

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:4096',
            ], [
                'image.mimes' => 'The attribute must be a file of type: png, jpg, jpeg, gif, or svg.',
                'image.max' => 'The image size cannot greater than 4 MB',
            ]);

            $image = $request->file('image');
            $imageName = Str::slug($validated['name']) . '-' . $itemId . '.' . $image->getClientOriginalExtension();
            $pathImage = 'images/item/' . $imageName;

            $request->image->move(public_path('images/item'), $imageName);
        }

        if ($request->hasFile('imageSec')) {
            $request->validate([
                'imageSec' => 'image|mimes:png,jpg,jpeg,gif,svg|max:4096',
            ], [
                'imageSec.mimes' => 'The attribute must be a file of type: png, jpg, jpeg, gif, or svg.',
                'foto.max' => 'The image size cannot greater than 4 MB',
            ]);

            $imageSec = $request->file('imageSec');
            $imageNameSec = Str::slug($validated['nama']) . '2' . '-' . $itemId . '.' . $imageSec->getClientOriginalExtension();
            $pathImageSec = 'images/item/' . $imageNameSec;

            $request->imageSec->move(public_path('images/item'), $imageNameSec);
        }

        if ($request->hasFile('imageThird')) {
            $request->validate([
                'imageThird' => 'image|mimes:png,jpg,jpeg,gif,svg|max:4096',
            ], [
                'imageThird.mimes' => 'The attribute must be a file of type: png, jpg, jpeg, gif, or svg.',
                'foto.max' => 'The image size cannot greater than 4 MB',
            ]);

            $imageTrd = $request->file('imageThird');
            $imageNameTrd = Str::slug($validated['nama']) . '3' . '-' . $itemId . '.' . $imageTrd->getClientOriginalExtension();
            $pathImageTrd = 'images/item/' . $imageNameTrd;

            $request->imageThird->move(public_path('images/item'), $imageNameTrd);
        }

        $items = Item::find($id);

        $items->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'condition' => $validated['condition'],
            'stock' => $validated['stock'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'status' => $status,
            'image' => $pathImage ?? $items->image,
            'imageSec' => $pathImageSec ?? $items->imageSec,
            'imageThird' => $pathImageTrd ??  $items->imageThird,
            'user_id' => $user->id
        ]);

        return redirect()->route('merchant.dashboard')->with('success', 'Item berhasil diupdate.');
    }
}
