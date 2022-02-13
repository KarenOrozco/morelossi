<div class="antialiased sans-serif">
	
	{{-- <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css"> --}}
	{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script> --}}
	<style>
		[x-cloak] {
			display: none;
		}

		[type="checkbox"] {
			box-sizing: border-box;
			padding: 0;
		}

		.form-checkbox {
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			-webkit-print-color-adjust: exact;
			color-adjust: exact;
			display: inline-block;
			vertical-align: middle;
			background-origin: border-box;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			flex-shrink: 0;
			color: currentColor;
			background-color: #fff;
			border-color: #e2e8f0;
			border-width: 1px;
			border-radius: 0.25rem;
			height: 1.2em;
    		width: 1.2em;
		}

		.form-checkbox:checked {
			background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
			border-color: transparent;
			background-color: currentColor;
			background-size: 100% 100%;
			background-position: center;
			background-repeat: no-repeat;
		}
	</style>

	<div class="container" x-data="datatables()" x-cloak>
		<h1 class="text-3xl py-4 border-b mb-10">CATEGORIAS</h1>

		
		<div x-show="selectedRows.length" class="bg-pink-200 fixed top-0 left-0 right-0 z-40 w-full shadow">
			<div class="container mx-auto px-4 py-4">
				<div class="flex md:items-center">
					<div class="mr-4 flex-shrink-0">
						<svg class="h-8 w-8 text-pink-600"  viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
					</div>
					<div x-html="selectedRows.length + ' rows are selected'" class="text-pink-800 text-lg"></div>
				</div>
			</div>
		</div>

		<div class="mb-4 flex justify-between items-center">
			<div class="flex-1 pr-4">
				<div class="relative md:w-1/3">
					{{-- <x-jet-input type="text" wire:model="search"
						class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
						/> --}}
					<x-jet-input class="w-full form-control" type="text" wire:model="search" placeholder="Ingresa tu busqueda" />

					{{-- <div class="absolute top-0 left-0 inline-flex items-center p-2">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
							stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
							stroke-linejoin="round">
							<rect x="0" y="0" width="24" height="24" stroke="none"></rect>
							<circle cx="10" cy="10" r="7" />
							<line x1="21" y1="21" x2="15" y2="15" />
						</svg>
					</div> --}}
				</div>
			</div>
			<div>
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
			</div>
		</div>

		<div class="overflow-x-auto bg-white rounded-lg shadow relative">

			<table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
				<thead>
					<tr class="text-left">
						<th class="py-2 px-3 sticky top-0 border-b border-pink-200 bg-gray-100">
							<label
								class="text-pink-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
								<input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline" @click="selectAllCheckbox($event);">
							</label>
						</th>
						<template x-for="heading in headings">
							<th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs"
								x-text="heading.value" :x-ref="heading.key" :class="{ [heading.key]: true }"></th>
						</template>
						<!-- <th class="py-2 px-3 sticky top-0 border-b border-pink-200 bg-gray-100">
							Acciones
						</th> -->
						<th class="py-3 px-3 text-center sticky top-0 border-b border-pink-200 bg-gray-100">Actions</th>

					</tr>
				</thead>
				<tbody class="bg-white divide-y divide-gray-200">
					@if (count($categories) !== 0)
						@foreach($categories as $category)
							<tr>
								<td class="border-dashed border-t border-gray-200 px-3">
									<label
										class="text-pink-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
										<input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" :name="{{$category->id}}"
												@click="getRowDetail($event, {{$category->id}})">
									</label>
								</td>
								
								<td class="border-dashed border-t border-gray-200 name">
									{{$category->name}}
								</td>
								<td class="border-dashed border-t border-gray-200 type">
									categoria
								</td>
								<td class="py-3 px-6 text-center">
									<div class="flex item-center justify-center">
										<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
											</svg>
										</div>
										<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
											</svg>
										</div>
										<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
											</svg>
										</div>
									</div>
								</td>
							</tr>

							{{-- @forelse($category->categories as $childCategory)
								<tr>
									<td class="border-dashed border-t border-pink-200 px-3">
										<label
											class="text-pink-500 inline-flex justify-between items-center hover:bg-gray-200 px-2 py-2 rounded-lg cursor-pointer">
											<input type="checkbox" class="form-checkbox rowCheckbox focus:outline-none focus:shadow-outline" :name="{{$childCategory->id}}"
													@click="getRowDetail($event, {{$childCategory->id}})">
										</label>
									</td>
									
									<td class="border-dashed border-t border-pink-200 name">
										{{$childCategory->name}}
									</td>
									<td class="border-dashed border-t border-pink-200 type">
										subcategoria
									</td>
									<td class="py-3 px-6 text-center">
										<div class="flex item-center justify-center">
											<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
												</svg>
											</div>
											<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
												</svg>
											</div>
											<div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
												<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
												</svg>
											</div>
										</div>
									</td>
								</tr>
							@empty

							@endforelse --}}
						@endforeach
					@else

					@endif
					
				</tbody>
			</table>
		</div>
	</div>


	<script>
		function datatables() {
			return {
				headings: @entangle('headings'),
				selectedRows: [],

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
				},

				getRowDetail($event, id) {
					let rows = this.selectedRows;

					if (rows.includes(id)) {
						let index = rows.indexOf(id);
						rows.splice(index, 1);
					} else {
						rows.push(id);
					}
				},

				selectAllCheckbox($event) {
					let columns = document.querySelectorAll('.rowCheckbox');

					this.selectedRows = [];

					if ($event.target.checked == true) {
						columns.forEach(column => {
							column.checked = true
							this.selectedRows.push(parseInt(column.name))
						});
					} else {
						columns.forEach(column => {
							column.checked = false
						});
						this.selectedRows = [];
					}
				}
			}
		}
	</script>
</div>

