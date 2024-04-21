<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>
<body class="w-full h-screen bg-[#fefefe]">
    {{-- Top bar --}}
    <div class="w-full flex items-center h-[8%] px-20 border-b border-bd">
        <div class="w-1/6">
            <p class="text-lg font-semibold">MAMITA'S</p>
        </div>
        <div class="w-10/12">
            <form action="">
                <input type="search" name="search" placeholder="Search here ..." class="py-1 px-4 outline-none w-1/2 border border-bd rounded-full">
            </form>
        </div>
    </div>
    {{-- main --}}
    <div class="w-full flex h-[92%]">
        {{-- navigations --}}
        <div class="w-[5%] border-r border-bd py-6">
            <div class="flex w-full flex-col items-center justify-center mb-8">
                <img src="{{asset('images/home-hover.png')}}" alt="Home Icon" class="w-1/3">
                <p class="text-xs text-main">Home</p>
            </div>
            <div class="flex w-full flex-col items-center justify-center mb-8">
                <img src="{{asset('images/cashier.png')}}" alt="Cashier Icon" class="w-1/3">
                <p class="text-xs">Cashier</p>
            </div>
            <div class="flex w-full flex-col items-center justify-center">
                <img src="{{asset('images/history.png')}}" alt="Cashier Icon" class="w-1/3">
                <p class="text-xs">History</p>
            </div>
        </div>
        {{-- POS --}}
        <div class="w-[95%] flex">
            {{-- selection --}}
            <div class="w-3/4 p-6 bg-[#e5e5e5]">
                <div class="w-1/2 mb-6">
                    <form action="" method="GET" class="w-full flex justify-between items-center py-2 px-5 text-sm bg-[#fefefe] rounded-full">
                        @csrf
                        <button class="text-main">Breakfast</button>
                        <button class="hover:text-main transition duration-100 ease-in-out">Lunch</button>
                        <button class="hover:text-main transition duration-100 ease-in-out">Beverages</button>
                        <button class="hover:text-main transition duration-100 ease-in-out">Extras</button>
                    </form>
                </div>
                <div id="foods" class="w-full grid grid-cols-5 grid-rows-3 gap-4 h-[90%]">
                    @foreach ($menus as $menu)
                       <button id="menu" class="flex flex-col rounded-2xl shadow-lg bg-[#fefefe] p-4 items-center text-sm">
                            <div class="w-[100px] h-[100px] rounded-full block mx-auto mb-2">
                                <img src="{{asset('images/menu/'.$menu->image_name).'.jpg'}}" alt="{{$menu->image_name}}" class="w-full h-full object-cover rounded-full">
                            </div>
                            <p class="">{{$menu->food_name}}</p>
                            <p class="font-medium">&#8369; {{$menu->price}}.00</p>
                       </button>
                    @endforeach
                </div>
            </div>
            {{-- ticket --}}
            <div class="w-1/4">
                HELLO
            </div>
        </div>
    </div>
</body>
</html>