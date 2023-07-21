@if ($message = Session::get('success'))
<div x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show">
    <div class="bg-blue-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
        <p class="font-bold">Sucesso!</p>
        <p class="text-sm">{{ $message }}</p>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show">
    <div class="bg-blue-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
        <p class="font-bold">Erro!</p>
        <p class="text-sm">{{ $message }}</p>
    </div>
</div>
@endif


@if ($message = Session::get('warning'))
<div x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show">
    <div class="bg-blue-100 border-t border-b border-yellow-500 text-yellow-700 px-4 py-3" role="alert">
        <p class="font-bold">Aviso!</p>
        <p class="text-sm">{{ $message }}</p>
    </div>
</div>
@endif


@if ($message = Session::get('info'))
<div x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show">
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Aviso!</p>
        <p class="text-sm">{{ $message }}</p>
    </div>
</div>
@endif


@if ($errors->any())
<div x-data="{ show: true }"
    x-show="show">
    <div class="bg-blue-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
        <button type="button" class="close float-right" @click="show = !show">×</button>	
        <p class="font-bold">Erro!</p>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif