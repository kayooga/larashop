@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="">
    <div class="mx-auto" style="max-width:1200px">
      <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">購入履歴</h1>
      <div class="">
        <div class="d-flex flex-row flex-wrap">
            @foreach ($histories as $history)
              <div class="col-xs-6 col-sm-4 col-md-4">
                <div class="mycart_box">
                    {{ $history->stock->name }} <br>
                    {{ $history->stock->fee }} 円<br>
                    <img src="/image/{{ $history->stock->imgpath }}" alt="" class="incart">
                    <br>
                </div>
              </div>
            @endforeach
          </div>
          <div class="text-center" style="width: 200px; margin:20px auto;">
            {{ $histories->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection