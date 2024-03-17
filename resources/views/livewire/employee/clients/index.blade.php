<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Number;

new class extends Component {
    public ?Collection $clients = null;

    public function mount(): void
    {
        $this->getData();
    }

    public function getData()
    {
        $this->clients = Client::with([
            'user',
            'clientPortal',
            'clientRate',
            'paymentTerm'
        ])
            ->get();

        $rates = [];

        foreach ($this->clients as $client)
        {
            if (!empty($client->clientRate[0])) {
                $i = 0;
                foreach ($client->clientRate as $rate) {
                    $rates[$i]['title'] = (!empty($rate->title)) ? $rate->title : 'Rate ' . $i;
                    $rates[$i]['default'] = $rate->default;
                    $rates[$i]['standard_assessment'] = (!is_null($rate->standard_assessment)) ? $rate->standard_assessment : 0;
                    $rates[$i]['emergency_assessment'] = (!is_null($rate->emergency_assessment)) ? $rate->emergency_assessment : 0;
                    $rates[$i]['overtime_assessment'] = (!is_null($rate->overtime_assessment)) ? $rate->overtime_assessment : 0;
                    $rates[$i]['saturday_assessment'] = (!is_null($rate->saturday_assessment)) ? $rate->saturday_assessment : 0;
                    $rates[$i]['sunday_assessment'] = (!is_null($rate->sunday_assessment)) ? $rate->sunday_assessment : 0;
                    $rates[$i]['holiday_assessment'] = (!is_null($rate->holiday_assessment)) ? $rate->holiday_assessment : 0;
                    $rates[$i]['standard_trip'] = (!is_null($rate->standard_trip)) ? $rate->standard_trip : 0;
                    $rates[$i]['standard_hour'] = (!is_null($rate->standard_hour)) ? $rate->standard_hour : 0;
                    $rates[$i]['emergency_trip'] = (!is_null($rate->emergency_trip)) ? $rate->emergency_trip : 0;
                    $rates[$i]['emergency_hour'] = (!is_null($rate->emergency_hour)) ? $rate->emergency_hour : 0;
                    $rates[$i]['overtime_trip'] = (!is_null($rate->overtime_trip)) ? $rate->overtime_trip : 0;
                    $rates[$i]['overtime_hour'] = (!is_null($rate->overtime_hour)) ? $rate->overtime_hour : 0;
                    $rates[$i]['saturday_trip'] = (!is_null($rate->saturday_trip)) ? $rate->saturday_trip : 0;
                    $rates[$i]['saturday_hour'] = (!is_null($rate->saturday_hour)) ? $rate->saturday_hour : 0;
                    $rates[$i]['sunday_trip'] = (!is_null($rate->sunday_trip)) ? $rate->sunday_trip : 0;
                    $rates[$i]['sunday_hour'] = (!is_null($rate->sunday_hour)) ? $rate->sunday_hour : 0;
                    $rates[$i]['holiday_trip'] = (!is_null($rate->holiday_trip)) ? $rate->holiday_trip : 0;
                    $rates[$i]['holiday_hour'] = (!is_null($rate->holiday_hour)) ? $rate->holiday_hour : 0;
                }
            }
            $client->rates = $rates;
        }
    }

    #[On('client-created')]
    public function refresh(): void
    {
        $this->getData();
    }
}; ?>



<div class="row tw-max-w-full tw-overflow-x-auto mx-auto">

    <table id="clients" class="tw-min-w-full tw-max-w-full tw-divide-y tw-divide-gray-200" style="width:100%">
        <colgroup span="4"></colgroup>
        <colgroup span="3"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="2"></colgroup>
        <colgroup span="1"></colgroup>
        <thead>
            <tr>
                <td colspan="4"></td>
                <td colspan="3">Portal</td>
                <td colspan="2">Regular</td>
                <td colspan="2">Emergency</td>
                <td colspan="2">Overtime</td>
                <td colspan="2">Saturday</td>
                <td colspan="2">Sunday</td>
                <td colspan="2">Holiday</td>
                <td colspan="2">Customer Service</td>
                <td colspan="2">Invoicing</td>
                <td colspan="2">IVR</td>
                <td colspan="2">Onsite</td>
                <td colspan="2">Remittance</td>
                <td rowspan="2"> User</td>

            </tr>
            <tr>
                <td>Brand</td>
                <td>Name</td>
                <td>Abbreviation</td>
                <td>Status</td>
                <td>Portal Link</td>
                <td>Username</td>
                <td>Password</td>
                <td>Trip</td>
                <td>Labor</td>
                <td>Trip</td>
                <td>Labor</td>
                <td>Trip</td>
                <td>Labor</td>
                <td>Trip</td>
                <td>Labor</td>
                <td>Trip</td>
                <td>Labor</td>
                <td>Trip</td>
                <td>Labor</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Email</td>

            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td><a href="#">{{ $client->for_brand }}</a></td>
                    <td><a href="{{ route('employee.clients.view', $client->id) }}">{{ $client->legal_name }}</a></td>
                    <td>{{ $client->abbreviation }}</td>
                    @switch($client->status)
                        @case('New Client')
                            <td class="tw-bg-black tw-text-red-500">{{ $client->status }}</td>
                            @break
                        @case('DNU')
                            <td class="tw-bg-red-500 tw-text-black">{{ $client->status }}</td>
                            @break
                        @case('Active')
                            <td class="tw-bg-green-500/75 tw-text-gray-900">{{ $client->status }}</td>
                            @break
                        @default
                            <td>{{ $client->status }}</td>
                            @break
                    @endswitch
                    @if(!is_null($client->clientPortal))
                        <td><a href="{{ url($client->clientPortal->url) }}">Link</a></td>
                        <td>{{ $client->clientPortal->username }}</td>
                        <td>{{ $client->clientPortal->password }}</td>
                    @else
                        <td>No Portal</td>
                        <td></td>
                        <td></td>
                    @endif
                    @if(!empty($client->rates[0]))
                        <td>{{ Number::currency($client->rates[0]['standard_trip']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['standard_hour']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['emergency_trip']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['emergency_hour']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['overtime_trip']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['overtime_hour']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['saturday_trip']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['saturday_hour']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['sunday_trip']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['sunday_hour']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['holiday_trip']) }}</td>
                        <td>{{ Number::currency($client->rates[0]['holiday_hour']) }}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                    <td>{{ $client->customer_service_phone_1 }}</td>
                    <td>{{ $client->customer_service_email_1 }}</td>
                    <td>{{ $client->invoicing_service_phone_1 }}</td>
                    <td>{{ $client->invoicing_service_email_1 }}</td>
                    <td>{{ $client->ivr_service_phone_1 }}</td>
                    <td>{{ $client->ivr_service_email_1 }}</td>
                    <td>{{ $client->onsite_service_phone_1 }}</td>
                    <td>{{ $client->onsite_service_email_1 }}</td>
                    <td>{{ $client->remittance_service_phone_1 }}</td>
                    <td>{{ $client->remittance_service_email_1 }}</td>
                    <td>{{ $client->user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @assets
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{ asset('js/dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.tailwindcss.js') }}"></script>
    @endassets

    @script
    <script>
        let groupColumn = 0;

        new DataTable('#clients', {
            columnDefs: [{
                visible: false,
                targets: groupColumn
            }],
            drawCallback: function (settings) {
                let api = this.api();
                let rows = api.rows({ page: 'current' }).nodes();
                let last = null;

                api.column(groupColumn, { page: 'current' })
                    .data()
                    .each(function (group, i) {
                        if (last !== group) {
                            $(rows)
                                .eq(i)
                                .before(
                                    '<tr class="group tw-py-4"><td colspan="29">' +
                                    group +
                                    '</td></tr>'
                                );
                            last = group;
                        }
                    });
            },
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
            search: {
                return: true
            },
            stateSave: true,
        });

        $('#clients tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                table.order([groupColumn, 'desc']).draw();
            }
            else {
                table.order([groupColumn, 'asc']).draw();
            }
        });
    </script>
    @endscript
</div>
