<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Products extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $paginateNumber     = 5;
    public $updateMode         = false;
    public $showType           = false;
    public $keyWord            = null;
    public $keyTypes           = null;

    public $selected_id, $description, $price, $type, $status;

    public function render()
    {
        $showType       = $this->showType;
		$keyWord        = $this->keyWord;
        $paginateNumber = $this->paginateNumber;
        $keyTypes       = $this->keyTypes;
        $products       = Product::searchProducts( $keyWord, $paginateNumber, $keyTypes );

        return view('livewire.products.view', [
            'products' => $products,
            'showType' => $showType
        ]);

    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {
		$this->description = null;
		$this->price       = null;
        $this->type        = null;
    }

    public function store()
    {
        $this->validate([
		    'description' => 'required',
		    'price'       => 'required',
            'type'        => 'required',
        ]);

        Product::create([
			'description' => $this->description,
			'price'       => $this->price,
            'type'        => $this->type
        ]);

        $this->resetInput();

		$this->emit('closeModal');

		session()->flash('message', 'Product Successfully created.');
    }

    public function edit($id)
    {
        $record = Product::findOrFail($id);

        $this->selected_id = $id;
		$this->description = $record->description;
		$this->price       = $record->price;
        $this->type        = $record->type;
        $this->status      = $record->status;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		    'description' => 'required',
		    'price'       => 'required',
            'type'        => 'required',
            'status'      => 'required',
        ]);

        if ($this->selected_id) {

			$record = Product::find($this->selected_id);

            $record->update([
			    'description' => $this->description,
			    'price'       => $this->price,
                'type'        => $this->type,
                'status'      => $this->status
            ]);

            $this->resetInput();

            $this->updateMode = false;

			session()->flash('message', 'Product Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Product::where('id', $id);
            $record->delete();
        }
    }
}
