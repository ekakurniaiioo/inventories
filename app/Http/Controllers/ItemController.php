<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\StockMovement;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('category')->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        Item::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'stock' => 0
        ]);

        return redirect()->route('items.index')->with('succes', 'Barang berhasil ditambah');
    }

    public function stockIn(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $qty = $request->quantity;

        StockMovement::create([
            'item_id' => $item->id,
            'type' => 'in',
            'quantity' => $qty
        ]);

        $item->increment('stock', $qty);

        return back()->with('succes', 'Stok berhasil ditambah');
    }

    public function stockOut(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $qty = $request->quantity;

        if($item->stock < $qty) {
            return back()->with('error', 'Stock tidak cukup');
        }

        StockMovement::create([
            'item_id' => $item->id,
            'type' => 'out',
            'quantity' => $qty
        ]);
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();
    
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);

        $item = Item::findOrFail($id);

        $item->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('items.index')->with('succes', 'Barang berhasil diupdate');
    }

    public function destroy($id){
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('succes', 'Barang berhasil dihapus');
    }
}
