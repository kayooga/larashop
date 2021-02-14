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
        $my_carts = $cart->showCart();
        return view('mycart', compact('my_carts'));
    }

    public function addMycart(Request $request)
    {
//ログイン中のユーザーIDを取得
        $user_id = Auth::id();
//ポストhiddenで送られてきたstock_idを取得
        $stock_id = $request->stock_id;
//firstOrCreate stock_idとuser_idが全く同じレコードが存在しないか確認してから保存する
        $cart_add_info = Cart::firstOrCreate([
            'stock_id' => $stock_id,
            'user_id' => $user_id
            ]);
//wasRecentlyCreated 直近で保存された場合はtrueを返す
        if ($cart_add_info->wasRecentlyCreated) {
            $message = 'カートに追加しました';
        } else {
            $message = 'カートに登録済みです';
        }
//カートの情報を取得する
        $my_carts = Cart::where('user_id', $user_id)->get();

        return view('mycart', compact('my_carts', 'message'));
    }
}
