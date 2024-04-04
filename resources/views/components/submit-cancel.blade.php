@props(['id' => 'default'])
<div class="tw-flex tw-justify-between">
    <div class="tw-flex tw-justify-center tw-items-center">

    </div>
    <div style="tw-flex tw-justify-start">
        <button type="submit" id="save-{{ $id }}" class="btn btn-success btn-sm tw-mx-0.5 rounded-pill btn-wave waves-effect">
            Save
            <i class="fe fe-save"></i>
        </button>
        <button class="btn btn-danger btn-sm rounded-pill btn-wave waves-effect" wire:click.prevent="cancel">
            Cancel
            <i class="bi bi-x-octagon"></i>
        </button>
    </div>
</div>
