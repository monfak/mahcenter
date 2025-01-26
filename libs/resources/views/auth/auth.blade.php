<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
    <meta name="theme-color" content="#e82d2d" />
    <title>ورود به فروشگاه مه سنتر</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/auth.css?v=1.0.0"/>
    <link href="{{ asset('vendor/izitoast/css/iziToast.min.css') }}" rel="stylesheet">
    <script  type="text/javascript" src="{{ asset('vendor/izitoast/js/iziToast.min.js') }}" ></script>
    <style>
        .d-none {
            display: none;
        }
        input {
            padding-left: 8px;
        }
    </style>
</head>
<body>
    <main class="min-h-full w-full flex items-center flex-col  justify-center">
        <div class="accountWrapper p-5">
            <div class="d-block position-relative  w-full text-center">
                <span id="back" class="icon-lnk d-inline-block d-none">
                    <a href="{{ route('login') }}">
                        <svg style="width: 24px; height: 24px; fill: var(--color-icon-high-emphasis);">
                            <use xlink:href="#arrowRight">
                                <symbol id="arrowRight" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.707 19.707l-1.414-1.414L16.586 13H4v-2h12.586l-5.293-5.293 1.414-1.414 7 7a1 1 0 010 1.414l-7 7z" clip-rule="evenodd"></path></symbol>
                            </use>
                        </svg>
                    </a>
                </span>
                <a class="d-block" href="{{ url('/') }}">
                    <img src="https://mahcenter.com/new-theme/images/logo.png" alt="مه‌سنتر" class="img-fluid">
                </a>
            </div>
            <h1 id="heading" class="text-h4 text-neutral-900 text-right w-full mt-4">ورود | ثبت‌نام</h1>
            <p id="description" class="text-body-2 text-neutral-700 mt-4 mb-2 text-right w-full">سلام!
            <br>
            لطفا شماره موبایل یا ایمیل خود را وارد کنید</p>
            @include('frontend.layouts.partials.input-errors')
            <form id="form" method="POST" action="" class="w-full mt-4 frm">
                @csrf
                <div id="inputs-wrapper" class="d-block w-full">
                    <input type="hidden" id="type" name="type" value="">
                    <input class="text-subtitle w-full text-subtitle w-full rounded-medium" type="text" name="username" id="username" autocomplete="on" dir="ltr">
                    <input class="text-subtitle w-full text-subtitle w-full rounded-medium d-none" type="password" name="password" id="password" autocomplete="off" dir="ltr">
                    <input class="text-subtitle w-full text-subtitle w-full rounded-medium d-none" type="number" name="otp" id="otp" autocomplete="off" dir="ltr">
                    <p id="error" class="text-body-2 text-hint-text-error"></p>
                    <div class="w-full mb-6 mt-4 mb-2 text-caption user-select-none text-neutral-700 d-none send-otp-wrapper">
                        <span class="flex items-center text-secondary-500 mx-2 cursor-pointer send-otp">
                            ورود از طریق رمز یکبار مصرف 
                            <div class="flex">
                                <svg style="width: 20px; height: 20px; fill: #008eb2;">
                                    <use xlink:href="#chevronLeft">
                                        <symbol id="chevronLeft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M11.414 12l4.293 4.293-1.414 1.414-5-5a1 1 0 010-1.414l5-5 1.414 1.414L11.414 12z"></path>
                                        </symbol>
                                    </use>
                                </svg>
                            </div>
                        </span>
                    </div>
                </div>
                <div id="timer-wrapper" class="d-block w-full d-none">
                    <p class="text-body-2 text-center mt-4 mb-6 text-neutral-700">
                        <span>2:50</span>
                        <span>مانده تا دریافت مجدد کد</span>
                    </p>
                    <div class="w-full flex items-center justify-center mb-6 mt-4 mb-2 text-caption user-select-none text-neutral-700">
                        دریافت مجدد کد از طریق 
                        <span class="flex items-center text-secondary-500 mx-2 cursor-pointer">
                            پیامک 
                            <div class="flex">
                                <svg style="width: 20px; height: 20px; fill: #008eb2;">
                                    <use xlink:href="#chevronLeft">
                                        <symbol id="chevronLeft" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M11.414 12l4.293 4.293-1.414 1.414-5-5a1 1 0 010-1.414l5-5 1.414 1.414L11.414 12z"></path>
                                        </symbol>
                                    </use>
                                </svg>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="d-block w-full mt-8">
                    <button type="submit" id="submit-button" class="btn btn-primarty w-full step1">ورود</button>
                </div>
            </form>
            <p id="accept-tos" class="text-caption text-neutral-700 mt-4">
                ورود شما به معنای پذیرش
                <a class="mx-1 inline-block text-secondary-700" href="">شرایط مه سنتر</a>
                و
                <a class="mx-1 inline-block text-secondary-700" href="">قوانین حریم‌خصوصی</a>
                است.
            </p>
        </div>
    </main> 
    <script src="{{ asset('new-theme/js/main-min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function getAuthData(sendOtp = false) {
                var username = $('#username').val();
                $.ajax({
                    type: 'POST',
                      url: "{{ route('auth') }}",
                    data: {
                        'username': username,
                        'send-otp': sendOtp,
                    },
                    success: function(response) {
                        if(response.status == 'success') {
                            if(response.heading) {
                                $('#heading').html(response.heading);
                            }
                            $('#description').html(response.description);
                            $('#link').html(response.link);
                            $('#submit-button').html(response.button);
                            $('#submit-button').removeClass('step1');
                            $('#back').removeClass('d-none');
                            $('#accept-tos').addClass('d-none');
                            $('#username').addClass('d-none');
                            $('#password').addClass('d-none');
                            $('#otp').addClass('d-none');
                            $('#' + response.passwordType).removeClass('d-none');
                            $('#type').val(response.usernameType);
                            $('#form').attr('action', response.formAction);
                            if(response.usernameType == 'mobile' && response.passwordType == 'password') {
                                $('.send-otp-wrapper').removeClass('d-none');
                            }
                        } else {
                            if(response.toast) {
                                iziToast.error({
                                    title: 'خطا',
                                    message: response.toast,
                                    'position': 'topLeft'
                                });
                                $('#error').html(response.toast);
                                $('#inputs-wrapper').addClass('error');
                            }
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            }
            $(document).on('click', '.step1', function (event) {
                event.preventDefault();
                getAuthData();
            });
            $(document).on('click', '.send-otp', function (event) {
                event.preventDefault();
                $('.send-otp-wrapper').addClass('d-none');
                getAuthData(true);
            });
            $(document).on('keyup keydown change', '#username', function() {
                $('#error').html('');
                $('#inputs-wrapper').removeClass('error');
            });
            $(".alert").delay(4000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
    </script>
</body>
</html>
