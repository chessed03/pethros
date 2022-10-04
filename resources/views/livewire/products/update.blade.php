<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
					<input type="hidden" wire:model="selected_id">

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input wire:model="description" type="text" class="form-control" id="description" placeholder="Description">@error('description') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input wire:model="price" type="text" class="form-control" id="price" placeholder="Price">@error('price') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="type">Type</label>
                        <select wire:model='type' id="type" class="form-control">
                            <option value="">Choose...</option>
                            <option value="Abarrotes">Abarrotes</option>
                            <option value="Papelería">Papelería</option>
                        </select>
                        @error('type') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="active">Status</label>
                        <select wire:model='status' id="status" class="form-control">
                            <option value="">Choose...</option>
                            <option value="0">Inactivated</option>
                            <option value="1">Active</option>
                        </select>
                        @error('status') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-outline-primary" data-dismiss="modal">Save</button>
            </div>
       </div>
    </div>
</div>
