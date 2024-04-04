<?php

use App\Models\BrandAddress;
use App\Models\States;
use App\Models\City;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public $brand;
    public bool $physicalExists = false;
    public bool $remittanceExists = false;
    public $directions = [];
    public $street_types = [];
    public $unit_types = [];
    public $cities = null;
    public ?Collection $states = null;

    #[Validate('required|int')]
    public int $brand_id;
    #[Validate('required|string|min:2|max:50')]
    public string $title;
    #[Validate('nullable|string|min:1|max:10')]
    public string $building_number;
    #[Validate('nullable|string')]
    public string $pre_direction;
    #[Validate('nullable|string|min:2|max:50')]
    public string $street_name;
    #[Validate('nullable|required_with:street_name|string')]
    public string $street_type;
    #[Validate('nullable|string')]
    public string $post_direction;
    #[Validate('nullable|string')]
    public string $unit;
    #[Validate('nullable|required_with:unit|string')]
    public string $unit_type;
    #[Validate('nullable|required_without:building_number|string')]
    public string $po_box;
    #[Validate('required|string')]
    public string $city;
    #[Validate('required|string')]
    public string $state;
    #[Validate('required|string')]
    public string $zip;

    public function mount(): void
    {
        $this->directions = (__('selects.cardinal-directions'));
        $this->street_types = (__('selects.street-types'));
        $this->unit_types = (__('selects.unit-types'));
        $this->states = States::get();
        $this->brand_id = $this->brand->id;
    }

    public function saveAddress()
    {
        $validated = $this->validate();

        if (auth()->user()->address()->create($validated))
        {
            $this->dispatch('brand-address-created', data: $this->title);

            $this->title = '';
            $this->building_number = '';
            $this->pre_direction = '';
            $this->street_name = '';
            $this->street_type = '';
            $this->post_direction = '';
            $this->unit = '';
            $this->unit_type = '';
            $this->po_box = '';
            $this->city = '';
            $this->state = '';
            $this->zip = '';
        }
    }

    public function cityLookupByName(string $name = null)
    {
        $cities = City::where('name', 'like', '%'.$name.'%')
            ->orderBy('name')
            ->limit(250)
            ->with('state')
            ->get();

        $city = [];

        foreach ($cities as $k => $v)
        {
            $city[] = [
                'city' => $cities[$k]->name,
                'state' => $cities[$k]->state->code,
                'zip' => $cities[$k]->zip
            ];
        }
        $this->cities = $city;
    }

    public function cityLookupByZip(string $zip)
    {
        $cities = City::where('zip', 'like', '%'.$zip.'%')
            ->orderBy('name')
            ->limit(250)
            ->with('state')
            ->get();

        $city = [];

        foreach ($cities as $k => $v)
        {
            $city[] = [
                'city' => $cities[$k]->name,
                'state' => $cities[$k]->state->code,
                'zip' => $cities[$k]->zip
            ];
        }
        $this->cities = $city;
    }
}; ?>

<div>
    <form wire:submit="saveAddress" class="need-validation" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h1>Create an address</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <x-input id="title" model="title" label="Title" />
                    </div>

                    <div class="row">
                        <x-input id="building-number" model="building_number" label="Building number" class="{{ ($errors->get('building_number')) ? 'is-invalid' : '' }}" />

                        <x-select id="pre-direction" model="pre_direction" label="Direction" class="{{ ($errors->get('pre_direction')) ? 'is-invalid' : '' }}">
                            <option></option>
                            @foreach ($directions as $k => $v)
                                <option value="{{ $k }}">{{ $k }} - {{ $v }}</option>
                            @endforeach
                        </x-select>

                        <x-input cols="col-lg-4" id="street-name" model="street_name" label="Street name" class="{{ ($errors->get('street_name')) ? 'is-invalid' : '' }}" />

                        <x-select id="street-type" model="street_type" label="Street type" class="{{ ($errors->get('street_type')) ? 'is-invalid' : '' }}">
                            <option></option>
                            @foreach ($street_types as $k => $v)
                                <option value="{{ $k }}">{{ $k }} - {{ $v }}</option>
                            @endforeach
                        </x-select>

                        <x-select id="post-direction" model="post_direction" label="Direction" class="{{ ($errors->get('post_direction')) ? 'is-invalid' : '' }}">
                            <option></option>
                            @foreach ($directions as $k => $v)
                                <option value="{{ $k }}">{{ $k }} - {{ $v }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="row">
                        <x-select id="unit-type" model="unit_type" label="Unit type" class="{{ ($errors->get('unit_type')) ? 'is-invalid' : '' }}">
                            <option></option>
                            @foreach ($unit_types as $k => $v)
                                <option value="{{ $k }}">{{ $k }} - {{ $v }}</option>
                            @endforeach
                        </x-select>

                        <x-input id="unt" model="unit" label="Unit" class="{{ ($errors->get('unit')) ? 'is-invalid' : '' }}" />

                        <x-input id="po-box" model="po_box" label="PO box" class="{{ ($errors->get('po_box')) ? 'is-invalid' : '' }}" />

                        <!-- Address 1 city -->
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input
                                    type="text"
                                    id="city"
                                    class="form-control @error('city') is-invalid @enderror"
                                    list="cities"
                                    wire:model.live="city"
                                    x-on:input="$wire.cityLookupByName($el.value)"
                                    x-on:change='
                                const datalist = document.getElementById("cities")
                                const stateEl = document.getElementById("state")
                                const zipEl = document.getElementById("zip")

                                let selOpt = document.querySelector("option[value=\"" + $el.value + "\"]")

                                let key = selOpt.dataset.value

                                let city = $wire.cities[key]["city"]
                                let state = $wire.cities[key]["state"]
                                let zip = $wire.cities[key]["zip"]

                                $wire.city = city
                                $wire.state = state
                                $wire.zip = zip
                            '
                                >
                                <datalist id="cities">
                                    @if (!empty($cities))
                                        @foreach ($cities as $key => $data)
                                            <option data-value="{{ $key }}" value="{{ $data['city'] }}, {{ $data['state'] }} {{ $data['zip'] }}">{{ $data['city'] }}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                                <x-input-error :messages="$errors->get('city')" class="tw-text-xs tw-text-red-500 mt-2"/>
                            </div>
                        </div>

                        <!-- Physical address state -->
                        <x-select id="state" model="state" label="State" class="{{ ($errors->get('state')) ? 'is-invalid' : '' }}">
                            <option></option>
                            @foreach ($states as $state)
                                <option value="{{ $state->code }}">{{ $state->code }} - {{ $state->name }}</option>
                            @endforeach
                        </x-select>

                        <!-- Physical address zip -->
                        <div class="col-lg-2">
                            <div class="form-group mb-2">
                                <label for="zip">Zip</label>
                                <input
                                    type="text"
                                    id="zip"
                                    class="form-control @error('zip') is-invalid @enderror"
                                    list="zips"
                                    wire:model.live="zip"
                                    x-on:input="$wire.cityLookupByZip($el.value)"
                                    x-on:change='
                                const datalist = document.getElementById("zips")
                                const cityEl = document.getElementById("city")
                                const stateEl = document.getElementById("state")

                                let selOpt = document.querySelector("option[value=\"" + $el.value + "\"]")

                                let key = selOpt.dataset.value

                                let city = $wire.cities[key]["city"]
                                let state = $wire.cities[key]["state"]
                                let zip = $wire.cities[key]["zip"]

                                $wire.city = city
                                $wire.state = state
                                $wire.zip = zip
                            '
                                >
                                <datalist id="zips">
                                    @if (!empty($cities))
                                        @foreach ($cities as $key => $data)
                                            <option data-value="{{ $key }}" value="{{ $data['city'] }}, {{ $data['state'] }} {{ $data['zip'] }}">{{ $data['city'] }}</option>
                                        @endforeach
                                    @endif
                                </datalist>
                                <x-input-error :messages="$errors->get('zip')" class="tw-text-xs tw-text-red-500 mt-2"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="brand-address-create" />
            </div>
        </div>
    </form>
</div>
