<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        //商品情報の取得
        $stocks = Stock::Paginate(6);
        return view('shop', compact('stocks'));
    }

    //この引数は$cart = new Cart();の意味で、インスタンス化の記述を不要にしてくれる
    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('mycart', $data);
    }

    public function addMycart(Request $request, Cart $cart)
    {
        //ポストhiddenで送られてきたstock_idを取得
        $stock_id = $request->stock_id;
        //カートに追加
        $message = $cart->addCart($stock_id);

        //追加後のカートの情報を取得する
        $data = $cart->showCart();

        return view('mycart',$data)
            ->with('message', $message);
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        //カートから削除の処理
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);

        //削除後のカート情報を取得する
        $data = $cart->showCart();

        return view('mycart', $data)
            ->with('message', $message);
    }
}
