<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('font/load.css') }}">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        main_menu {
            background: linear-gradient(180deg, #002B49 0%, rgba(0, 2, 11, 1) 100%);
        }

        inside a.active {
            font-weight: 500;
            opacity: 1 !important;
        }
    </style>
</head>

<body class="antialiased">
    <main_menu class="fixed hidden top-0 w-screen h-screen z-[100] left-0 ">
        <flex class="flex items-center justify-center absolute top-0 right-0 left-0 bottom-0 m-auto  ">
            <menuicon_close
                class="text-3xl rounded-full border border-white w-[32px] h-[32px] flex items-center justify-center fixed top-7 right-7 cursor-pointer text-white">
                &times;
            </menuicon_close>
            <background class="h-full w-[100vw] absolute -z-10 top-0 right-0">
                <img src="img/bg.svg" class="w-full   h-[100%]">
            </background>
            <inside class="block  filter p-4 text-white  text-2xl space-y-6 ">
                <a href="#" class="block filter font-light active opacity-80  "> Partner Shop</a>
                <a href="#" class="block filter font-light opacity-80 "> Client Registration</a>
                <a href="#" class="block filter font-light opacity-80 "> Painting Application</a>
                <a href="#" class="block filter font-light opacity-80 "> Book Application </a>
            </inside>
        </flex>
    </main_menu>

    {{ $slot }}
</body>
<script>
    $('menuicon').on('click', function() {

        $('main_menu').fadeIn();

    });

    $('menuicon_close').on('click', function() {

        $('main_menu').fadeOut();
    });
</script>

</html>
