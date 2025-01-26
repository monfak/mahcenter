@extends('frontend.layouts.app')
@section('title', 'سبد خرید')
@section('content')
    <div class="container-fluid slide gap-col-mob content-page">
        <div class="container section1-1 gap-top gap-col-mob my-5">
            <p class="title-page">سبد خرید</p>
            <div class="card">
              <div class="card-body">
                @if($products)
                <div class="row">
                    <div id="content" class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td class="text-center">تصویر</td>
                                    <td class="text-left">نام کالا</td>
                                    <td class="text-left">مدل</td>
                                    <td class="text-left">تعداد</td>
                                    <td class="text-right">قیمت واحد</td>
                                    <td class="text-right">جمع</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cart as $product)
                                    <tr>
                                        <td class="text-center">
                                            <a href="{{ url('products/' . $product['slug']) }}">
                                                <img src="{{ $product['image'] }}" alt=" " title="" class="img-thumbnail" style="width:47px;height:47px">
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <a href="{{ url('products/' . $product['slug']) }}" style="font-size: 0.9rem">{{ $product['name'] }}</a>
                                        </td>
                                        <td class="text-left">{{ $product['model'] }}</td>
                                        <td class="text-left">
                                            <div class="input-group btn-block">
                                                  <form method="post" action="{{ route('cart.update', $product['id']) }}" class="frm mr-1" id="frm{{ $loop->index }}" style="display:inline-flex">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="button" class="btn btn-refresh" onclick="sendUpdate(1, `{{ $loop->index }}`)">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <input type="number" name="quantity" style="width:45px !important;" 
                                                    readonly value="{{ $product['quantity'] }}" min="1" id="input-quantity{{ $loop->index }}"
                                                     class="form-control">
                                                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                                    <input type="hidden" name="option_id" value="{{ $product['option_id'] }}">
                                                    <button type="button" class="btn btn-refresh" onclick="sendUpdate(0, `{{ $loop->index }}`)">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </form>
                                                <script>
                                                    function sendUpdate(type = 1, order) {
                                                        var value = 0;
                                                        if(type == 1) {
                                                            value = +$(`#input-quantity${order}`).val() + 1;
                                                            $(`#input-quantity${order}`).val(value);
                                                        } else {
                                                            value = +$(`#input-quantity${order}`).val() - 1;
                                                            if(value == 0) {
                                                                alert('تعداد نمیتواند کوچکتر از یک باشد');
                                                                return;
                                                            }
                                                            $(`#input-quantity${order}`).val(value);
                                                        }
                                                        $(`#frm${order}`).submit();
                                                    }
                                                </script>
                                                <form method="post" action="{{ route('cart.delete', $product['id']) }}">
                                                    @csrf
                                                    @method('delete')
                                                      <input type="hidden" name="option_id" value="{{ $product['option_id'] }}"  >
                                                    <button type="submit" class="btn btn-del">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <span class="text-success">{{ $product['price'] }} تومان</span>
                                        </td>
                                        <td class="text-right">{{ $product['totalPrice'] }} تومان</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5">جمع کل</td>
                                    <td>{{ number_format($totalSum, 0) }} تومان</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="buttons">
                            <div class="pull-left">
                                <a href="{{ route('checkout')}}" class="btn btn-success">تسویه حساب</a>
                            </div>
                            @guest
                                <div class="pull-right">
                                    <p class="text-warning">برای ثبت سفارش باید ثبت نام کرده یا وارد شوید.</p>
                                    <a href="{{ route('register') }}" class="btn btn-primary">ثبت نام</a>
                                    <a href="{{ route('login') }}" class="btn btn-default">ورود</a>
                                </div>
                            @elseguest
                                <div class="pull-right">
                                    <a href="#" class="btn btn-primary">ثبت سفارش</a>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            @else
                <div class="row mt-4 mb-4">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div id="content" class="col-sm-12"><h1>سبد خرید</h1>
                                <p>هیچ محصولی در سبد خرید شما وجود ندارد.</p>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <a href="{{ route('home') }}" class="btn btn-primary">ادامه</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
              </div>
          </div>
        </div>
    </div>
@endsection
