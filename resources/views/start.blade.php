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
                class="text-[48px] font-extrabold text-white text-center block mx-auto drop-shadow-[0px_0px_9px_#0092C4]">
                FunnySale
            </subject>
            <subtitle class="text-center block mx-auto text-white text-[18px]">
                Funnybox lands presale
            </subtitle>
            <i class="mb-[24px] text-center block mx-auto text-white text-[16px] font-medium">
                It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at
                its layout.
            </i>
            <a href="{{ route('.page_1') }}"
                class=" transform scale-90 bg-gradient-to-b from-[#00A1D3]  to-[#003867] text-[24px] cursor-pointer leading-[62px] block mx-auto w-[300px] h-[62px] text-center text-white font-bold rounded-full ">
                Become LandLord
            </a>
        </article>
    </main>

</x-layouts.app>
