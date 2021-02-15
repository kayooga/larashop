@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
              <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
            {{ Auth::user()->name }}さんのカートの中身</h1>

            <div class="">
                <p class="text-center">{{ $message ??''}}</p><br>

              @if ($my_carts->isNotEmpty())
                  
              
                  <div class="d-flex flex-row flex-wrap">
                    @foreach($my_carts as $my_cart)
                          <div class="col-xs-6 col-sm-4 col-md-4">
                              <div class="mycart_box">
                                {{ $my_cart->stock->name }} <br>
                                  {{ number_format($my_cart->stock->fee) }}円 <br>
                                  <img src="/image/{{ $my_cart->stock->imgpath }}" alt="" class="incart">
                                  <br>

                                  <form action="/cartdelete" method="post">
                                      @csrf
                                      <input type="hidden" name="stock_id" value="{{ $my_cart->stock->id }}">
                                      <input type="submit" value="カートから削除する">
                                  </form>
                              </div>
                          </div>
                      @endforeach
                    </div>
                    <div class="text-center p-2">
                      個数：{{ $count }}個 <br>
                      <p style="font-size:1.2em; font-weight:bold;">合計金額：{{ number_format($sum) }}円</p>
                    </div>
                    <form action="/checkout" method="POST">
                      @csrf
                      @foreach ($my_carts as $my_cart)
                      <input type="hidden" name="num" value="1">
                      <input type="hidden" name="stock_id" value="{{ $my_cart->stock_id }}">
                      @endforeach
                      <button type="submit" class="btn btn-danger btn-lg text-center buy-btn">購入する</button>
                    </form>

                @else
                    <p class="text-center"> カート内は空です </p>
                @endif

                <a href="/">商品一覧へ</a>
              </div>
            </div>
          </div>
</div>
@endsection