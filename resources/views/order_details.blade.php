<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    @vite('resources/css/app.css')
    <title>Dashboard</title>
</head>
<body class="w-full h-screen bg-[#fefefe]">
    <div class="w-2/4 mx-auto hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50" id="scanner">
        <video class="mx-auto" id="preview" width="1%"></video><br>
    </div>
    {{-- Top bar --}}
    <div class="w-full flex items-center h-[8%] px-20 border-b border-bd">
        <div class="w-1/6">
            <p class="text-lg font-semibold">MAMITA'S</p>
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
        <div class="w-[95%] flex py-10">
            <div class="w-2/3 block mx-auto shadow-2xl rounded-bl-md rounded-br-md overflow-hidden">
                <div class="w-full py-1 bg-main rounded-tl-full rounded-tr-full">
                    <span class="text-main">.</span>
                </div>
                <div class="w-full h-full flex">
                    <div class="w-1/2 flex flex-col items-center h-full bg-[#f8f8f8] border-r border-bd">
                        <div class="w-3/4 block mx-auto p-2 border-r border-b border-l border-bd mb-8">
                            <div class="w-full flex items-center justify-between">
                                <p class="font-semibold">#1-{{$ticket}}</p>
                                <p class="font-semibold">{{$customer}}</p>
                            </div>
                        </div>
                        <div class="w-full flex flex-col items-center h-1/2 overflow-y-scroll border-b border-bd">
                            @php
                            // Define an array of food prices, where the key is the food name and the value is the price
                            $foodPrices = [
                                'Baked Macaroni' => 20, // Example price for food_name_1
                                'Palabok' => 25,
                                'Sopas' => 25,
                                'Spaghetti' => 25, // Example price for food_name_2
                                // Add more food prices as needed
                            ];

                            $subTotal = 0;
                            $pay = 0;
                            @endphp
                            <div class="w-3/4 flex items-center font-medium">
                                <p id="count" class="w-[10%]">Qty</p>
                                <p class="food w-[80%]">Item</p>
                                <p id="food-total" class="w-[10%]">Total</p>
                            </div>
                            @foreach ($foods as $food)
                                @php
                                    // Get the price from the $foodPrices array based on the food name
                                    $price = $foodPrices[$food->food_name] ?? 0; // Default to 0 if the price is not found
                                    $total = $price * $food->count;
                                    $pay += $total;
                                    $tax = $pay * .12;
                                    $subTotal = $pay - $tax;

                                @endphp
                                <div class="w-3/4 flex items-center border-b border-bd py-2">
                                    <p id="count" class="w-[10%]">{{$food->count}}</p>
                                    <p class="food w-[70%]">{{$food->food_name}}</p>
                                    <p id="food-total text-right" class="w-[20%]">&#8369; {{$total}}.00</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="w-full flex flex-col gap-4 items-center py-6">
                            <div class="w-3/4 flex justify-between">
                                <p>Sub-total</p>
                                <p>&#8369; {{$subTotal}}0</p>
                            </div>
                            <div class="w-3/4 flex justify-between">
                                <p>Tax (12%)</p>
                                <p>&#8369; {{$tax}}0</p>
                            </div>
                            <div class="w-3/4 flex justify-between">
                                <p class="text-lg font-semibold">Total</p>
                                <p class="text-lg font-semibold">&#8369; {{$pay}}.00</p>
                            </div>
                            <div class="w-3/4 flex justify-between"></div>
                        </div>
                    </div>
                    
                    <div class="w-1/2">
                        <div class="w-10/12 block mx-auto p-4">
                            <p class="mt-24 text-center mb-5">Enter cash here</p>
                            <form action="">
                                <div class="w-full flex item border border-bd px-2 relative rounded-xl mb-3">
                                    <div class="w-[20%] flex items-center justify-center absolute top-1/2 transform -translate-y-1/2 left-4">
                                        <img src="{{asset('images/money.png')}}" alt="" class="w-[40%] object-cover">
                                    </div>
                                    <input type="text" name="cash" placeholder="&#8369; 00.00" class="px-4 py-2 w-full outline-none text-center text-xl">
                                </div>
                                <button class="w-full bg-proceed py-2 rounded-xl text-lg text-white mb-10">Cash</button>

                                <p class="mt-10 text-center mb-5">Quick cash payment</p>
                                <div class="w-full flex gap-3">
                                    <button class="w-1/4 bg-[#3d3d3d] text-white py-1 rounded-lg">&#8369; 20.00</button>
                                    <button class="w-1/4 bg-[#3d3d3d] text-white py-1 rounded-lg">&#8369; 50.00</button>
                                    <button class="w-1/4 bg-[#3d3d3d] text-white py-1 rounded-lg">&#8369; 100.00</button>
                                    <button class="w-1/4 bg-[#3d3d3d] text-white py-1 rounded-lg">&#8369; 200.00</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>