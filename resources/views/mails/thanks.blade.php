@component('mail::message')

{{ $user }}様<br>
この度はLaraShopでのご購入ありがとうございます。<br>

お客様が購入した商品<br>

@foreach ($checkout_items as $item)
  ・{{ $item->stock->name }} | {{ $item->stock->fee }}円
  <br>
@endforeach

下記の決済画面より決済を完了させてください。<br>

@component('mail::button', ['url' => ''])
決済画面へ
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
