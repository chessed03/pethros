@section('title', __('Products'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">

                <div class="card-header">

                    <div class="row">

                        <div class="col">
                            <div class="float-left">
                                <h4>
                                    <i class="fa fa-university" aria-hidden="true"></i> Products Listing
                                </h4>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group" x-data="{ showType: false }">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input wire:model='showType' type="checkbox" x-model="showType" name="showType" id="showType" value="{{ !$showType }}"> &nbsp;Show types
                                    </div>
                                </div>
                                <select wire:model='keyTypes' id="types" name="types" class="form-control" x-bind:disabled="!showType" disabled>
                                    <option value="" selected>All</option>
                                    <option value="Abarrotes">Abarrotes</option>
                                    <option value="Papelería">Papelería</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="input-group">
                                <input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Products">
                                <div class="input-group-append">
                                    <div class="btn btn-outline-primary" data-toggle="modal" data-target="#createDataModal">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="paginateNumber">Showing</label>
                                </div>
                                <select wire:model='paginateNumber' id="paginateNumber" class="form-control">
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="paginateNumber">records</label>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

				<div class="card-body">
						@include('livewire.products.create')
						@include('livewire.products.update')
				<div class="table-responsive">
					<table class="table">
						<thead class="thead text-center">
							<tr>
								<th>#</th>
								<th>Description</th>
                                <th style="{{ ($showType) ? '' : 'display:none;' }}">Type</th>
								<th>Price</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->description }}</td>
                                <td style="{{ ($showType) ? '' : 'display:none;' }}">{{ $row->type }}</td>
								<td>{{ $row->price }}</td>
								<td width="90" class="text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
									<a data-toggle="modal" data-target="#updateModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a>
									<a class="dropdown-item" onclick="confirm('Confirm Delete Product id {{$row->id}}? \nDeleted Products cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a>
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>
					{{ $products->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ( session()->has('message') )

            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('message') }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>

    @endif

</div>

