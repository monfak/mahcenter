@extends('frontend.layouts.app')
@section('title', $site_settings['b2b_title'])
@section('description', $site_settings['b2b_description'])
@section('content')
      <div class="container-fluid banner-inner">
         <div class="container">
           <div class="row align-items-center">
             <div class="col-md-6">
               <div class="row">
                 <div class="col-md-10">
                  <h1 class="title-inner-banner mb-4">{!! $site_settings['b2b_heading'] !!}</h1>
                  <div class="ts-text-dark inline-block">{!! $site_settings['b2b_intro_content'] !!}</div>
                  <div class="ts-text-dark block text-sm">{!! $site_settings['b2b_intro_box_content'] !!}</div>
                  <div class="d-block mt-4">
                     <a href="tel:{{ str_replace('-', '', $site_settings['b2b_intro_contact_phone']) }}" class="btn btn-primary">{{ $site_settings['b2b_intro_contact_text'] }}</a>
                  </div>
                </div>
               </div>
             </div>
             <div class="col-md-6">
                <img src="{{ asset($site_settings['b2b_intro_image']) }}" class="img-fluid" alt="خرید عمده از مه سنتر">
             </div>
           </div>
         </div>
      </div>
      <div class="container-fluid pt-5 pb-5 bg-gray ">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-10 mx-auto col-12 p-0">
              <h2 class="ts-text-dark mb-8 text-center text-2xl font-bold">
               {!! $site_settings['b2b_why_heading'] !!}
              </h2>
              <div class="text-body mb-0 d-block text-justify mt-4">
              {!! $site_settings['b2b_why_content'] !!}
              </div>
            </div>
          </div>
          <div class="row mt-5 mb-5 row-item">
            @foreach($steps->items as $step)
            <div class="col-md-4 col-12 mt-3 mb-3 tml-card-box">
              <div class="d-block img-text">
                 <img src="{{ asset($step->image) }}" class="img-fluid" alt="{{ $step->title }}">
              </div>
              <div class="mt-2 text-body  position-relative tml-card">
                {{ $step->content }}
              </div>
            </div>
            @endforeach
          </div>
          <div class="row align-items-center mt-3">
            <div class="col-lg-10 mx-auto col-12 p-0">
              <h2 class="ts-text-dark mb-8 text-center text-2xl font-bold">
               {!! $site_settings['b2b_trust_heading'] !!}
              </h2>
              <div class="text-body mb-0 d-block text-justify mt-4">
              {!! $site_settings['b2b_trust_content'] !!}
              </div>
            </div>
          </div>
        </div>
     </div>
     <div class="container-fluid pb-5">
      <div class="container p-0">
        <div class="row">
          <div class="col-md-6 col-12 pt-4">
            <h2 class="text-dark mb-2 text-center text-lg font-bold ">سوالات قبل از خرید عمده</h2>
            <div class="row accordion mt-3" id="accordionFq1">
              @foreach($beforeFaqs as $faq)
              <div class="col-12 mb-3">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="heading{{ $faq->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">{{ $faq->heading}}</button>
                  </h3>
                  <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionFq1">
                    <div class="accordion-body">{!! $faq->content !!}</div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-md-6 col-12 pt-4">
            <h2 class="text-dark mb-2 text-center text-lg font-bold ">سوالات بعد از خرید عمده </h2>
            <div class="row accordion mt-3" id="accordionFq2">
                @foreach($afterFaqs as $faq)
                  <div class="col-12 mb-3">
                    <div class="accordion-item">
                      <h3 class="accordion-header" id="heading{{ $faq->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">{{ $faq->heading}}</button>
                      </h3>
                      <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#accordionFq2">
                        <div class="accordion-body">{!! $faq->content !!}</div>
                      </div>
                    </div>
                  </div>
                @endforeach
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">{{ $site_settings['b2b_banners_1_heading'] }}</h3>
                <div class="d-block img-boxt">
                  <img src="{{ asset($site_settings['b2b_banners_1_image']) }}" class="img-fluid" alt="{{ $site_settings['b2b_banners_1_heading'] }}">
                </div>
                <div class="d-block mt-2  text-box">
                  {!! $site_settings['b2b_banners_1_content'] !!}
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="{{ $site_settings['b2b_banners_1_url'] }}" class="w-100 btn btn-success font-12">{{ $site_settings['b2b_banners_1_text'] }}</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">{{ $site_settings['b2b_banners_2_heading'] }}</h3>
                <div class="d-block img-boxt">
                  <img src="{{ asset($site_settings['b2b_banners_2_image']) }}" class="img-fluid" alt="{{ $site_settings['b2b_banners_2_heading'] }}">
                </div>
                <div class="d-block mt-2  text-box">
                  {!! $site_settings['b2b_banners_2_content'] !!}
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="{{ $site_settings['b2b_banners_2_url'] }}" class="w-100 btn btn-success font-12">{{ $site_settings['b2b_banners_2_text'] }}</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">{{ $site_settings['b2b_banners_3_heading'] }}</h3>
                <div class="d-block img-boxt">
                  <img src="{{ asset($site_settings['b2b_banners_3_image']) }}" class="img-fluid" alt="{{ $site_settings['b2b_banners_3_heading'] }}">
                </div>
                <div class="d-block mt-2  text-box">
                  {!! $site_settings['b2b_banners_3_content'] !!}
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="{{ $site_settings['b2b_banners_3_url'] }}" class="w-100 btn btn-success font-12">{{ $site_settings['b2b_banners_3_text'] }}</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12 mt-3">
            <div class="card crd-pro">
              <div class="card-body ext-center">
                <h3 class="text-primary mb-0 title-box">{{ $site_settings['b2b_banners_4_heading'] }}</h3>
                <div class="d-block img-boxt">
                  <img src="{{ asset($site_settings['b2b_banners_4_image']) }}" class="img-fluid" alt="{{ $site_settings['b2b_banners_4_heading'] }}">
                </div>
                <div class="d-block mt-2  text-box">
                  {!! $site_settings['b2b_banners_4_content'] !!}
                </div>
                <div class="d-block mt-3 text-center">
                  <a href="{{ $site_settings['b2b_banners_4_url'] }}" class="w-100 btn btn-success font-12">{{ $site_settings['b2b_banners_4_text'] }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
@endsection