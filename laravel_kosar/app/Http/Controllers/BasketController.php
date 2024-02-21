<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function index()
    {
        return response()->json(Basket::all());
    }

    public function show($user_id, $item_id)
    {
        $basket = Basket::where('user_id', $user_id)
            ->where('item_id', "=", $item_id)
            ->get();
        return $basket[0];
    }

    public function store(Request $request)
    {
        $item = new Basket();
        $item->user_id = $request->user_id;
        $item->item_id = $request->item_id;

        $item->save();
    }

    public function update(Request $request, $user_id, $item_id)
    {
        $item = $this->show($user_id, $item_id);
        $item->user_id = $request->user_id;
        $item->item_id = $request->item_id;

        $item->save();
    }

    public function destroy($user_id, $item_id)
    {
        $this->show($user_id, $item_id)->delete();
    }

    public function kosaram()
    {
        $user = Auth::user();

        $kosar = Basket::with('termekek')
            ->where('user_id', '=', $user->id)
            ->get();

        return $kosar;
    }

    public function kosara($id, $tipus)
    {
        $tipusonkent = DB::table('product_types as pt')
            ->selectRaw('*')
            ->join('products as p', 'p.type_id', 'pt.type_id')
            ->join('baskets as b', 'b.item_id', 'p.item_id')
            ->where('pt.type_id', $tipus)
            ->where('b.user_id', $id)
            ->get();
        return $tipusonkent;
    }

    public function regiKosarTorles()
    {
        DB::table('baskets')
            ->whereDate('created_at', '<', Carbon::now()->subDays(2))
            ->delete();
    }
}
