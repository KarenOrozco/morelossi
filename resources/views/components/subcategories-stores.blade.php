
@foreach ($category->companies as $company)
    <li class="bg-white rounded-lg shadow mr-4">
        <article>
            <figure>
                <img src="{{ Storage::url($company->images->first()->url) }}" alt="">
            </figure>

            <div class="py-4 px-6">
                <h2>
                    <a>
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
@if( count($category->categories) )
    @foreach ($category->categories as $categoryChild)
        <x-subcategories-stores :category="$categoryChild" />
    @endforeach
@endif
