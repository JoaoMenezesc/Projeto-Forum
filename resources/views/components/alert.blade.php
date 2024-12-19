@if (session('success'))
    <div class="bg-green-500">
        {{session('success')}}    
    </div>
@endif

@if(session('error'))   
<div class="bg-red-500">
    {{session('error')}}
</div>
@endif

@if (session('status'))
    <div class="bg-blue-500">
        {{session('status')}}
    </div>
@endif

@if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-red-500">{{ $error }}</li>
            @endforeach
        </ul>
    
@endif


