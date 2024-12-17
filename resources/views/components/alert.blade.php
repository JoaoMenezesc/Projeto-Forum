@if (session()->has('success'))
    <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
        {{session('success')}}
    </div>
@endif

@if (session()->has('message'))
    <div class="bg-orange-500 text-white font-bold rounded-t px-4 py-2">
        {{session('message')}}
    </div>
@endif

@if (session()->has('error'))
    <div class="bg-blue-500 text-white font-bold rounded-t px-4 py-2">
        {{session('error')}}
    </div>
@endif

@if ($errors->any())
<ul>
    @foreach ($errors->any() as $error)
    <li class="bg-red-500 text-white font-bold rounded-t px-4 py-2">{{ $error }}</li>
    @endforeach
</ul>
@endif
