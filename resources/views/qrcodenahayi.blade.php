<x-layouts.app>
    <!DOCTYPE html>
    <style>
        body {
            background: linear-gradient(180deg, #002B49 0%, rgba(0, 2, 11, 1) 100%);
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: "Futura";
            height: 100%;
        }
    </style>
    <main class="pb-8 min-h-[100vh] h-full relative lg:w-[30vw] mx-auto">

        <background class="h-full w-[100vw] absolute -z-10 top-0 right-0">
            <img src="img/bg.svg" class="w-full   h-[100%]">
        </background>
        <x-layouts.header />
        <article class="px-[26px]">
            <hero class="block mx-auto w-full mt-[84px]">
                <img src="img/home.png" class="block  mx-auto w-full">
            </hero>
            <subject
                class="text-xl mt-2 font-extrabold text-white text-center block mx-auto drop-shadow-[0px_0px_9px_#0092C4]">
                Your FunnyBox Token is here!
            </subject>
            <subtitle class="text-center text-sm mt-2 block mx-auto text-white text-[18px]">
                Save it until the lazymint lunched.
            </subtitle>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
            <div class="mx-auto block w-[210px] bg-white rounded p-[6px] mt-4 h-[210px]">
                <canvas id="qr"></canvas>
            </div>
            <a href="#" class="jsc_downlod block mt-4 mx-auto  w-max   rounded bg-white px-3 py-1 text-center "
                style="display: none;">Download QRcode</a>
            <script type="text/javascript">
                (function() {
                    var qr = new QRious({
                        element: document.getElementById('qr'),
                        value: "https://funnybox.io/partner/public/qrx/data=?{{ $etelaatkharid }}",
                        background: '#ffffff',
                        foreground: '#000000',
                        size: 200,
                        padding: 0
                    });
                })();
                thelink = $('.jsc_downlod');
                thelink.attr('download', 'QRCode.png');
                thelink.attr('href', document.getElementById('qr').toDataURL());
                console.dir($('body').find('#qrcode').children('img')[0]);
                $('.jsc_downlod').attr('href', $('body').find('#qrcode').find('img').attr('src'));
                $('.jsc_downlod').show();
            </script>
        </article>
    </main>

</x-layouts.app>
