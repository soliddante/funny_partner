<x-layouts.app>

    <style>
        body {
            background: linear-gradient(180deg, #002B49 0%, rgba(0, 2, 11, 1) 100%);
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: "Futura";
        }

        star {
            color: rgb(255, 70, 70);

        }
    </style>
    <main class="pb-8 min-h-[100vh] h-full relative lg:w-[30vw] mx-auto">



        <background class="h-full w-[100vw]  absolute -z-10 top-0 right-0">
            <img src="img/bg.svg" class="w-full h-[100%]">
        </background>
        <x-layouts.header />
        <form method="POST" action="{{ route('.kharid') }}">
            @csrf
            <input type="hidden" name="user_buyed_lands" value="{{ $data }}">
            <article class="px-[26px]">
                <title class="block text-white mt-2 font-medium">Card:</title>
                <subtitle class="block text-white ">You signed <TEDAD>0</TEDAD> lands for <GHEYMAT>0.0</GHEYMAT> Toman
                </subtitle>
                <lands class="flex  flex-wrap   gap-1">
                </lands>

                <title class="block mt-2 text-white font-medium"> Enter your information : </title>
                <grid class="grid grid-cols-2 gap-2">
                    <column class="col-span-1">
                        <label class="block">
                            <span class="text-white text-sm">Firstname <star>*</star></span>
                            <input placeholder="John" type="text" name="firstname"
                                class="h-[35px] leading-[35px] block w-full border-0 rounded">
                        </label>
                    </column>
                    <column class="col-span-1">
                        <label class="block">
                            <span class="text-white text-sm">Lastname <star>*</star></span>
                            <input placeholder="Doe" type="text" name="lastname"
                                class="h-[35px] leading-[35px] block w-full border-0 rounded">
                        </label>
                    </column>
                    <column class="col-span-2">
                        <label class="block relative">
                            <image src="img/mail.svg" class="absolute top-[32px] w-[20px] h-[20px]  left-2"></image>
                            </image>
                            <span class="text-white text-sm">Email <star>*</star></span>
                            <input type="text" name="email"
                                class="h-[35px] leading-[35px] pl-10 block  w-full  border-0 rounded"
                                placeholder="email@example.com">
                        </label>
                    </column>
                    <column class="col-span-2">
                        <label class="block relative">
                            <image src="img/key.svg" class="absolute top-[32px] w-[20px] h-[20px]  left-2"></image>
                            </image>
                            <span class="text-white text-sm">Password <star>*</star></span>
                            <input type="password" name="password"
                                class="h-[35px] leading-[35px] pl-10 block w-full  border-0 rounded"
                                placeholder="********">
                        </label>
                    </column>
                    </column>
                    <column class="col-span-2">
                        <label class="block relative">
                            <image src="img/key.svg" class="absolute top-[32px] w-[20px] h-[20px]  left-2"></image>
                            </image>
                            <span class="text-white text-sm">Password Confrimation <star>*</star></span>
                            <input type="password" name="password_confrimation"
                                class="h-[35px] leading-[35px] pl-10 block  w-full  border-0 rounded"
                                placeholder="********">
                        </label>
                    </column>

                    <column class="col-span-2">
                        <label class="block relative">
                            <span class="text-white text-sm">Phone <star>*</star></span>
                            <input name="phone" type="number" id="phone" />
                        </label>
                    </column>
                    <column class="Sol-span-2 hidden">
                        <label class=" relative flex items-start">
                            <input type="checkbox" name="checkbox" class="mt-1 rounded mr-1 block">
                            <span class="text-white text-sm"></span>
                        </label>
                    </column>
                    <column class="col-span-2 mt-4">
                        <right>
                            <thebutton disableAst="true" type="submit"
                                class="grayscale bg-gradient-to-b block from-[#00A1D3] to-[#003867] text-center text-white font-semibold leading-[42px] h-[42px] w-full rounded">
                                Payment</thebutton>
                        </right>
                    </column>

                </grid>
            </article>
        </form>
    </main>
    {{-- /**********
 * SCRIPT *
 **********/ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.18/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.18/css/intlTelInput.css">
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "IR",
        });
    </script>

    <script>
        var PRICE = 45000;
        user_buyed_lands = document.querySelector('input[name="user_buyed_lands"]').value;
        var lands = user_buyed_lands.split(',');
        lands = lands.filter(function(land) {
            return land != '';
        });
        $('tedad').html(lands.length);
        $('gheymat').html(lands.length * PRICE);
        for (i = 0; i < lands.length; i++) {
            document.querySelector('lands').insertAdjacentHTML("beforeend",
                `<rect class="bg-[#009120] w-[14px] h-[14px]"></rect>`)
        }
    </script>
    <script>
        var flag1 = $('input[name="firstname"]').val().length > 3;
        var flag2 = $('input[name="lastname"]').val().length > 3;
        var flag3 = $('input[name="email"]').val().length > 3;
        var flag4 = $('input[name="password"]').val().length > 3;
        var flag5 = $('input[name="password_confrimation"]').val().length > 3;
        var flag6 = $('input[name="phone"]').val().length > 3;
        $('body').on('keydown keyup mouseover', function() {

            flag1 = $('input[name="firstname"]').val().length > 3;
            flag2 = $('input[name="lastname"]').val().length > 3;
            flag3 = $('input[name="email"]').val().length > 3 && $('input[name="email"]').val().includes('@') && $(
                'input[name="email"]').val().includes('.');
            flag4 = $('input[name="password"]').val().length > 3 && $('input[name="password"]').val() == $(
                'input[name="password_confrimation"]').val();
            flag5 = $('input[name="password_confrimation"]').val().length > 3 && $('input[name="password"]')
            .val() == $('input[name="password_confrimation"]').val();
            flag6 = $('input[name="phone"]').val().length > 6;
            if (flag1 && flag2 && flag3 && flag4 && flag5 && flag6) {
                $('thebutton').attr('disableAst', 'false');
                $('thebutton').removeClass('grayscale');
            } else {
                $('thebutton').attr('disableAst', 'true');
                $('thebutton').addClass('grayscale');
            }
        });

        $('thebutton').on('click', function(e) {
            console.log($(this).attr('disableAst'));
            if ($(this).attr('disableAst') == 'true') {
                alert('Please fill all fields');
            } else {
                $('form').submit();
            }
        })
    </script>
</x-layouts.app>
