<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{

    //購入履歴の取得
    public function history()
    {
        $histories = History::paginate(6);
        return view('history', compact('histories'));
    }
}
