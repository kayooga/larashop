<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = [
        'stock_id',
        'user_id'
    ];

    //リレーション従カート主ストック
    public function stock()
    {
        return $this->belongsTo('\App\Models\Stock');
    }

    public function showCart()
    {
        $user_id = Auth::id();
        return $this->where('user_id', $user_id)->get();
    }

    public function addCart($stock_id)
    {
        $user_id = Auth::id();
        //firstOrCreate stock_idとuser_idが同じレコードがないか確認してから保存する
        $cart_add_info = $this->firstOrCreate([
            'stock_id' => $stock_id,
            'user_id' => $user_id
        ]);
        //wasRecentlyCreated 直近でレコードされた場合はtrueを返す
        if ($cart_add_info->wasRecentlyCreated) {
            $message = 'カートに追加しました';
        } else {
            $message = 'カートに登録済みです';
        }

        return  $message;
    }

    public function deleteCart($stock_id)
    {
        $user_id = Auth::id();
        $delete = $this->where('user_id', $user_id)->where('stock_id', $stock_id)->delete();

        //->delete()で影響を与えたレコードの数を返す
        if ($delete > 0) {
            $message = 'カートから削除しました';
        } else {
            $message = '削除に失敗しました';
        }

        return $message;
    }


}
