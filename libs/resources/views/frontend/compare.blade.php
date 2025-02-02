@extends('frontend.layouts.app')
@section('title', 'مقایسه کالا')
@section('scripts')
<script>
    $(document).ready(function () {
        $('.add_compare').click(function (event) {
            event.preventDefault();
            console.log('clicked...');
            // $('.loading').modal('show');
            $('.compare-modal-content').load('{{route('product.add.compare')}}');
            $('#compare-modal').modal('show');
        });
        if (matchMedia('only screen and (min-width: 768px)').matches) {
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll >= 200) {
                    $(".compare-products.jsticky ul").addClass("fixed-row");
                } else {
                    $(".compare-products.jsticky ul").removeClass("fixed-row");
                }
            });
        }
    });
</script>
@endsection
@section('content')
<div class="container-fluid slide compare-box gap-col-mob compare-section">
  <div class="loader"></div>
  <div class="modal fade bd-example-modal-lg" id="compare-modal" tabindex="-1" role="dialog" aria-labelledby="compare-modal" aria-hidden="true">
      <div class="modal-dialog compare-modal-content modal-lg"></div>
  </div>
  <article class="post-10066 page type-page status-publish hentry">
    <div class="entry-content content-box">
      <div class="compare-section clearfix">
        <div class="compare-products jsticky">
          <ul class="clearfix">
               @if($products)
                @php $totalProduct = $products->count() @endphp
                @for($i = 0; $i < $totalProduct; $i++)
             <li class="compare-singleitem">
          <div class="compare-thumbs-container">
            <div class="compare-product-img">
              <a title="آبمیوه گیری بیم مدل BEEM JC2104" href="">
                <img alt="{{ $products[$i]['name'] }}" title="{{ $products[$i]['name'] }}"
                  src="{{ asset(image_resize($products[$i]['image'], ['width' => 600, 'height' => 551])) }}">
              </a>
            </div>
            <div>
              <a class="compare-item" title="{{ $products[$i]['name'] }}" href="{{ route('products.show', $products[$i]['slug']) }}">
                <div class="product-title">
                  <h2 class="firstTitle">
                     {{ $products[$i]['name'] }}
                  </h2>
                </div>
              </a>
              <span class="woocommerce-Price-amount amount">
                <bdi>
                   @if($products[$i]['special'])
                        <del class="text-danger">{{ number_format($products[$i]['price']) }}</del><br>
                        <ins class="text-success">{{ number_format($products[$i]['special']) }}</ins>
                    @else
                        {{number_format($products[$i]['price']) }} 
                    @endif
                    &nbsp; <span class="woocommerce-Price-currencySymbol">تومان</span>
                </bdi>
              </span>
              <a class="btn product-dle-btn" href="{{ route('products.show', $products[$i]['slug']) }}">مشاهده و خرید محصول</a>
            </div>
          </div>
           <form action="{{ route('compare.remove', ['id' => $products[$i]['id']]) }}" method="post">
            @csrf
            <button type="submit" >
               <i class="fas fa-times icon-white-close"></i>
            </button>
         </form>
        </li>
             @endfor
             @if(count($products) < 4)
            <li class="compare-singleitem compare-newitem ">
              <div class="compare-newitem-container" >
                <div class="compare-icon" ></div>
                <div class="add-product" data-toggle="modal" data-target="#productCompareModal" >
                  <a href="javascript:{}"   class="add_compare ">
                    برای افزودن کالا به لیست مقایسه کلیک کنید
                  </a>
                </div>
              </div>
              <div class="dk-button-container">
                <a class="dk-button blue add_compare" data-toggle="modal" data-target="#productCompareModal">
                  <i class="dk-button-icon dk-button-icon-caretLeft"></i>
                  <span class="dk-button-label clearfix">
                    <span class="dk-button-labelname">
                     <span class="dk-button-labelname ">افزودن کالا به مقایسه</span>
                    </span>
                  </span>
                </a>
              </div>
            </li>
            @endif
            @else
               <li class="compare-singleitem compare-newitem ">
              <div class="compare-newitem-container" >
                <div class="compare-icon" ></div>
                <div class="add-product"  data-toggle="modal" data-target="#productCompareModal">
                  <a href="javascript:{}"  class="add_compare ">
                    برای افزودن کالا به لیست مقایسه کلیک کنید
                  </a>
                </div>
              </div>
              <div class="dk-button-container">
                <a class="dk-button blue add_compare" data-toggle="modal" data-target="#productCompareModal">
                  <i class="dk-button-icon dk-button-icon-caretLeft"></i>
                  <span class="dk-button-label clearfix">
                    <span class="dk-button-labelname">
                     <span class="dk-button-labelname ">افزودن کالا به مقایسه</span>
                    </span>
                  </span>
                </a>
              </div>
            </li>
              @endif
          </ul>
        </div>
         @if($products)
        <div class="compare-items-container">
          <table class="compare-table">
            <tbody></tbody>
          </table>
          <div class="comparebox-accordion-panel">
            <div class="title accordion-header" data-toggle="collapse" data-target="#accordion0">
              <span>
                <h3> <i class="fa fa-caret-left icon-caret-left-blue"></i>مشخصات کلی</h3>
              </span>
              <i class="fa fa-arrow-circle-up icon-arrow-gray-down"></i>
            </div>
            <div class="accordion-panel-content collapse show" id="accordion0">
              <table class="compare-table">
                <tbody>
                  <tr class="compare-table-row">
                    <td class="table-item-header">
                      <h4> مدل</h4>
                    </td>
                    
                      @for($i = 0; $i < $totalProduct; $i++)
                        <td class="table-item" >
                            {{ $products[$i]['model'] }}
                            </td>
                    @endfor
                  </tr>
                <tr class="compare-table-row">
                    <td class="table-item-header">
                      <h4> تولیدکننده</h4>
                    </td>
                    
                      @for($i = 0; $i < $totalProduct; $i++)
                        <td class="table-item" >
                            {{ $products[$i]['manufacturer']['name'] }}
                            </td>
                    @endfor
                  </tr>

                @if($attributes) 
                @foreach($attributes as $attribute)
                 @foreach($attribute['attributes'] as $name => $values)
                  <tr class="compare-table-row">
                    <td class="table-item-header">
                      <h4> {{ $name }}</h4>
                    </td>
                    
                      @for($i = 0; $i < $totalProduct; $i++)
                        <td class="table-item" >{{ $values[$products[$i]['id']] ?? '' }}</td>
                    @endfor
                  </tr>
                  @endforeach
                  
                  @endforeach
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
          @endif
      </div>
    </div>
    <!-- .entry-content -->
  </article>
</div>
@endsection