<x-layouts.app>

    <style>
        body {
            background: linear-gradient(180deg, #002B49 0%, rgba(0, 2, 11, 1) 100%);
            background-repeat: no-repeat;
            min-height: 100vh;
            font-family: "Futura";
        }
    </style>
    <main class="pb-8 min-h-[100vh] h-full relative lg:w-[30vw] mx-auto">

        <background class="h-full w-[100vw]  absolute -z-10 top-0 right-0">
            <img src="img/bg.svg" class="w-full h-[100%]">
        </background>
        <x-layouts.header />
        <article class="px-[26px]">
            <flex class="flex text-white   mt-8 mb-1 justify-between items-center">
                <subject class="block font-semibold">Select your lands</subject>
                <counter class="block">Page : <current_page>1</current_page>/3</counter>
            </flex>


            <maps>
                <map page="1" class="mx-auto items-center justify-center h-[340]  relative flex">
                    <canvas id="canvas1"></canvas>
                </map>

                <map page="2" class=" mx-auto items-center justify-center h-[340]  relative flex"
                    style="display: none">
                    <canvas id="canvas2"></canvas>
                </map>

                <map page="3" class=" mx-auto items-center justify-center h-[340]  relative flex"
                    style="display: none">
                    <canvas id="canvas3"></canvas>
                </map>
            </maps>



            <labels class="mt-2 mb-2     block">

                @php
                    $lands = [
                        0 => [
                            'text' => 'Free lands',
                            'color' => '#2ac161',
                        ],
                        1 => [
                            'text' => 'Owned ',
                            'color' => '#fbfbfb',
                        ],
                        2 => [
                            'text' => 'Selected',
                            'color' => '#ff33e7',
                        ],
                    ];
                @endphp
                @foreach ($lands as $land)
                    <label
                        class=" rounded bg-white  text-sm filter bg-opacity-5 border border-white border-opacity-20 py-1  text-white gap-1 px-3   items-center justify-center w-max inline-flex">
                        <land class="w-[12px]  h-[12px] rounded-sm bg-[{{ $land['color'] }}] block"></land>
                        <text class="block">
                            {{ $land['text'] }}
                        </text>
                    </label>
                @endforeach

            </labels>
            <controller>
                <flex class="flex items-center mt-2 justify-between">
                    <left>
                        <flex class="flex text-white    items-center justify-between gap-1">
                            <button_select
                                class="rounded hidden  bg-[#009bdc] text-[18px] h-[32px] gap-1 flex items-center justify-center w-[94px]">
                                <span><img src="{{ asset('img/plus.svg') }}"></span>
                                <span>Select</span>
                            </button_select>
                            <button_clear
                                class="rounded  bg-[#009bdc] text-[18px] h-[32px] gap-1 flex items-center justify-center w-[94px]">
                                <span><img src="{{ asset('img/trash.svg') }}"></span>
                                <span>Clear</span>
                            </button_clear>
                        </flex>
                    </left>
                    <right>

                        <flex class="flex text-white    items-center justify-between gap-1">
                            <button_back
                                class="rounded grayscale   bg-[#009bdc] text-[18px] h-[32px] gap-1 flex items-center justify-center w-[32px]">
                                <span><img src="{{ asset('img/left.svg') }}"></span>
                            </button_back>
                            <button_next
                                class="rounded   bg-[#009bdc] text-[18px] h-[32px] gap-1 flex items-center justify-center w-[32px]">
                                <span><img src="{{ asset('img/right.svg') }}"></span>
                            </button_next>

                        </flex>
                    </right>
                </flex>
            </controller>
            <mini_card>
                <flex class="justify-between text-white flex items-center mt-4">
                    <left>
                        <text class="block">You selected <activeLands>0</activeLands> lands</text>
                        <text class="block">Total Price : <activeLandsPrice>0.0</activeLandsPrice> Toman </text>
                    </left>
                    <right>
                        <boropage
                            class=" bg-gradient-to-b block from-[#00A1D3] to-[#003867] text-center text-white font-semibold leading-[42px] h-[42px] w-[100px] rounded">
                            Submit</boropage>
                    </right>
                </flex>
            </mini_card>
        </article>
    </main>

    @php
        $landsHasOwner = \App\Models\Land::where('status', 1)->get();
        
    @endphp
    <input class="JSC_ACTIVE_LANDS" type="hidden"
        value="@foreach ($landsHasOwner as $value){{ $value->flag }} @endforeach">


    <script>
        var maps_current_page = 1;
        $('button_next').on('click', function() {
            if (maps_current_page != 3) {
                maps_current_page = maps_current_page + 1;
            }
            map_page_on_change()
        });
        $('button_back').on('click', function() {
            if (maps_current_page != 1) {
                maps_current_page = maps_current_page - 1;
            }
            map_page_on_change()
        });

        function map_page_on_change() {
            $('current_page').html(maps_current_page);
            maps_current_page == 3 ? $('button_next').addClass('grayscale') : $('button_next').removeClass('grayscale');
            maps_current_page == 1 ? $('button_back').addClass('grayscale') : $('button_back').removeClass('grayscale');
            $('map').each(function() {
                $(this).attr('page') == maps_current_page ? $(this).show() : $(this).hide();
            })
        }
    </script>

    <script src="{{ asset('js/fabric.min.js') }}"></script>
    <script>
        window.canvas1 = new fabric.Canvas('canvas1');
        window.canvas2 = new fabric.Canvas('canvas2');
        window.canvas3 = new fabric.Canvas('canvas3');

        var green = "#2ac161";
        var purple = "#ff33e7";
        var gray = "#fbfbfb";
    </script>

    <x-map_1></x-map_1>
    <x-map_2></x-map_2>
    <x-map_3></x-map_3>
    <script>
        var activeObjectsCount = 0;
        var LANDPRICE = 45000;

        function getActiveItemsCount() {
            activeObjectsCount = 0;
            canvases.forEach(element => {
                element.forEachObject(function(obj) {
                    if (obj.fill == purple) {
                        activeObjectsCount++;
                    }
                });
            });
            $('activeLands').html(activeObjectsCount)
            $('activeLandsPrice').html(activeObjectsCount * LANDPRICE)
        }

        function clearSelectedLands() {
            canvases.forEach(element => {
                element.forEachObject(function(obj) {
                    obj.set({
                        fill: green,
                        selectable: true,
                    });

                });

                element.forEachObject(function(obj) {
                    if ($.inArray(obj.id, ACTIVE_LAND_IDS) != -1) {
                        obj.set({
                            fill: gray,
                            selectable: false,
                        });
                    }
                });



                element.renderAll();
                activeObjectsCount = 0;
            })
            $('activeLands').html(activeObjectsCount)
            $('activeLandsPrice').html(activeObjectsCount * LANDPRICE)
        }

        $('button_clear').click(function() {
            clearSelectedLands();
        });
    </script>
    <script>
        var gheymat = 10;
    </script>


    <script>
        var canvases = [canvas1, canvas2, canvas3];
        canvases.forEach(element => {
            /********
             * SIZE *
             ********/
            element.setDimensions({
                width: 310,
                height: 310
            })
            element.setZoom(0.28);
            /******************
             * OBJECT_ON_LOAD *
             ******************/
            element.forEachObject(function(obj) {
                obj.set({
                    lockScalingX: true,
                    lockScalingY: true,
                    lockMovementX: true,
                    lockMovementY: true,
                    hasBorders: false,
                    hasControls: false,
                    lockUniScaling: true,
                });

            });
            /********************
             * DISABLE_ACTIVE_LANDS *
             ********************/
            window.ACTIVE_LAND_IDS = $('.JSC_ACTIVE_LANDS').val().split(' ');
            ACTIVE_LAND_IDS.push('x1id201')
            ACTIVE_LAND_IDS.push('x2id201')
            ACTIVE_LAND_IDS.push('x3id201')
            element.forEachObject(function(obj) {
                if ($.inArray(obj.id, ACTIVE_LAND_IDS) != -1) {
                    obj.set({
                        fill: gray,
                        selectable: false,
                    });
                }
            });




            /********************
             * OBJECT_ON_SELECT *
             ********************/
            element.on('selection:created', function(ev) {
                console.log(ev.selected[0].id);
                ev.selected.forEach(element => {
                    element.set({
                        fill: purple,
                        selectable: false,
                    })
                });
                getActiveItemsCount()
            })
            /**********************
             * CANVAS_ON_MOUSE_UP *
             **********************/
            element.on('mouse:up', function(ev) {
                element.discardActiveObject();
            })


        });
    </script>
    <form method="POST" action="{{ route('.page_2') }}">
        @csrf
        <input class="BUYED_LANDS_TO_NEXT_PAGE" type="hidden" name="BUYED_LAND_IDIS">
    </form>
    <script>
        var BUYED_LANDS_IDS = [];
        $('boropage').on('click', function() {
            BUYED_LANDS_IDS = [];


            canvases.forEach(element => {
                element.forEachObject(function(obj) {
                    if (obj.fill == purple) {
                        BUYED_LANDS_IDS.push(obj.id);
                    }
                });
            });

            BUYED_LANDS_IDS = BUYED_LANDS_IDS.filter(item => item);
            $('.BUYED_LANDS_TO_NEXT_PAGE').val(BUYED_LANDS_IDS);
            if (BUYED_LANDS_IDS.length == 0) {
                alert('You should at least select one land');
            } else {
                $('form').submit();
            }

        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.18/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.18/css/intlTelInput.css">
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            separateDialCode: true,
            initialCountry: "IR",
        });
    </script>
</x-layouts.app>
