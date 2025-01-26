@extends('frontend.layouts.app')
@section('title', 'دیدگاه‌ها')
@section('content')
    <div class="container pt-5 pb-4">
        <div class="row">
            @include('frontend.layouts.sidebar')
            <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
               <div class="card crd-info">
                <div class="text-h5">  دیدگاه‌ها  </div>
                <div class="d-block mt-4">
                    <ul class="nav nav-tabs" id="myTab-com" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab1" data-bs-toggle="tab" data-bs-target="#tab-pane1" type="button" role="tab" aria-controls="tab-pane1" aria-selected="true">در انتظار دیدگاه</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#tab-pane2" type="button" role="tab" aria-controls="tab-pane2" aria-selected="false">دیدگاه‌های من</button>
                  </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tab-pane1" role="tabpanel" aria-labelledby="tab1" tabindex="0">
                      @if(count($productsWithoutReview))
                        <div class="alert alert-info mt-3" role="alert">
                            <div class="d-flex align-items-center flex-alert ">
                                <div>
                                    <img src={{asset('images/get-points.svg')}} class="img-fluid">
                                </div>
                                <div class="ms-2">
                                    <div class="alert-main-title">از این کالاها راضی هستید؟</div>
                                    <div class="alert-sub-title font-12">با ثبت دیدگاه برای هر کالا از مه کلاب امتیاز خواهید گرفت!</div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @forelse($productsWithoutReview as $products)
                        <div class="row mt-3">
                            @foreach($products as $product)
                                <div class="col-md-6 col-12 mb-3">
                                    <div class="card crd-cm">
                                        <div class="card-body">
                                              <div class="d-flex align-items-center">
                                                  <div class="img-cm">
                                                      <img src="{{ asset(image_aspect($product->image, ['height' => 100])) }}" class="img-fluid" alt="{{ $product->name }}">
                                                  </div>
                                                  <div class="pro-name">{{ $product->name }}</div>
                                              </div>
                                              <div class="d-block mt-3 detail-cm">
                                                    <span> برند : {{ $product->manufacturer->name }} </span>
                                                    <span>
                                                      <svg style="width: 16px; height: 16px; fill:#999ca1;">
                                                          <use xlink:href="#dot">
                                                             <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                                                          </use>
                                                        </svg>
                                                    </span>
                                                    {{--<span>رنگ استیل</span>
                                                    <span>
                                                      <svg style="width: 16px; height: 16px; fill:#999ca1;">
                                                          <use xlink:href="#dot">
                                                             <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                                                          </use>
                                                        </svg>
                                                    </span>
                                                    <span>۱ اسفند ۱۳۹۹</span>--}}
                                              </div>
                                              {{--<div class="d-block">
                                                  <hr>
                                              </div>
                                              <div class="d-flex align-items-center justify-between">
                                                <div>
                                                    <span class="font-12 ml-1"> امتیاز دهید! </span>
                                                </div>
                                                <div>
                                                    <div class="gap-3 d-flex flex-rating">
                                                        <div class="d-flex items-center">
                                                            <input class="star-rating__input" id="star-rating-1" type="radio" name="rating4" value="1">
                                                            <label for="star-rating-1">
                                                                <div class="flex cursor-pointer">
                                                                    <svg style="width: 24px; height: 24px; fill: #a1a3a8;">
                                                                        <use xlink:href="#starOutline">
                                                                            <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                                                        </use>
                                                                    </svg>
                                                                </div>
                                                                <p class="text-body-2-compact text-neutral-500">۱</p>
                                                            </label>
                                                            
                                                            <input class="star-rating__input" id="star-rating-2" type="radio" name="rating4" value="2">  
                                                            <label for="star-rating-2">
                                                                <div class="flex cursor-pointer">
                                                                    <svg style="width: 24px; height: 24px; fill: #a1a3a8;">
                                                                        <use xlink:href="#starOutline"></use>
                                                                    </svg>
                                                                </div>
                                                                <p class="text-body-2-compact text-neutral-500">۲</p>
                                                            </label>
                                                            
                                                            <input class="star-rating__input" id="star-rating-3" type="radio" name="rating4" value="3"> 
                                                            <label for="star-rating-3">
                                                                <div class="flex cursor-pointer">
                                                                    <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                                                        <use xlink:href="#starOutline">
                                                                            <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                                                        </use>
                                                                    </svg>
                                                                </div>
                                                                <p class="text-body-2-compact text-neutral-500">۳</p>
                                                            </label>
                                                            
                                                            <input class="star-rating__input" id="star-rating-4" type="radio" name="rating4" value="4"> 
                                                            <label for="star-rating-4">
                                                                <div class="flex cursor-pointer">
                                                                    <svg style="width: 24px; height: 24px; fill: #a1a3a8;">
                                                                        <use xlink:href="#starOutline">
                                                                            <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                                                        </use>
                                                                    </svg>
                                                                </div>
                                                                <p class="text-body-2-compact text-neutral-500">۴</p>
                                                            </label>
                                                        
                                                            <input class="star-rating__input" id="star-rating-5" type="radio" name="rating4" value="5"> 
                                                            <label for="star-rating-5">
                                                                <div class="flex cursor-pointer">
                                                                    <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                                                        <use xlink:href="#starOutline">
                                                                            <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                                                        </use>
                                                                    </svg>
                                                                </div>
                                                                <p class="text-body-2-compact text-neutral-500">۵</p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-block row-flex-rating">
                                              <div class="d-flex align-items-center justify-between">
                                                  <div>
                                                      <span class="font-12 ml-1">امتیاز ثبت شده:</span>
                                                     <span class="bld font-15 ml-1">۵</span>
                                                     <span>
                                                         <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                                             <use xlink:href="#starFill">
                                                                <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol> 
                                                             </use>
                                                        </svg>
                                                     </span>
                                                  </div>
                                                   <div>
                                                       <button class="edit-cm" data-bs-toggle="modal" data-bs-target="#rateModal">
                                                           <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                                               <use xlink:href="#edit">
                                                                   <symbol id="edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.293 3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-12 12A1 1 0 018 21H4a1 1 0 01-1-1v-4a1 1 0 01.293-.707l12-12zM5 16.414V19h2.586l11-11L16 5.414l-11 11zM21 21H10l2-2h9v2z" clip-rule="evenodd"></path></symbol>
                                                               </use>
                                                            </svg>
                                                            ویرایش امتیاز
                                                       </button>
                                                   </div>
                                              </div>
                                            </div>
                                            <div class="d-block mt-3">
                                              <button href="" class="btn btn-outline-danger w-100" type="button" data-bs-toggle="modal" data-bs-target="#rateModal">
                                                <svg style="width: 24px; height: 24px; fill:#dc3545;">
                                                <use xlink:href="#comment">
                                                    <symbol id="comment" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10 21a1 1 0 001.6.8l6.92-5.198A8 8 0 0014 2h-4a8 8 0 100 16v3zm7.373-6.037l-.037.027L12 18.998V17a1 1 0 00-1-1h-1a6 6 0 010-12h4a6 6 0 013.373 10.963z" clip-rule="evenodd"></path></symbol>
                                                </use>
                                                </svg>
                                              ثبت دیدگاه
                                             </button>
                                            </div>--}}
                                        </div>
                                  </div>
                              </div>
                              @endforeach
                          </div>
                      @empty
                      <p class="mt-3">هنوز هیچ محصولی خریداری نکرده‌اید!</p>
                      @endforelse
                      <div>
                          {{ $productsWithoutReview->links() }}
                      </div>
                  </div>
                  <div class="tab-pane fade" id="tab-pane2" role="tabpanel" aria-labelledby="tab2" tabindex="0">
                      {{--
                    <div class="d-block mt-3">
                        <div class="d-flex align-items-center justify-between ">
                          
                          <div>
                              <div class="d-flex align-items-center">
                                  <div class="img-cm" style="width: 60px; height: 60px; line-height: 0;">
                                      <img src="https://mahcenter.com/storage/images/products/2024/06/1WY5LKz6Gzvq6WSeBnCKfmMgXilzVkW1UED3tHRuvYkiFHrXDmh77hTQHv0VPgsd-h100.jpg" class="img-fluid" alt="">
                                  </div>
                                  <div class="pro-name">
                                      زودپز فیلیپس مدل HD2237
                                  </div>
                              </div>
                          </div>
                          
                          <div>
                              <div class="d-flex flex-column">
                                  <div>
                                      <div class="dropdown drm-com text-end">
                                          <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                           <svg style="width: 24px; height: 24px;fill: #a1a3a8;">
                                               <use xlink:href="#moreVert">
                                                  <symbol id="moreVert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-2 4c0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2-2 .9-2 2zm2 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" clip-rule="evenodd"></path></symbol> 
                                               </use>
                                               </svg>
                                          </button>
                                          <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#rateModal">
                                                    <svg style="width: 20px; height: 20px;" class="me-2">
                                                        <use xlink:href="#edit">
                                                            <symbol id="edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.293 3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-12 12A1 1 0 018 21H4a1 1 0 01-1-1v-4a1 1 0 01.293-.707l12-12zM5 16.414V19h2.586l11-11L16 5.414l-11 11zM21 21H10l2-2h9v2z" clip-rule="evenodd"></path></symbol> 
                                                        </use>
                                                    </svg>
                                                    ویرایش دیدگاه و امتیاز
                                                </a>
                                            </li>
                                             <li>
                                                <botton class="dropdown-item" >
                                                    <svg style="width: 20px; height: 20px;" class="me-2">
                                                        <use xlink:href="#delete">
                                                            <symbol id="delete" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8 2v2h8V2H8zM4 7V5h16v2H4zm13 1h2v11a3 3 0 01-3 3H8a3 3 0 01-3-3V8h2v11a1 1 0 001 1h8a1 1 0 001-1V8zm-6 0H9v10h2V8zm2 0h2v10h-2V8z" clip-rule="evenodd"></path></symbol>
                                                        </use>
                                                    </svg>
                                                    حذف دیدگاه   
                                                </botton>
                                            </li>
                                          </ul>
                                        </div>
                                  </div>
                                  <div class="mt-3">
                                      <span class="stateReceived">
                                          <svg style="width: 18px; height: 18px; fill:#4caf50;">
                                              <use xlink:href="#stateReceived">
                                                  <symbol id="stateReceived" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10 10-4.477 10-10zm-11.293 1.293L15 9l1.414 1.414-5 5a1 1 0 01-1.414 0l-3-3L8.414 11l2.293 2.293z" clip-rule="evenodd"></path></symbol>
                                              </use>
                                              </svg>
                                              تائید شده
                                             
                                      </span>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                          <div class="d-flex mt-2">
                              <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                    <use xlink:href="#starFill">
                                        <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                    <use xlink:href="#starFill">
                                        <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                    <use xlink:href="#starFill">
                                        <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                    <use xlink:href="#starOutline">
                                        <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                    <use xlink:href="#starOutline">
                                        <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                    </use>
                                </svg>
                          </div>
                          <div class="d-flex align-items-center mt-2 text-green">
                              <svg style="width: 16px; height: 16px; fill: #00a049;" class="me-1">
                                  <use xlink:href="#thumbsUp">
                                    <symbol id="thumbsUp" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M7.5 8l3.15-4.2a4.5 4.5 0 013.6-1.8 2.483 2.483 0 012.449 2.89L16.18 8h2.424a3 3 0 012.951 3.537l-.974 5.357A5 5 0 0115.661 21h-6.55c-.148 0-.294-.033-.428-.096l-.824-.39A1 1 0 017 21H3a1 1 0 01-1-1V9a1 1 0 011-1h4.5zm.5 2v8.367L9.336 19h6.326a3 3 0 002.951-2.463l.974-5.358A1 1 0 0018.603 10H15a1 1 0 01-.986-1.164l.712-4.274A.482.482 0 0014.25 4a2.5 2.5 0 00-2 1L8.8 9.6a1 1 0 01-.8.4zm-2 0H4v9h2v-9z" clip-rule="evenodd"></path></symbol>  
                                  </use>
                             </svg>
                             پیشنهاد می‌کنم
                          </div>
                          <div class="d-block">
                              <hr>
                          </div>
                          <p class="text-neutral-900 text-h5 pt-3">عالی</p>
                          <p class="text-body-1 text-neutral-900 mb-1 pt-3 break-words">این محصول محکم و با کیفیت هست، خریدش رو پیشنهاد می کنم</p>
                          <div class="d-flex items-center pt-2px"><div class="flex ml-2">
                              <svg style="width: 16px; height: 16px; fill: #3fb776;" class="me-1">
                              <use xlink:href="#addSimple"></use>
                              </svg>
                              </div>
                              <p class="text-body-2">مقاوم
                             </p>
                        </div>
                         <div class="d-flex items-center pt-2px"><div class="flex ml-2">
                             <svg style="width: 20px; height: 20px; fill: #d32f2f;margin-left:5px;" class="ml-1"><use xlink:href="#removeSimple"><symbol id="removeSimple" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 11v2H4v-2h16z"></path></symbol></use> </svg>
                              </div>
                              <p class="text-body-2">
                                  قیمت بالا
                             </p>
                        </div>
                           <div class="d-block">
                              <hr>
                          </div>
                          <div class="d-block mt-3 detail-cm">
                              <span> برند : فیلیپس </span>
                              <span>
                                  <svg style="width: 16px; height: 16px; fill:#999ca1;">
                                      <use xlink:href="#dot">
                                         <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                                      </use>
                                    </svg>
                              </span>
                               <span>رنگ استیل</span>
                                <span>
                                  <svg style="width: 16px; height: 16px; fill:#999ca1;">
                                      <use xlink:href="#dot">
                                         <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                                      </use>
                                    </svg>
                              </span>
                               <span>۱ اسفند ۱۳۹۹</span>
                          </div>
                              <div class="d-block">
                          <hr>
                        </div>
                    </div>--}}
                    
                    {{--<div class="d-block mt-3">
                         <div class="d-flex align-items-center justify-between ">
                          <div>
                              <div class="d-flex align-items-center">
                                  <div class="img-cm" style="width: 60px; height: 60px; line-height: 0;">
                                      <img src="https://mahcenter.com/storage/images/products/2024/06/1WY5LKz6Gzvq6WSeBnCKfmMgXilzVkW1UED3tHRuvYkiFHrXDmh77hTQHv0VPgsd-h100.jpg" class="img-fluid" alt="">
                                  </div>
                                  <div class="pro-name">
                                      زودپز فیلیپس مدل HD2237
                                  </div>
                              </div>
                          </div>
                          <div>
                              <div class="d-flex flex-column">
                                  <div>
                                      <div class="dropdown drm-com text-end">
                                          <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                           <svg style="width: 24px; height: 24px;fill: #a1a3a8;">
                                               <use xlink:href="#moreVert">
                                                  <symbol id="moreVert" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-2 4c0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2-2 .9-2 2zm2 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" clip-rule="evenodd"></path></symbol> 
                                               </use>
                                               </svg>
                                          </button>
                                          <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#rateModal">
                                                    <svg style="width: 20px; height: 20px;" class="me-2">
                                                        <use xlink:href="#edit">
                                                            <symbol id="edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.293 3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-12 12A1 1 0 018 21H4a1 1 0 01-1-1v-4a1 1 0 01.293-.707l12-12zM5 16.414V19h2.586l11-11L16 5.414l-11 11zM21 21H10l2-2h9v2z" clip-rule="evenodd"></path></symbol> 
                                                        </use>
                                                    </svg>
                                                    ویرایش دیدگاه و امتیاز
                                                </a>
                                            </li>
                                             <li>
                                                <botton class="dropdown-item" >
                                                    <svg style="width: 20px; height: 20px;" class="me-2">
                                                        <use xlink:href="#delete">
                                                            <symbol id="delete" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8 2v2h8V2H8zM4 7V5h16v2H4zm13 1h2v11a3 3 0 01-3 3H8a3 3 0 01-3-3V8h2v11a1 1 0 001 1h8a1 1 0 001-1V8zm-6 0H9v10h2V8zm2 0h2v10h-2V8z" clip-rule="evenodd"></path></symbol>
                                                        </use>
                                                    </svg>
                                                    حذف دیدگاه   
                                                </botton>
                                            </li>
                                          </ul>
                                        </div>
                                  </div>
                                  <div class="mt-3">
                                      <span class="stateReceived2">
                                      <svg class="svg-icon" style="fill:red;width: 18px; height: 18px;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M684.642617 277.598412l-1.436722-1.467421c-12.489452-12.461823-32.730449-12.461823-45.159526 0L479.700991 434.510138l-158.286026-158.315702c-12.555967-12.524245-32.793894-12.524245-45.225017 0-12.555967 12.462846-12.555967 32.701796 0 45.223994l158.348448 158.317749L276.129573 638.049834c-12.495592 12.429077-12.495592 32.671097 0 45.163619l1.49812 1.434675c12.429077 12.494569 32.66905 12.494569 45.221948 0l158.287049-158.286026 158.283979 158.286026c12.491499 12.494569 32.731472 12.494569 45.220924 0 12.495592-12.493545 12.495592-32.731472 0-45.222971l-158.285003-158.285003 158.285003-158.314679C697.138209 310.299185 697.138209 290.060235 684.642617 277.598412"  /><path d="M818.88197 140.522454c-187.332573-187.363272-491.033479-187.363272-678.364005 0-187.329503 187.329503-187.329503 491.032456 0 678.362982 187.330526 187.392948 491.031433 187.392948 678.364005 0C1006.274918 631.55491 1006.274918 327.851956 818.88197 140.522454M773.656953 773.660418c-162.344458 162.343435-425.569512 162.407903-587.914994 0-162.40688-162.344458-162.40688-425.602258 0-587.914994 162.344458-162.40688 425.569512-162.40688 587.914994 0C936.063833 348.059184 936.000388 611.31596 773.656953 773.660418"  />
                                          </svg>        
                                            تائید نشده
                                      </span>
                                  </div>
                                  <div class="mt-3">
                                      <span class="stateReceived3">
                                     <svg style="width: 18px; height: 18px; fill: #abadb1;" >
                                         <use xlink:href="#stateReceived">
                                      <symbol id="stateReceived" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12s4.477 10 10 10 10-4.477 10-10zm-11.293 1.293L15 9l1.414 1.414-5 5a1 1 0 01-1.414 0l-3-3L8.414 11l2.293 2.293z" clip-rule="evenodd"></path></symbol>   
                                     </use>
                                     </svg>   
                                            در حال بررسی 
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                          <div class="d-flex mt-2">
                              <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                    <use xlink:href="#starFill">
                                        <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                    <use xlink:href="#starFill">
                                        <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                    <use xlink:href="#starFill">
                                        <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                    <use xlink:href="#starOutline">
                                        <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                    </use>
                                </svg>
                                <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                    <use xlink:href="#starOutline">
                                        <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                    </use>
                                </svg>
                          </div>
                          <div class="d-flex align-items-center mt-2 " style="color:#a1a3a8;">
                             <svg style="width: 16px; height: 16px; fill:#a1a3a8;">
                              <use xlink:href="#doubt">
                                  <symbol id="doubt" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10 8h2V7a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-.4.8l-2.4 1.8A3 3 0 0014 14v3h2v-3a1 1 0 01.4-.8l2.4-1.8A3 3 0 0020 9V7a3 3 0 00-3-3h-4a3 3 0 00-3 3v1zM6 5h2v12H6V5zm2 13H6v2h2v-2zm8 0h-2v2h2v-2z" clip-rule="evenodd"></path></symbol>
                              </use>
                            </svg>
 مطمئن نیستم
                          </div>
                             <div class="d-flex align-items-center mt-2 " style="color:#f9a825;">
                             <svg style="width: 16px; height: 16px; fill:#f9a825;">
                              <use xlink:href="#thumbsDown">
                                  <symbol id="thumbsDown" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M7.5 16l3.15 4.2a4.5 4.5 0 003.6 1.8 2.482 2.482 0 002.449-2.89L16.18 16h2.424a3 3 0 002.951-3.537l-.974-5.357A5 5 0 0015.661 3h-6.55a1 1 0 00-.428.096l-.824.39A1 1 0 007 3H3a1 1 0 00-1 1v11a1 1 0 001 1h4.5zm.5-2V5.633L9.336 5h6.326a3 3 0 012.951 2.463l.974 5.358A1 1 0 0118.603 14H15a1 1 0 00-.986 1.164l.712 4.274a.482.482 0 01-.476.562 2.5 2.5 0 01-2-1L8.8 14.4A1 1 0 008 14zm-2 0H4V5h2v9z" clip-rule="evenodd"></path></symbol>
                              </use>
                            </svg>
                           پیشنهاد نمی‌کنم 
                          </div>
                          <div class="d-block">
                              <hr>
                          </div>
                          <p class="text-neutral-900 text-h5 pt-3">عالی</p>
                          <p class="text-body-1 text-neutral-900 mb-1 pt-3 break-words">این محصول محکم و با کیفیت هست، خریدش رو پیشنهاد می کنم</p>
                          <div class="d-flex items-center pt-2px"><div class="flex ml-2">
                              <svg style="width: 16px; height: 16px; fill: #3fb776;" class="me-1">
                              <use xlink:href="#addSimple"></use>
                              </svg>
                              </div>
                              <p class="text-body-2">مقاوم
                             </p>
                        </div>
                         <div class="d-flex items-center pt-2px"><div class="flex ml-2">
                             <svg style="width: 20px; height: 20px; fill: #d32f2f;margin-left:5px;" class="ml-1"><use xlink:href="#removeSimple"><symbol id="removeSimple" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 11v2H4v-2h16z"></path></symbol></use> </svg>
                              </div>
                              <p class="text-body-2">
                                  قیمت بالا
                             </p>
                        </div>
                           <div class="d-block">
                              <hr>
                          </div>
                          <div class="d-block mt-3 detail-cm">
                              <span> برند : فیلیپس </span>
                              <span>
                                  <svg style="width: 16px; height: 16px; fill:#999ca1;">
                                      <use xlink:href="#dot">
                                         <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                                      </use>
                                    </svg>
                              </span>
                               <span>رنگ استیل</span>
                                <span>
                                  <svg style="width: 16px; height: 16px; fill:#999ca1;">
                                      <use xlink:href="#dot">
                                         <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                                      </use>
                                    </svg>
                              </span>
                               <span>۱ اسفند ۱۳۹۹</span>
                          </div>
                              <div class="d-block">
                          <hr>
                        </div>
                    </div>--}}
                  </div>
                </div>
                </div>
               </div>
            </div>
        </div>
    </div>
<!-- rateModal -->
<div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">ثبت دیدگاه و امتیاز</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="" action="">
             <div class="d-flex align-items-center">
          <div class="img-cm">
              <img src="https://mahcenter.com/storage/images/products/2024/06/1WY5LKz6Gzvq6WSeBnCKfmMgXilzVkW1UED3tHRuvYkiFHrXDmh77hTQHv0VPgsd-h100.jpg" class="img-fluid" alt="">
          </div>
          <div class="pro-name">
              زودپز فیلیپس مدل HD2237
          </div>
      </div>
            <div class="d-block mt-3 detail-cm">
              <span> برند : فیلیپس </span>
              <span>
                  <svg style="width: 16px; height: 16px; fill:#999ca1;">
                      <use xlink:href="#dot">
                         <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                      </use>
                    </svg>
              </span>
               <span>رنگ استیل</span>
                <span>
                  <svg style="width: 16px; height: 16px; fill:#999ca1;">
                      <use xlink:href="#dot">
                         <symbol id="dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></symbol> 
                      </use>
                    </svg>
              </span>
               <span>۱ اسفند ۱۳۹۹</span>
          </div>
            <div class="d-block">
                  <hr>
              </div>
            <div class="d-block">
                <div class="d-flex align-items-center n-flex-rate">
                    <div>
                        امتیاز شما به این محصول
                    </div>
                    <div>
                        <div class="d-flex cursor-pointer ">
                            <svg style="width: 24px; height: 24px; fill:#f9a825;">
                                <use xlink:href="#starFill">
                                    <symbol id="starFill" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.98 2.1a.455.455 0 00-.414.315L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014-2.144-6.635a.455.455 0 00-.451-.315z"></path></symbol>
                                </use>
                            </svg>
                            <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                <use xlink:href="#starOutline">
                                    <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                </use>
                            </svg>
                            <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                <use xlink:href="#starOutline">
                                    <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                </use>
                            </svg>
                            <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                <use xlink:href="#starOutline">
                                    <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                </use>
                            </svg>
                            <svg style="width: 24px; height: 24px; fill:#a1a3a8;">
                                <use xlink:href="#starOutline">
                                    <symbol id="starOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M14.575 9.05L12.43 2.415a.455.455 0 00-.865 0L9.426 9.05l-6.97-.014a.455.455 0 00-.268.823l5.648 4.087-2.169 6.628a.455.455 0 00.7.509L12 16.973l5.634 4.11a.455.455 0 00.7-.509l-2.169-6.628 5.648-4.087a.455.455 0 00-.267-.823l-6.97.014zm-3.694 2.003L12 7.585l.671 2.08.449 1.388 3.64-.007-1.768 1.28-1.182.855 1.133 3.464-1.765-1.288-1.18-.86-2.94 2.146.679-2.075.453-1.387-2.95-2.135 2.181.004 1.46.003z" clip-rule="evenodd"></path></symbol>
                                </use>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-block">
                  <hr>
              </div>
            <div class="d-block">
                خرید این محصول را به دیگران ...
                <span class="text-danger">*</span>
             <div class="d-block mt-3">
                 <div class="d-flex flex-other">
                     <div>
                           <input class="lbl-check" type="radio" name="p-check" value="" id="n-chek1">
                      <label  for="n-chek1">
                          <svg style="width: 36px; height: 36px; fill:#a1a3a8;">
                              <use xlink:href="#thumbsUp">
                                <symbol id="thumbsUp" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M7.5 8l3.15-4.2a4.5 4.5 0 013.6-1.8 2.483 2.483 0 012.449 2.89L16.18 8h2.424a3 3 0 012.951 3.537l-.974 5.357A5 5 0 0115.661 21h-6.55c-.148 0-.294-.033-.428-.096l-.824-.39A1 1 0 017 21H3a1 1 0 01-1-1V9a1 1 0 011-1h4.5zm.5 2v8.367L9.336 19h6.326a3 3 0 002.951-2.463l.974-5.358A1 1 0 0018.603 10H15a1 1 0 01-.986-1.164l.712-4.274A.482.482 0 0014.25 4a2.5 2.5 0 00-2 1L8.8 9.6a1 1 0 01-.8.4zm-2 0H4v9h2v-9z" clip-rule="evenodd"></path></symbol>  
                              </use>
                         </svg>
                         <p class="text-center mx-1 text-body2-strong">پیشنهاد می‌کنم</p>
                      </label>
                     </div>
                     <div>
                         <input class="lbl-check" type="radio" name="p-check" value="" id="n-chek2">
                      <label for="n-chek2">
                          <svg style="width: 36px; height: 36px; fill:#a1a3a8;">
                              <use xlink:href="#doubt">
                                  <symbol id="doubt" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10 8h2V7a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-.4.8l-2.4 1.8A3 3 0 0014 14v3h2v-3a1 1 0 01.4-.8l2.4-1.8A3 3 0 0020 9V7a3 3 0 00-3-3h-4a3 3 0 00-3 3v1zM6 5h2v12H6V5zm2 13H6v2h2v-2zm8 0h-2v2h2v-2z" clip-rule="evenodd"></path></symbol>
                              </use>
                         </svg>
                         <p class="text-center mx-1 text-body2-strong"> مطمئن نیستم</p>
                      </label>
                     </div>
                     <div>
                         <input class="lbl-check" type="radio" name="p-check" value="" id="n-chek3">
                      <label for="n-chek3">
                          <svg style="width: 36px; height: 36px; fill:#a1a3a8;">
                              <use xlink:href="#thumbsDown">
                                  <symbol id="thumbsDown" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M7.5 16l3.15 4.2a4.5 4.5 0 003.6 1.8 2.482 2.482 0 002.449-2.89L16.18 16h2.424a3 3 0 002.951-3.537l-.974-5.357A5 5 0 0015.661 3h-6.55a1 1 0 00-.428.096l-.824.39A1 1 0 007 3H3a1 1 0 00-1 1v11a1 1 0 001 1h4.5zm.5-2V5.633L9.336 5h6.326a3 3 0 012.951 2.463l.974 5.358A1 1 0 0118.603 14H15a1 1 0 00-.986 1.164l.712 4.274a.482.482 0 01-.476.562 2.5 2.5 0 01-2-1L8.8 14.4A1 1 0 008 14zm-2 0H4V5h2v9z" clip-rule="evenodd"></path></symbol>
                              </use>
                         </svg>
                         <p class="text-center mx-1 text-body2-strong"> پیشنهاد نمی‌کنم</p>
                      </label>
                   </div>
                 </div>
             </div>
            </div>
            <div class="d-block">
                  <hr>
              </div>
            <div class="d-block mb-4">
                 <h5>دیدگاه خود را شرح دهید</h5>
              </div>
            <div class="d-block">
                 عنوان نظر
              </div>
            <div class="d-block mt-1">
                  <input type="text" class="form-control">
              </div>
            <div class="d-block mt-4">
                نکات مثبت
              </div>  
            <div class="d-block list-add mt-1">
                <div class="d-block element-box">
                       <div class="d-flex flex-add mt-2">
                      <input type="text" class="form-control" value="">
                      <div class="btn-add-element">
                          <svg style="width: 24px; height: 24px; fill: #a1a3a8;">
                              <use xlink:href="#addSimple">
                                  <symbol id="addSimple" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13 4h-2v7H4v2h7v7h2v-7h7v-2h-7V4z" clip-rule="evenodd"></path></symbol>
                              </use>
                        </svg>
                      </div>
                 </div>
                 <div class="w-100 text-danger txt-error font-12 mt-1" style="display:none;">متن وارد شده باید حداقل ۳ کاراکتر باشد</div>
             
                </div>
              </div>  
            <div class="d-block mt-4">
                نکات منفی
              </div>  
            <div class="d-block list-native mt-1">
                <div class="d-block element-native-box">
                       <div class="d-flex flex-native mt-2">
                      <input type="text" class="form-control" value="">
                      <div class="btn-native-element">
                          <svg style="width: 24px; height: 24px; fill: #a1a3a8;">
                              <use xlink:href="#addSimple">
                                  <symbol id="addSimple" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M13 4h-2v7H4v2h7v7h2v-7h7v-2h-7V4z" clip-rule="evenodd"></path></symbol>
                              </use>
                        </svg>
                      </div>
                 </div>
                 <div class="w-100 text-danger txt-error font-12 mt-1" style="display:none;">متن وارد شده باید حداقل ۳ کاراکتر باشد</div>
             
                </div>
              </div>  
             <div class="d-block mt-3">
                   متن نظر
                <span class="text-danger">*</span>
            </div> 
            <div class="d-block mt-1">
                <textarea class="form-control message" placeholder="برای ما بنویسید..."></textarea>
            </div>
            <div class="d-block mb-2 mt-3">
                 ارسال محتوا
            </div> 
            <div data-image-uploader data-image-uploader-file-type-regex="(\.jpg|\.jpeg|\.png)$" data-image-uploader-max-file-size="8" class="form__field form__load-img">
              <p class="form__title">حداکثر سه تصویر را می توانید آپلود نمایید   </p>
              <div class="load__img-wrap">
                <div class="load__img-content" data-image-uploader-drop-area>
                  <div class="content__wrapper" data-image-uploader-content>
                    <button type="button" class="blue--btn">
                        افزودن
                        <svg style="width: 32px; height: 32px; fill:#19bfd3;">
                            <use xlink:href="#addCircleOutline">
                            <symbol id="addCircleOutline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2 12c0 5.523 4.477 10 10 10s10-4.477 10-10S17.523 2 12 2 2 6.477 2 12zm18 0a8 8 0 11-16 0 8 8 0 0116 0zm-9-1V7h2v4h4v2h-4v4h-2v-4H7v-2h4z" clip-rule="evenodd"></path></symbol>
                            </use>
                        </svg>
                    </button>
                 
            
                    <div class="upload__TipIcon">
                      <span>
                        <svg viewBox="0 0 17 17" width="17" height="17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g clip-path="url(#a)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 1.955a6.545 6.545 0 1 0 0 13.09 6.545 6.545 0 0 0 0-13.09ZM.5 8.5a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm8-3.636c.402 0 .727.325.727.727V8.5a.727.727 0 0 1-1.454 0V5.59c0-.4.325-.726.727-.726Zm0 5.818a.727.727 0 0 0 0 1.454h.007a.727.727 0 0 0 0-1.454H8.5Z" fill="#767676" />
                          </g>
                          <defs>
                            <clipPath id="a">
                              <path fill="#fff" transform="translate(.5 .5)" d="M0 0h16v16H0z" />
                            </clipPath>
                          </defs>
                        </svg>
                      </span>
                      <div class="upload__Tooltip">
                        <ul class="ps-0 text-right">
                            <li class="font-12 font-weight-300">تصاویر باید در فرمت JPEG,JPG,PNG باشد</li>
                            <li class="font-12 font-weight-300">اندازه فایل ها باید حداکثر 10MB با شد</li>
                            <li class="font-12 font-weight-300">حداکثر 3 تصویر می توانید ارسال نمایید</li>
                            <li class="font-12 font-weight-300">حداقل سایز برای تصاویر 100*100 پیکسل می باشد</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <input type="file" enctype="multipart/form-data" accept=".png, .jpg, .jpeg" multiple style="display: none;">
                </div>
              </div>
              <ul class="validation-summary-errors error__msg margin--top-16 d-none" id="errorMessage" data-image-uploader-errors>
                   <li>تصاویر باید در فرمت JPEG,JPG,PNG باشد</li>
                    <li>اندازه فایل ها باید حداکثر 10MB با شد</li>
                    <li>حداکثر 3 تصویر می توانید ارسال نمایید</li>
                    <li>حداقل سایز برای تصاویر 100*100 پیکسل می باشد</li>
              
              </ul>
              <div class="upload__thumbnails hidden" data-thumbnails-container>
                <div>
                  <div>
                    <span>فایل های آپلود شده:</span>
                    <div class="imgs__wrapper mt-3">
                      <div class="item__imgs" data-image-preview-container>
                        <template data-image-preview>
                          <div class="item__wrapper" data-image-preview-element>
                            <div class="remove__img">
                              <button class="remove__icon" data-removal-button>
                                <svg viewBox="0 0 12 12" width="12" height="12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M12 1.2 10.8 0 6 4.8 1.2 0 0 1.2 4.8 6 0 10.8 1.2 12 6 7.2l4.8 4.8 1.2-1.2L7.2 6 12 1.2Z" fill="#4B4B4B" />
                                </svg>
                              </button>
                            </div>
                            <div class="review__img">
                              <picture>
                                <img style="max-width: 100px; min-width: 100px; min-width: 100px; max-width: 100px"/>
                              </picture>
                            </div>
                          </div>
                        </template>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-check mt-3">
              <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
              <label class="form-check-label" for="flexCheckDefault">
              ارسال دیدگاه به صورت ناشناس
              </label>
            </div>
            <div class="d-block">
                  <hr>
            </div>
            <div class="d-block">
                <button class="form-control btn btn-primary">
                    ثبت امتیاز و دیدگاه
                </button> 
            </div>
           <div class="d-block mt-2 mb-3">
                <p class="text-caption text-center">ثبت دیدگاه به معنی موافقت با<a class="mx-1 text-secondary-500" target="_blank" href="">قوانین انتشار مَه سنتر</a>است.</p>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('scripts')
 <script>
     $(document).on("click",".btn-add-element", function(evt) {
           var myInput =  $(this).closest('.element-box').find('input');
         var myLength =  $(this).closest('.element-box').find('input').val().length;
           var myValue =  $(this).closest('.element-box').find('input').val();
         if(myLength >= 3){
             $(this).closest('.element-box').find('.txt-error').hide(); 
             $(".list-add").append('<div class="d-flex flex-add-item mt-2"> <div> <svg style="width: 20px; height: 20px; fill: #d32f2f;margin-left:5px;" class="ml-1"><use xlink:href="#removeSimple"><symbol id="removeSimple" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 11v2H4v-2h16z"></path></symbol></use> </svg>' + myValue + '</div><div><button type="button"><i class="fal fa-trash-alt"></i></button></div></div>');
             myInput.val(null);
         }
         else{
          $(this).closest('.element-box').find('.txt-error').show(); 
         }
          
        });
     $(document).on("click",".flex-add-item button", function(evt) {
       $(this).closest('.flex-add-item').remove();
      });
     $(document).on("click",".btn-native-element", function(evt) {
           var myInputNative =  $(this).closest('.element-native-box').find('input');
         var myLengthNative =  $(this).closest('.element-native-box').find('input').val().length;
           var myValueNative =  $(this).closest('.element-native-box').find('input').val();
         if(myLengthNative >= 3){
             $(this).closest('.element-native-box').find('.txt-error').hide(); 
             $(".list-native").append('<div class="d-flex flex-native-item mt-2"> <div> <svg style="width: 20px; height: 20px; fill: #d32f2f;margin-left:5px;" class="ml-1"><use xlink:href="#removeSimple"><symbol id="removeSimple" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 11v2H4v-2h16z"></path></symbol></use> </svg>' + myValueNative + '</div><div><button type="button"><i class="fal fa-trash-alt"></i></button></div></div>');
             myInputNative.val(null);
         }
         else{
          $(this).closest('.element-native-box').find('.txt-error').show(); 
         }
          
        });
     $(document).on("click",".flex-native-item button", function(evt) {
       $(this).closest('.flex-native-item').remove();
      });  
     (function (root, factory) {
  'use strict';

  const windowObject = root;

  if (typeof define === 'function' && define.amd) {
    const initFunction = function () {
      windowObject.ImageUploader = factory();
      return root.ImageUploader;
    };

    define([], initFunction);
  } else {
    windowObject.ImageUploader = factory();
  }
}(window, () => {
  'use strict';

  /**
   * @type {File}
   * Creating an empty array that stores in memory the images selected by the user.
   * For more information @see {@link https://developer.mozilla.org/en-US/docs/Web/API/File|MDN}.
   */
  const imageFiles = [];

  /**
   * Creating an object with the configurations that are going to be used for validations.
   */
  const configurations = {
    fileTypeValidationRegex: null,
    maxImageHeight: null,
    maxImageWidth: null,
    maxFilesQuantity: 3,
    maxFileSize: 8,
    minImageHeight: 100,
    minImageWidth: 100,
  };

  /**
   * Creating an object to store the references to the HTML Elements for the Image Uploader UX.
   */
  const htmlElements = {
    component: null,
    contentWrapper: null,
    dropArea: null,
    errorMessages: null,
    imagePreviewContainer: null,
    imagePreviewTemplate: null,
    inputFile: null,
    thumbnailsContainer: null,
    uploadButton: null,
  };

  /**
   * If the image is too big or too small, return false, otherwise return true.
   *
   * @param {number} width - The width of the image in pixels.
   * @param {number} height - The height of the image in pixels.
   * @returns true if the image has the valid dimensions according to the configuration object
   * otherwise false.
   */
  function hasValidDimensions(width, height) {
    const hasMaxWidthValidation = Number.isInteger(configurations.maxImageWidth);
    const hasMaxHeightValidation = Number.isInteger(configurations.maxImageHeight);
    const hasMinWidthValidation = Number.isInteger(configurations.minImageWidth);
    const hasMinHeightValidation = Number.isInteger(configurations.minImageHeight);

    if (hasMaxWidthValidation && width > configurations.maxImageWidth) {
      return false;
    }

    if (hasMaxHeightValidation && height > configurations.maxImageHeight) {
      return false;
    }

    if (hasMinWidthValidation && width < configurations.minImageWidth) {
      return false;
    }

    if (hasMinHeightValidation && height < configurations.minImageHeight) {
      return false;
    }

    return true;
  }

  /**
   * If the number of files in the imageFiles array is greater than or equal to the maxFilesQuantity
   * value in the configurations object, then disable the upload button and add the disable class to
   * the contentWrapper element. Otherwise, enable the upload button and remove the disable class from
   * the contentWrapper element.
   *
   * @returns the value of the disabled property of the uploadButton element.
   */
  function isMaxQuantityFilesReached() {
    if (imageFiles.length >= configurations.maxFilesQuantity) {
      htmlElements.uploadButton.disabled = true;
      htmlElements.contentWrapper.classList.add('disable');
    } else {
      htmlElements.uploadButton.disabled = false;
      htmlElements.contentWrapper.classList.remove('disable');
    }

    return htmlElements.uploadButton.disabled;
  }

  /**
   * Add the image to the imageFiles array if the max quantity of files has not been reached and
   * the image has valid dimensions, otherwise show an error message.
   *
   * If the image is consider valid appends the fragment to the imagePreviewContainer element to let
   * the user see the preview of the image uploaded.
   *
   * @param {File} image - the image file that was selected by the user.
   * @returns the image file if it is considered valid, otherwise null.
   */
  function acceptImage(image) {
    const fragment = this;
    const imageElement = fragment.querySelector('img');

    if (isMaxQuantityFilesReached() || !hasValidDimensions(imageElement.width, imageElement.height)) {
      htmlElements.errorMessages.classList.remove('hidden');
      return null;
    }

    imageFiles.push(image);
    htmlElements.imagePreviewContainer.appendChild(fragment);
    htmlElements.thumbnailsContainer.classList.remove('hidden');

    // Review if the new added image reaches the limit for the max amount of quantity files allowed.
    isMaxQuantityFilesReached();
    return image;
  }

  /**
   * It's a function that when called, will trigger a click event on the input file element.
   * This is used to open the File Selector dialog when the user clicks the uploadButton element.
   */
  function clickInputFile() {
    htmlElements.inputFile.click();
  }

  /**
   * It converts the file size from bytes to Mega Bytes and returns true if the file size is greater
   * than the max file size
   * @param file - The file that is being uploaded.
   * @returns a boolean value.
   */
  function isMaxFileSizeExceeded(file) {
    // Converts the file size from bytes to Mega Bytes.
    const fileSize = file.size / 1024 / 1024;
    return fileSize > configurations.maxFileSize;
  }

  /**
   * When the user selects an image to upload, read and load the image in the memory
   * and trigger the validations processes from @see acceptImage.
   * @param {File} imageFile - The file that is being uploaded by the user.
   */
  function loadImage(imageFile) {
    const reader = new FileReader();
    reader.readAsDataURL(imageFile);
    reader.onload = function () {
      const fragment = document.createRange().createContextualFragment(htmlElements.imagePreviewTemplate.innerHTML);
      const imageElement = fragment.querySelector('img');

      fragment.querySelector('[data-image-preview-element]').dataset.index = imageFiles.length - 1;
      imageElement.onload = acceptImage.bind(fragment, imageFile);
      imageElement.src = reader.result;
    };
  }

  /**
   * Walks through the images selected by the user and performs the validations that don't need
   * the image to be loaded in memory.
   *
   * If the file does not meet the regex expression defined in the configurations object,
   * or if the file is too large, display an error message.
   *
   * @param imagesUploaded - An array of files that were uploaded.
   */
  function readImages(imagesUploaded) {
    htmlElements.errorMessages.classList.add('hidden');

    for (let index = 0; index < imagesUploaded.length; index += 1) {
      const image = imagesUploaded[index];
      const isInvalidFileSize = isMaxFileSizeExceeded(image);
      const isInvalidFileType = configurations.fileTypeValidationRegex &&
                                !configurations.fileTypeValidationRegex.exec(image.name);

      if (isInvalidFileType || isInvalidFileSize) {
        htmlElements.errorMessages.classList.remove('hidden');
      } else {
        loadImage(image);
      }
    }
  }

  /**
   * When a file is dragged over the drop zone HTML element, prevent the default behavior and allow the file to be
   * copied.
   * @param {Event} event - The event object that is passed to the function.
   */
  function onDragOver(event) {
    const eventObject = event;
    event.stopPropagation();
    event.preventDefault();
    eventObject.dataTransfer.dropEffect = 'copy';
  }

  /**
   * When the user drops a file on the drop zone HTML element stops the default browser behavior,  which is to open
   * the file in the browser window. The function then calls the @see readImages function, passing it the files that
   * were dropped.
   *
   * @param {Event} event - The event object that is passed to the function.
   */
  function onDrop(event) {
    event.stopPropagation();
    event.preventDefault();
    readImages(event.dataTransfer.files);
  }

  /**
   * A function that is called when the user selects the images via the uploadButton HTML element.
   * The function then calls the @see readImages function, passing it the files that were dropped.
   *
   * @param event - The event object that is passed to the function.
   */
  function onImagesUploaded(event) {
    const eventObject = event;
    readImages(event.target.files);
    eventObject.target.value = null;
  }

  /**
   * Set the data attibute index to each preview HTML element matching its position in the HTML.
   * This function is called after the @see removeImage function is invoked.
   * If there are no previews, hide the thumbnailsContainer HTML element.
   */
  function resetPreviewIndexes() {
    const previews = document.querySelectorAll('[data-image-preview-element]');

    if (previews.length === 0) {
      htmlElements.thumbnailsContainer.classList.add('hidden');
    }

    for (let index = 0; index < previews.length; index += 1) {
      previews[index].dataset.index = index;
    }
  }

  /**
   * Removes the image from the @see imageFiles array and the DOM. Then resets the index
   * data attribute for the remaining preview images and updates the status of the image uploader
   * by checking if the max quantity of files allowed has been reached.
   *
   * @param {Event} event - The event object that is passed to the function
   * @returns the event.target.closest('[data-removal-button]');
   */
  function removeImage(event) {
    const removalButton = event.target.closest('[data-removal-button]');

    if (!removalButton) {
      return null;
    }

    const previewToRemove = removalButton.closest('[data-image-preview-element]');
    const imageRemoved = imageFiles.splice(previewToRemove.dataset.index, 1);

    previewToRemove.remove();
    resetPreviewIndexes();
    isMaxQuantityFilesReached();

    return imageRemoved;
  }

  /**
   * Adds event listeners to the upload button, the input file, the thumbnails container, and the drop area.
   */
  function addEventListeners() {
    htmlElements.uploadButton.addEventListener('click', clickInputFile);
    htmlElements.inputFile.addEventListener('change', onImagesUploaded);
    htmlElements.thumbnailsContainer.addEventListener('click', removeImage);
    htmlElements.dropArea.addEventListener('dragover', onDragOver);
    htmlElements.dropArea.addEventListener('drop', onDrop);
  }

  /**
   * Sets the @see htmlElements object's properties to the elements within the component.
   *
   * @param {Element} root - The root element of the image uploader component.
   */
  function setHtmlElements(root) {
    htmlElements.component = root;
    htmlElements.contentWrapper = root.querySelector('[data-image-uploader-content]');
    htmlElements.dropArea = root.querySelector('[data-image-uploader-drop-area]');
    htmlElements.errorMessages = root.querySelector('[data-image-uploader-errors]');
    htmlElements.imagePreviewContainer = root.querySelector('[data-image-preview-container]');
    htmlElements.imagePreviewTemplate = root.querySelector('[data-image-preview]');
    htmlElements.inputFile = root.querySelector('input');
    htmlElements.thumbnailsContainer = root.querySelector('[data-thumbnails-container]');
    htmlElements.uploadButton = root.querySelector('button');
  }

  /**
   * Reads the data attributes from the image uploader component HTML element and sets the @see configurations object.
   *
   * @param {Element} root - The root element of the image uploader component.
   */
  function setImageUploaderConfigurations(root) {
    const temporalConfigurations = {};
    temporalConfigurations.maxFilesQuantity = root.dataset.imageUploaderMaxFilesQuantity * 1;
    temporalConfigurations.maxFileSize = root.dataset.imageUploaderMaxFileSize * 1;
    temporalConfigurations.maxImageHeight = root.dataset.maxImageHeight * 1;
    temporalConfigurations.maxImageWidth = root.dataset.maxImageWidth * 1;
    temporalConfigurations.minImageHeight = root.dataset.minImageHeight * 1;
    temporalConfigurations.minImageWidth = root.dataset.minImageWidth * 1;

    Object.keys(temporalConfigurations).forEach((key) => {
      const value = temporalConfigurations[key];

      if (Number.isInteger(value)) {
        configurations[key] = value;
      }
    });
  }

  /**
   * If the fileTypeValidationRegexString is a valid regex, then set the fileTypeValidationRegex to the
   * new RegExp object created from the fileTypeValidationRegexString.
   *
   * @param root - The root element of the image uploader component.
   */
  function setRegexValidations(root) {
    let fileTypeValidationRegex = null;
    let isValidRegex = true;

    const fileTypeValidationRegexString = root.dataset.imageUploaderFileTypeRegex;

    try {
      fileTypeValidationRegex = new RegExp(fileTypeValidationRegexString);
    } catch (e) {
      isValidRegex = false;
    }

    if (fileTypeValidationRegex && isValidRegex) {
      configurations.fileTypeValidationRegex = fileTypeValidationRegex;
    }
  }

  /**
   * The ImageUploader function takes a query as an argument, and creates a set of
   * functions that manipulates the DOM to allow the user to upload files from their computer to the browser.
   *
   * @constructor
   * @param {string} query - The query selector for the root element of the image uploader component.
   * @returns The image uploader object is returned.
   */
  const ImageUploader = function (query) {
    const root = document.querySelector(query);

    if (!root) {
      return null;
    }

    setHtmlElements(root);
    setRegexValidations(root);
    setImageUploaderConfigurations(root);
    addEventListeners();
    return this;
  };

  /* Exposes the files selected by the user to the outside world. */
  ImageUploader.prototype.getFiles = function () {
    return imageFiles;
  };

  return ImageUploader;
}));

new window.ImageUploader("[data-image-uploader]"); 
 </script>
@endsection