<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    function index(){
        $items = Item::all();
        return view('admin.items.index', compact('items'));
    }

    function create()
    {
        $categories = Category::all();
        return view('admin.items.create', compact('categories'));
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
            'user_id' => $user->id
        ]);

        return redirect()->route('items.index')->with('success', 'Data successfully added');
    }

    public function edit($id)
    {
        $items = Item::find($id);
        $categories = Category::all();

        return view('admin.items.edit', compact('categories','items'));
    }

    public function update(Request $request, $id){
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

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }
}
