<div class="antialiased sans-serif">
	
	{{-- LISTADO CATEGORIAS --}}
	<div class="container" x-data="datatables()">
		<div class="border-b mb-10 flex py-4 justify-between gap-4 items-center">
			<h1 class="text-3xl">CATEGORIAS</h1>
			@livewire('dashboard.categories.create')
		</div>

		<div class="mb-4 flex justify-between items-center">

			<div class="flex items-center form-control">
				<span>Mostrar</span>
				<select class="mx-2" wire:model="show">
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
				</select>
				<span>entradas</span>
			</div>

			<div class="flex-1 mx-4">
				<div class="relative md:w-1/2">
					<x-jet-input class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" 
						type="text" wire:model="search" placeholder="Ingresa tu busqueda" />
					<div class="absolute top-0 left-0 inline-flex items-center p-2">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
							stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
							stroke-linejoin="round">
							<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
							<circle cx="10" cy="10" r="7" />
							<line x1="21" y1="21" x2="15" y2="15" />
						</svg>
					</div>
				</div>
			</div>

			{{-- <div>
				<div class="shadow rounded-lg flex">
					<div class="relative">
						<button @click.prevent="open = !open"
							class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
							<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden" viewBox="0 0 24 24"
								stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
								stroke-linejoin="round">
								<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
								<path
									d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5" />
							</svg>
							<span class="hidden md:block">Display</span>
							<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" width="24" height="24"
								viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
								stroke-linecap="round" stroke-linejoin="round">
								<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
								<polyline points="6 9 12 15 18 9" />
							</svg>
						</button>

						<div x-show="open" @click.away="open = false"
							class="z-40 absolute top-0 right-0 w-40 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-1 overflow-hidden">

							<template x-for="heading in headings">
								<label
									class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2">
									<div class="text-pink-600 mr-3">
										<input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" checked @click="toggleColumn(heading.key)">
									</div>
									<div class="select-none text-gray-700" x-text="heading.value"></div>
								</label>
							</template>
						</div>
					</div>
				</div>
			</div> --}}
		</div>

		<div class="overflow-x-auto bg-white rounded-lg shadow relative">

			<table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
				<thead class="border-b border-gray-300 bg-pink-500 text-white uppercase text-xs font-bold">
					<tr class="text-left">
						{{-- <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs text-center">---</th> --}}
						{{-- <template x-for="heading in headings">
							<th class="py-2 px-6
							sticky top-0 border-b tracking-wider text-left"
								x-text="heading.value" :x-ref="heading.key" :class="{ [heading.key]: true }"></th>
						</template> --}}
						<th class="py-2 px-6
						sticky top-0 border-b tracking-wider text-left">Categoria</th>
						<th class="py-2 px-6
						sticky top-0 border-b tracking-wider text-left">Tipo</th>
						<th class="py-2 px-6
						sticky top-0 border-b tracking-wider text-left">Acciones</th>

					</tr>
				</thead>
				<tbody class="bg-white divide-y divide-gray-200">
					@if (count($categories) !== 0)
						@foreach($categories as $item)
							<tr>
								{{-- <td class="border-dashed border-t border-gray-200 text-center"
									@click.prevent="showSubcategories = showSubcategories === {{$category->id}} ? null : {{$category->id}}"
									aria-controls="list-subcategories-{{$category->id}}" aria-expanded="false">
									<i x-show="showSubcategories === {{$category->id}}" class="mdi mdi-chevron-down"></i> </span>
                        			<i x-show="showSubcategories !== {{$category->id}}" class="mdi mdi-chevron-right"></i> </span>
								</td> --}}
								<td class="px-6 py-2 border-dashed border-t border-gray-200 name">
									{{$item->name}}
								</td>
								<td class="px-6 py-2 border-dashed border-t border-gray-200 type">
									@if ($item->parent_id !== null)
										subcategoria de {{$item->parent->name}}
									@else
										categoria
									@endif
								</td>
								<td class="px-6 py-2">
									<div class="flex">
										{{-- <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
											</svg>
										</div> --}}
										{{-- @livewire('dashboard.categories.edit', ['category' => $category], key($category->id)) --}}

										{{-- <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="edit( {{ $item->id }} )">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
											</svg>
										</div> --}}
										<x-edit-button route='dashboard.categories.edit' :param="$item" />

										<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110" wire:click="$emit('deleteCategory', '{{ $item->id }}')">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
											</svg>
										</div>
									</div>
								</td>
							</tr>

							{{-- @if (count($item->categories) !== 0 && empty($search))
								<x-element-recursive :elements="$item" type="subcategoria de {{$item->name}}"/>
							@endif --}}
						@endforeach

					@else

					@endif
					
				</tbody>
			</table>

			@if($categories->hasPages())
				<div class="px-6 py-3 bg-pink-100">
					{{ $categories->links() }}
				</div>
			@endif
		</div>
	</div>

	{{-- MODAL EDIT --}}
	<x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar categoria
        </x-slot>
        <x-slot name="content">

			@if (!empty($category))	
				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<div class="col-span-1">
						<div class="mb-4">
							<x-jet-label value="Nombre de la categoria" />
							<x-jet-input type="text" class="w-full" wire:model="category.name" />

							<x-jet-input-error for="category.name" />
						</div>
					</div>

					<div class="mb-4">
						<x-jet-label value="Slug" />
						<x-jet-input type="text" disabled wire:model="category.slug" class="w-full bg-gray-200"
							placeholder="Slug del producto" />

						<x-jet-input-error for="category.slug" />
					</div>
				</div>

				<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
					<div class="col-span-1">
						<div class="mb-4">
							<x-jet-label value="Tipo" />

							<div class="space-x-4">
								<x-jet-input wire:model="type" value="1" type="radio" />Categoria
								<x-jet-input wire:model="type" value="2" type="radio" />Subcategoria
							</div>

							<x-jet-input-error for="type" />
						</div>
					</div>

					<div class="col-span-1">
						@if ($type === '2' )
							<div class="mb-4">
								<x-jet-label value="Categoria padre" />
									<select wire:model="categoryId" class="w-full form-control">
										<option value="0">SELECCIONE</option>
										@if (count($categoriesSelect) !== 0)
											@foreach ($categoriesSelect as $parentCategory)
												<option value="{{ $parentCategory->id }}">{{ $parentCategory->name }} </option>
											@endforeach
										@endif
									<select>
								<x-jet-input-error for="categoryId" />
							</div>
						@endif
					</div>
				</div>

				<section>
					<h2>IMAGENES</h2>

					<div class="mb-4" wire:ignore>
						<form action="{{ route('dashboard.categories.files', $category) }}" method="POST" class="dropzone"
							id="dropzone-banners-categories"></form>
					</div>

					@if (count($category->images))
						<section class="bg-white shadow-xl rounded-lg p-6 mb-4">
							<h1 class="text-2xl text-center font-semibold mb-1">Imagenes del negocio</h1>
							<p class="text-center mb-2">Máximo 5 imagenes</p>
							<ul class="flex flex-wrap">
								@foreach ($category->images as $image)
									<li class="relative" wire:key="banner-{{$image->id}}">
										<img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}">
										<x-jet-danger-button class="absolute right-2 top-2" wire:click="deleteBanner({{$image->id}})"
											wire:loading.attr="disabled"
											wire:target="deleteBanner({{$image->id}})">
											x
										</x-jet-danger-button>
									</li>
								@endforeach
							</ul>
						</section>
					@endif
				</section>
			@endif

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update"
                class="disabled:opacity-25">
                Actualizar categoria
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

	{{-- <script>
		
	</script> --}}

	@push('script')
		<script>
			function datatables() {
				return {

					headings: @entangle('headings'),
					open: false,
					
					toggleColumn(key) {
						// Note: All td must have the same class name as the headings key! 
						let columns = document.querySelectorAll('.' + key);

						if (this.$refs[key].classList.contains('hidden') && this.$refs[key].classList.contains(key)) {
							columns.forEach(column => {
								column.classList.remove('hidden');
							});
						} else {
							columns.forEach(column => {
								column.classList.add('hidden');
							});
						}
					}
				}
			}

			Dropzone.options.dropzoneBannersCategories = {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen al recuadro",
                acceptedFiles: "image/*",
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                maxFiles: 5,
                complete: function(file){
                    this.removeFile(file);
                },
                queuecomplete: function(){
                    Livewire.emit('refreshStore');
                }
            };

			Livewire.on('deleteCategory', categoryIdToDelete => {
				
				Swal.fire({
					title: '¿Estás seguro?',
					text: "¡No podras revertir la acción!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Sí, eliminar'
				}).then((result) => {
					if (result.isConfirmed) {

						Livewire.emitTo('dashboard.categories.index', 'delete-category', categoryIdToDelete);

						Swal.fire(
							'¡Eliminado!',
							'La categoria ha sido eliminada',
							'success'
						)
					}
				})

			});
		</script>
	@endpush
</div>
