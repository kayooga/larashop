<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class History extends Model
{
    protected $table = 'histories';

    protected $fillable = [
        'stock_id',
        'user_id',
        'num'
    ];

    protected static function boot()
    {
        //親モデル(Illuminate\Database\Eloquent\Model)のbootメソッド(同名メソッド)を呼び出す
        parent::boot();

        //保存時user_idをログインユーザーに設定
        //self::saving このイベント発生時にしたい処理
        //\Auth:id その時ログインしているユーザー
        self::saving(function($history) {
                $history->user_id = \Auth::id();
        });
    }

    //リレーション
    public function stock()
    {
        return $this->belongsTo('\App\Models\Stock');
    }

}
