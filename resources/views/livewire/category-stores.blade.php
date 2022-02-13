<div wire:init="loadStores">
  
    @if (count($stores))
        <div class="glider-contain">
            <ul class="glider-{{$category->id}}">
                @foreach ($stores as $company)
                    <li class="bg-white rounded-lg shadow {{$loop->last ? '' : 'sm:mr-4'}}">
                        <article>
                            <figure>
                                <img class="h-48 w-full object-cover object-center rounded-t-lg" src="{{ Storage::url($company->images->first()->url) }}" alt="">
                            </figure>
                
                            <div class="py-4 px-6">
                                <h2>
                                    <a href="{{route('companies.show',[$company->categories->first()->parent,$company])}}">
                                        {{$company->name}}
                                    </a>
                                </h2>
                
                                <p>
                                    {{Str::limit($company->description,20)}}
                                </p>
                            </div>
                        </article>
                    </li>
                @endforeach

                {{-- @if(count($category->categories))
                    @foreach ($category->categories as $categoryChild)
                        <x-subcategories-stores :category="$categoryChild" />
                    @endforeach
                @endif --}}
            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>
    @else

        @if ($loadedData)
            <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
                {{-- <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div> --}}
                <h3>Sin resultados</h3>
            </div>
        @else
            <div class="mb-4 h-48 flex justify-center items-center bg-white shadow-xl border border-gray-100 rounded-lg">
                <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500"></div>
            </div>
        @endif
        		
    @endif
   
</div>
