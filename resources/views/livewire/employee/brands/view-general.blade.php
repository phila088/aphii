<?php

use App\Models\Brand;
use App\Models\BrandAddress;
use App\Models\BrandEmail;
use App\Models\BrandHoliday;
use App\Models\BrandHour;
use App\Models\BrandPhoneNumber;
use Livewire\Volt\Component;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Brand $brand;
    public Collection $brandAddresses;
    public Collection $brandEmails;
    public Collection $brandHolidays;
    public Collection $brandHours;
    public Collection $brandPhoneNumbers;

    public string $status = '';
    public string $reason = '';

    public function mount(): void {
        $this->status = $this->brand->status()->name;
        $this->reason = $this->brand->status()->reason;

        $this->getBrandAddresses();
        $this->getBrandEmails();
        $this->getBrandHolidays();
        $this->getBrandHours();
        $this->getBrandPhoneNumbers();
    }

    public function getBrandAddresses(): void
    {
        $this->brandAddresses = BrandAddress::where('brand_id', $this->brand->id)
            ->get();
    }

    public function getBrandEmails(): void
    {
        $this->brandEmails = BrandEmail::where('brand_id', $this->brand->id)
            ->get();
    }

    public function getBrandHolidays(): void
    {
        $this->brandHolidays = BrandHoliday::where('brand_id', $this->brand->id)
            ->get();
    }

    public function getBrandHours(): void
    {
        $this->brandHours = BrandHour::where('brand_id', $this->brand->id)
            ->get();
    }

    public function getBrandPhoneNumbers(): void
    {
        $this->brandPhoneNumbers = BrandPhoneNumber::where('brand_id', $this->brand->id)
            ->get();
    }

    public function edit(Brand $brand): void
    {

    }

    public function delete(Brand $brad): void
    {

    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>General</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="" class="form-label">Status</label>
                        <div class="form-control rounded-0 border-0">
                            {{ $status }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="form-group">
                        <label for="" class="form-label">Status reason</label>
                        <div class="form-control rounded-0 border-0">
                            {{ $reason }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <h2>Licenses</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="" class="form-label">FEIN</label>
                        <div class="form-control rounded-0 border-0">
                            {{ $brand->fein }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="" class="form-label">State License</label>
                        <div class="form-control rounded-0 border-0">
                            {{ $brand->state_license_number }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="" class="form-label">County License</label>
                        <div class="form-control rounded-0 border-0">
                            {{ $brand->county_license_number }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="" class="form-label">City License</label>
                        <div class="form-control rounded-0 border-0">
                            {{ $brand->city_license_number }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h1>All addresses</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="searchTerm" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty ($brandAddresses[0])
                    <x-no-data />
                @else
                    @foreach ($brandAddresses as $brandAddress)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="col-auto">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ $brandAddress->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address: </th>
                                            <td>
                                                <address class="mb-0">
                                                    <br />
                                                    {{ $brandAddress->building_number }}
                                                    @if(!empty($brandAddress->pre_direction))
                                                        {{ $brandAddress->pre_direction }}
                                                    @endif
                                                    {{ $brandAddress->street_name }}
                                                    {{ $brandAddress->street_type }}
                                                    @if(!empty($brandAddress->post_direction))
                                                        {{ $brandAddress->post_direction }}
                                                    @endif
                                                    @if(!empty($brandAddress->unit_type))
                                                        <br />
                                                        {{ $brandAddress->unit_type }}
                                                        {{ $brandAddress->unit }}
                                                    @endif
                                                    <br />
                                                    {{ $brandAddress->city }},
                                                    {{ $brandAddress->state }}
                                                    {{ $brandAddress->zip }}
                                                </address>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h1>All emails</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty ($brandEmails[0])
                    <x-no-data />
                @else
                    @foreach ($brandEmails as $brandEmail)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="col-auto">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ $brandEmail->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email: </th>
                                            <td><a href="mailto:{{ $brandEmail->email }}">{{ $brandEmail->email }}</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center w-100">
                <h1>All holidays</h1>
                <div>
                    <label for="brand-holidays-search" class="sr-only">Search</label>
                    <input type="text" id="brand-holidays-search" wire:model="searchPartial" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty($brandHolidays[0])
                    <x-no-data />
                @else
                    @foreach ($brandHolidays as $brandHoliday)
                        <li class="list-group-item" :key="{{ $brandHoliday->id }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-auto">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                        <tr>
                                            <th>Holiday name: </th>
                                            <td>{{ $brandHoliday->holiday_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Date: </th>
                                            <td>{{ Carbon::parse($brandHoliday->date)->timezone(auth()->user()->timezone)->format('m-d-Y') }}</td>
                                        </tr>
                                        </tbody>
                                        <tr>
                                            <th>Open: </th>
                                            <td>{{ $brandHoliday->open }}</td>
                                        </tr>
                                        <tr>
                                            <th>Close: </th>
                                            <td>{{ $brandHoliday->close }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created: </th>
                                            <td>{{ Carbon::parse($brandHoliday->created_at)->timezone(auth()->user()->timezone)->format('m-d-Y G:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h2>All hours</h2>
                <div>
                    <input id="search-term" wire:model="search_term" x-on:input="$wire.searchResults($el.value)"
                           placeholder="Search" class="form-control form-control-sm rounded-pill"/>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty ($brandHours[0])
                    <x-no-data />
                @else
                    @foreach ($brandHours as $brandHour)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="col-auto">
                                    <table class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th>{{ $brandHour->title }}</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>Open</th>
                                            <td>{{ $brandHour->monday_open }}</td>
                                            <td>{{ $brandHour->tuesday_open }}</td>
                                            <td>{{ $brandHour->wednesday_open }}</td>
                                            <td>{{ $brandHour->thursday_open }}</td>
                                            <td>{{ $brandHour->friday_open }}</td>
                                            <td>{{ $brandHour->saturday_open }}</td>
                                            <td>{{ $brandHour->sunday_open }}</td>
                                        </tr>
                                        <tr>
                                            <th>Close</th>
                                            <td>{{ $brandHour->monday_close }}</td>
                                            <td>{{ $brandHour->tuesday_close }}</td>
                                            <td>{{ $brandHour->wednesday_close }}</td>
                                            <td>{{ $brandHour->thursday_close }}</td>
                                            <td>{{ $brandHour->friday_close }}</td>
                                            <td>{{ $brandHour->saturday_close }}</td>
                                            <td>{{ $brandHour->sunday_close }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h1>All phone numbers</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="search" wire:model="search" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @empty ($brandPhoneNumbers[0])
                    <x-no-data />
                @else
                    @foreach ($brandPhoneNumbers as $brandPhoneNumber)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <div class="col-auto">
                                    <table class="table table-borderless table-sm">
                                        <tbody>
                                        <tr>
                                            <th>Name: </th>
                                            <td>{{ $brandPhoneNumber->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone number: </th>
                                            <td><a href="tel:+1{{ str_replace('-', '', $brandPhoneNumber->number) }}">{{ $brandPhoneNumber->number }}</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
</div>
