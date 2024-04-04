<?php

use App\Models\BrandEmail;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {
    public Collection $brandEmails;
    public ?BrandEmail $editing = null;

    public $brand;

    public function mount()
    {
        $this->getBrandEmails();
    }

    #[On('brand-email-created')]
    public function getBrandEmails()
    {
        $this->brandEmails = BrandEmail::where('brand_id', '=', $this->brand->id)
            ->orderBy('title')
            ->get();
    }

    public function edit(BrandEmail $email)
    {
        $this->editing = $email;

        $this->getBrandEmails();
    }

    #[On('brand-email-edit-canceled')]
    #[On('brand-email-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getBrandEmails();
    }

    public function delete(BrandEmail $email)
    {
        $this->authorize('brandemails.delete');

        $email->delete();

        $this->dispatch('brand-email-deleted');

        $this->getBrandEmails();
    }

    public function searchResults(string $partial)
    {
        if (!empty($partial)) {
            $this->brandEmails = BrandEmail::query()
                ->where('brand_id', '=', $this->brand->id)
                ->where(function (Builder $query) use ($partial) {
                    $query->where('title', 'like', '%' . $partial . '%')
                        ->orWhere('email', 'like', '%' . $partial . '%');
                })
                ->orderBy('title')
                ->get();
        } else {
            $this->getBrandEmails();
        }
    }

}; ?>

<div>
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
                                <div>
                                    @can ('brand-emails.edit')
                                        <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $brandEmail->id }})"><i class="bi bi-pencil"></i></button>
                                    @endcan
                                    @can ('brand-emails.delete')
                                        <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $brandEmail->id }})" wire:confirm="Are you sure you want to delete this brand?"><i class="bi bi-trash"></i></button>
                                    @endcan
                                </div>
                            </div>
                            @if ($brandEmail->is($editing))
                                <livewire:employee.brand-emails.edit :brandEmail="$brandEmail" :key="$brandEmail->id" />
                            @endif
                        </li>
                    @endforeach
                @endempty
            </ul>
        </div>
    </div>
</div>
