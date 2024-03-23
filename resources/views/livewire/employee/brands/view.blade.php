<?php

use App\Models\Brand;
use App\Models\StatusCode;
use Livewire\Volt\Component;

new class extends Component {
    public $brand;
    public $statusTitle;
    public $officeSchedule;
    public $serviceSchedule;
    public $afterHoursSchedule;

    public function mount()
    {
        $this->getStatusTitle();
        $this->makeOfficeSchedule();
        $this->makeServiceSchedule();
        $this->makeAfterHoursSchedule();
    }

    public function getStatusTitle()
    {
        $this->statusTitle = StatusCode::select('title')
            ->where('code', '=', $this->brand->status)
            ->get();
    }

    public function makeOfficeSchedule()
    {
    }

    public function makeServiceSchedule()
    {
        $this->serviceSchedule[0] = [
            'day' => 'Monday',
            'open' => $this->brand->service_hours_monday_open,
            'close' => $this->brand->service_hours_monday_close,
        ];

        $pointer = 'monday';

        if ($this->brand->service_hours_tuesday_open === $this->serviceSchedule[0]['open'] && $this->brand->service_hours_tuesday_close === $this->serviceSchedule[0]['close']) {
            $pointer = 'tuesday';
        }
        if ($this->brand->service_hours_wednesday_open === $this->serviceSchedule[0]['open'] && $this->brand->service_hours_wednesday_close === $this->serviceSchedule[0]['close']) {
            $pointer = 'wednesay';
        }
        if ($this->brand->service_hours_thursday_open === $this->serviceSchedule[0]['open'] && $this->brand->service_hours_thursday_close === $this->serviceSchedule[0]['close']) {
            $pointer = 'thursday';
        }
        if ($this->brand->service_hours_friday_open === $this->serviceSchedule[0]['open'] && $this->brand->service_hours_friday_close === $this->serviceSchedule[0]['close']) {
            $pointer = 'friday';
        }
        if ($this->brand->service_hours_saturday_open === $this->serviceSchedule[0]['open'] && $this->brand->service_hours_saturday_close === $this->serviceSchedule[0]['close']) {
            $pointer = 'saturday';
        }
        if ($this->brand->service_hours_sunday_open === $this->serviceSchedule[0]['open'] && $this->brand->service_hours_sunday_close === $this->serviceSchedule[0]['close']) {
            $pointer = 'sunday';
        }

        if ($pointer !== 'friday') {
            // Do this later...
        }

        $this->serviceSchedule[1] = [
            'day' => ucfirst($pointer),
            'open' => $this->brand->{'service_hours_' . $pointer . '_open'},
            'close' => $this->brand->{'service_hours_' . $pointer . '_close'},
        ];
    }

    public function makeAfterHoursSchedule()
    {
        $this->afterHoursSchedule[0] = [
            'day' => 'Monday',
            'open' => $this->brand->after_hours_monday_open,
            'close' => $this->brand->after_hours_monday_close,
        ];

        $pointer = 'monday';

        if ($this->brand->after_hours_tuesday_open === $this->afterHoursSchedule[0]['open'] && $this->brand->after_hours_tuesday_close === $this->afterHoursSchedule[0]['close']) {
            $pointer = 'tuesday';
        }
        if ($this->brand->after_hours_wednesday_open === $this->afterHoursSchedule[0]['open'] && $this->brand->after_hours_wednesday_close === $this->afterHoursSchedule[0]['close']) {
            $pointer = 'wednesay';
        }
        if ($this->brand->after_hours_thursday_open === $this->afterHoursSchedule[0]['open'] && $this->brand->after_hours_thursday_close === $this->afterHoursSchedule[0]['close']) {
            $pointer = 'thursday';
        }
        if ($this->brand->after_hours_friday_open === $this->afterHoursSchedule[0]['open'] && $this->brand->after_hours_friday_close === $this->afterHoursSchedule[0]['close']) {
            $pointer = 'friday';
        }
        if ($this->brand->after_hours_saturday_open === $this->afterHoursSchedule[0]['open'] && $this->brand->after_hours_saturday_close === $this->afterHoursSchedule[0]['close']) {
            $pointer = 'saturday';
        }
        if ($this->brand->after_hours_sunday_open === $this->afterHoursSchedule[0]['open'] && $this->brand->after_hours_sunday_close === $this->afterHoursSchedule[0]['close']) {
            $pointer = 'sunday';
        }

        if ($pointer !== 'friday') {
            // Do this later...
        }

        $this->afterHoursSchedule[1] = [
            'day' => ucfirst($pointer),
            'open' => $this->brand->{'office_hours_' . $pointer . '_open'},
            'close' => $this->brand->{'office_hours_' . $pointer . '_close'},
        ];
    }
}; ?>

<div>
    <!-- Tabs start -->
    <ul class="nav nav-pills mb-2" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-overview-tab" data-bs-toggle="pill" data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview" aria-selected="true">Overview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-clients-tab" data-bs-toggle="pill" data-bs-target="#pills-clients" type="button" role="tab" aria-controls="pills-clients" aria-selected="false">Clients</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-documents-tab" data-bs-toggle="pill" data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents" aria-selected="false">Documents</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-work-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-work-orders" type="button" role="tab" aria-controls="pills-work-orders" aria-selected="false">Work Orders</button>
        </li>
    </ul>
    <!-- Tabs end -->

    <!-- Tab content start -->
    <div class="tab-content" id="pills-tabContent">
        <!-- Overview tab content start -->
        <div class="tab-pane fade show active" id="pills-overview" role="tabpanel" aria-labelledby="pills-overview-tab" tabindex="0">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="text-lg">Basic data</h1>
                    <div class="row">

                        <!-- Status -->
                        <div class="col-lg-3">
                            <div class="form-floating mb-2">
                                <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                    {{ $brand->status }} - {{ $statusTitle[0]->title }}
                                </div>
                                <label>Status</label>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <!-- Legal name -->
                        <div class="col-lg-3">
                            <div class="form-floating mb-2">
                                <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                    {{ $brand->legal_name }}
                                </div>
                                <label>Legal name</label>
                            </div>
                        </div>

                        <!-- DBA -->
                        <div class="col-lg-3">
                            <div class="form-floating mb-2 mb-2">
                                <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                    {{ $brand->dba }}
                                </div>
                                <label>DBA</label>
                            </div>
                        </div>

                        <!-- Abbreviation -->
                        <div class="col-lg-2">
                            <div class="form-floating mb-2">
                                <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                    {{ $brand->abbreviation }}
                                </div>
                                <label>Abbreviation</label>
                            </div>
                        </div>

                        <!-- Internal work order number prefix -->
                        <div class="col-lg-2">
                            <div class="form-floating mb-2">
                                <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                    {{ $brand->internal_work_order_number_prefix }}
                                </div>
                                <label>Internal work order prefix</label>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <!-- Office schedule -->
                        @if (!array_key_exists(3, $this->officeSchedule))
                            <div class="col-lg-3">
                                <div class="form-floating mb-2">
                                    <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                        {{ substr($officeSchedule[0]['day'], 0, 1) }}-{{ substr($officeSchedule[1]['day'], 0, 1) }}, {{ $officeSchedule[0]['open'] }} to {{ $officeSchedule[0]['close'] }}
                                    </div>
                                    <label>Office hours</label>
                                </div>
                            </div>
                        @else
                        @endif

                        <!-- Service schedule -->
                        @if (!array_key_exists(3, $this->serviceSchedule))
                            <div class="col-lg-3">
                                <div class="form-floating mb-2">
                                    <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                        {{ substr($serviceSchedule[0]['day'], 0, 1) }}-{{ substr($serviceSchedule[1]['day'], 0, 1) }}, {{ $serviceSchedule[0]['open'] }} to {{ $serviceSchedule[0]['close'] }}
                                    </div>
                                    <label>service hours</label>
                                </div>
                            </div>
                        @else
                        @endif

                        <!-- After hours schedule -->
                        @if (!array_key_exists(3, $this->afterHoursSchedule))
                            <div class="col-lg-3">
                                <div class="form-floating mb-2">
                                    <div class="form-control rounded-0 tw-border-0 tw-border-b">
                                        {{ substr($afterHoursSchedule[0]['day'], 0, 1) }}-{{ substr($afterHoursSchedule[1]['day'], 0, 1) }}, {{ $afterHoursSchedule[0]['open'] }} to {{ $afterHoursSchedule[0]['close'] }}
                                    </div>
                                    <label>service hours</label>
                                </div>
                            </div>
                        @else
                        @endif
                    </div>

                </div>
                <div class="col-lg-2 tw-flex tw-justify-center tw-items-center">
                    <img src="{{ asset($brand->logo_path) }}" class="tw-w-full tw-max-w-[400px] lg:tw-max-w-full">
                </div>
            </div>

            <div class="row">
                <hr class="tw-border-gray-300 tw-my-6">
            </div>

            <div class="row"></div>
        </div>
        <!-- Overview tab content end -->

        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="pills-clients" role="tabpanel" aria-labelledby="pills-clients-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab" tabindex="0">...</div>
        <div class="tab-pane fade" id="pills-work-orders" role="tabpanel" aria-labelledby="pills-work-orders-tab" tabindex="0">...</div>
    </div>
    <!-- Tab content end -->
</div>
