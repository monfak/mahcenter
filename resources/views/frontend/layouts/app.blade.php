<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @if(isset($isCategoryPage) && $isCategoryPage)
        <title>@yield('title', $site_settings['title'])</title>
    @else
        <title>@yield('title', $site_settings['title']) - {{ $site_settings['name'] }}</title>
    @endif
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('seo')
    <meta property="og:site_name" content="{{ $site_settings['name'] }}"/>
    <meta name="description" content="@yield('description', $site_settings['description'])"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta property="og:image"
          content="@yield('og_image', 'https://mahcenter.com/storage/images/banners/2021/06/GVjYjkjqVcXIhnnTtvB7f9aWhVePuhNfjLn0DGhpaXzPgfWGTBifjFIbMG41fpZY.jpeg')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content=fa_IR/>
    <meta property="og:type" content="article">
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:description" content="@yield('twitter_description', $site_settings['description'])"/>
    <meta name="twitter:title"
          content="@yield('twitter_title', $site_settings['title']) - {{ $site_settings['name'] }}"/>
    <meta name="twitter:site" content="mahcenter"/>
    <meta name="twitter:creator" content="mahcenter"/>
    <meta name="twitter:url" content="{{ url()->current() }}"/>
    <meta name="twitter:image"
          content="@yield('twitter_image', 'https://mahcenter.com/storage/images/banners/2021/06/GVjYjkjqVcXIhnnTtvB7f9aWhVePuhNfjLn0DGhpaXzPgfWGTBifjFIbMG41fpZY.jpeg')"/>
    {{--<meta name="robots" content="index,follow" />--}}
    <meta name="theme-color" content="#d30404">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="canonical" href="{{ url()->current() }}">
    <script async type=application/ld+json>
    {
      "@context" : "https://schema.org",
      "@type" : "LocalBusiness",
      "name" : "مَه سنتر | فروشگاه اينترنتی انواع لوازم خانگی با بهترین قیمت",
      "address":"تهران-خیابان امین حضور-جنب پاساژ سهامی-پلاک 733",
      "telephone":"02133132398",
      "image" : "https://mahcenter.com/storage/images/banners/2021/06/GVjYjkjqVcXIhnnTtvB7f9aWhVePuhNfjLn0DGhpaXzPgfWGTBifjFIbMG41fpZY.jpeg",
      "url" : "https://mahcenter.com/",
      "sameAs": [ "https://twitter.com/mahcenter",
       "https://plus.google.com/+mahcenter98",
        "https://www.facebook.com/mahcenter98",
       "https://instagram.com/mahcenter98",
       "https://www.linkedin.com/in/mahcenter98"
        ]
    }

    </script>
    <link href="{{ asset('vendor/izitoast/css/iziToast.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/main.min.css?v=1.0.14') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('new-theme/css/template.min.css?v=1.4.32') }}"/>
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon.png">
    <link rel="shortcut icon" sizes="192x192" href="/apple-touch-icon.png">
    <link rel="shortcut icon" sizes="128x128" href="/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="128x128" href="/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="128x128" href="/apple-touch-icon.png">
    @yield('meta')
    @yield('styles')
    @yield('seo')
    @if($site_settings['is_festival_active'])
        <style>
            .badge-festival {
                background: {{ $site_settings['festival_color'] }};
                color: {{ $site_settings['festival_complementary_color'] }};
            }
        </style>
    @endif
</head>
<body>
    @include('frontend.layouts.header')

    <main class="container-fluid body-content ps-0 pe-0">
        @yield('content')
    </main>
    @include('frontend.layouts.footer')
    <script src="{{ asset('new-theme/js/main-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/izitoast/js/iziToast.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var $mobileInput = $('#search-field');
            var $desktopInput = $('#search-input-desktop');
            var $inputs = $mobileInput.add($desktopInput);
            var typingTimer;
            var doneTypingInterval = 300; // time in ms

            function doneTyping($input) {
                var phrase = $input.val();
                if (phrase.length >= 1) {
                    $.ajax({
                        url: '{{ route('search.ajax') }}',
                        method: 'GET',
                        data: {s: phrase.replace("ك", "ک").replace("ي", "ی")},
                        success: function (data) {
                            if (data.length > 0) {
                                $('#result-show').css("display", "block").html(data);
                                $('.example').addClass('dark');
                            } else {
                                $('#result-show').css("display", "none");
                                $('.example').removeClass('dark');
                            }
                        },
                        error: function (jqXhr, textStatus, errorMessage) {
                            console.error('Error: ' + errorMessage);
                        }
                    });
                } else {
                    $("#result-show").css("display", "none");
                    $(".example").removeClass("dark");
                }
            }

            function setupTypingListeners($input) {
                $input.on('keyup', function () {
                    clearTimeout(typingTimer);
                    var phrase = $input.val();
                    typingTimer = setTimeout(function () {
                        doneTyping($input);
                    }, doneTypingInterval);
                });

                $input.on('keydown', function () {
                    clearTimeout(typingTimer);
                });

                $input.on('click focus', function () {
                    clearTimeout(typingTimer);
                    var phrase = $input.val();
                    if (phrase.length >= 1) {
                        doneTyping($input);
                    }
                });


            }

            // Setup listeners for both mobile and desktop inputs
            setupTypingListeners($mobileInput);
            setupTypingListeners($desktopInput);
        });
        $('.example').on('click', function () {
            $("#result-show").css("display", "none");
        });
    </script>
    @yield('scripts')

    <script src="{{ asset('js/custom.js?v=1.0.54') }}"></script>
    <script type="text/javascript" src="https://s1.mediaad.org/serve/73981/retargeting.js" async></script>
    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "mvxz1z78cc");

        $(document).on('click', '#dropdownMenuButton1', function (event) {
            event.preventDefault();
            window.location.href = '{{ url('cart') }}';
        });
    </script>
    <script type="text/javascript">
        window.RAYCHAT_TOKEN = "862405a2-6717-400a-a0c4-1d38be1769a9";
        (function () {
            d = document;
            s = d.createElement("script");
            s.src = "https://widget-react.raychat.io/install/widget.js";
            s.async = 1;
            d.getElementsByTagName("head")[0].appendChild(s);
        })();
    </script>

    @include('frontend.layouts.partials.message')
</body>
</html>
