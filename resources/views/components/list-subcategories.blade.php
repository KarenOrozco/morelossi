@props(['nivel' => 1, 'category','categoriaHija'])

@foreach($category->categories as $subcategory)
    <li class="py-2 text-sm">
        <a class="cursor-pointer hover:text-pink-500 capitalize {{ $categoriaHija == $subcategory->name ? 'text-pink-500 font-semibold' : ''}}"
            wire:click="$set('categoriaHija', '{{$subcategory->name}}')" >

            @if ($nivel > 1)
                @for ($i = 0; $i < $nivel; $i++)
                    &nbsp
                @endfor
            @endif
           
            {{$subcategory->name}}
        </a>
    </li>
    <x-list-subcategories :category="$subcategory" :categoriaHija="$categoriaHija" nivel={{$nivel+1}} />
@endforeach