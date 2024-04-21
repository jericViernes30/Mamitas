<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body class="relative h-screen bg-[#f1f1f1]">
  <div class="w-1/4 p-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-3xl shadow-xl">
    <p class="text-lg text-center font-medium mb-4">MAMITA'S</p>
    <form action="{{route("dashboard")}}" method="GET">
      @csrf
      <select name="POS" id="" class="w-full p-2 outline-none rounded-full border border-black mb-3">
        <option value="" selected disabled>Select POS</option>
        <option value="pos1">POS 1</option>
        <option value="pos2">POS 2</option>
      </select>
      <div class="w-full flex flex-col gap-1 mb-3">
        <label for="">Name</label>
        <input type="text" name="name" class="w-full p-2 outline-none rounded-full border border-black">
      </div>
      <div class="w-full flex flex-col gap-1 mb-3">
        <label for="">Password</label>
        <input type="password" name="password" class="w-full p-2 outline-none rounded-full border border-black">
      </div>
      <button class="w-1/2 rounded-full py-2 text-white bg-main block mx-auto">
        Login
      </button>
    </form>
  </div>
</body>
</html>