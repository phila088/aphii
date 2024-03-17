<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $chartData;
    public $what;

    public function mount(): void
    {
        $this->getData();
        $this->moreTesting();
    }

    public function moreTesting()
    {
        $workOrder = new \App\Models\WorkOrder();
        $workOrder->mergeCasts([
            'created_at' => 'date:Y-m-d'
        ]);
        $this->what = $workOrder->select('deleted_at')
            ->whereDate('created_at', '=', now()->toDateString())
            ->groupBy('created_at')
            ->count();
    }

    public function click()
    {
        return $this->chartData = [
            'series' => [
                [
                    'name' => 'BWRKS',
                    'data' => [rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100)]
                ],
                [
                    'name' => 'MIHM',
                    'data' => [rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100)]
                ],
                [
                    'name' => 'STATS',
                    'data' => [rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100), rand(20,100)]
                ],
            ],
        ];
    }

    #[On('new-work-order-created')]
    #[On('work-order-cancelled')]
    public function getData(): void
    {
        $this->chartData = [
            'series' => [
                [
                    'name' => 'BWRKS',
                    'data' => [44, 55, 57, 56, 61, 58, 63, 60, 66],
                ],
                [
                    'name' => 'MIHM',
                    'data' => [76, 85, 101, 98, 87, 105, 91, 114, 94],
                ],
                [
                    'name' => 'STATS',
                    'data' => [35, 41, 36, 26, 45, 48, 52, 53, 41],
                ],
            ]
        ];
    }
}; ?>

<div>
    <div id="chart"
         wire:ignore
    >
    </div>

    <script src="{{asset('build/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    @script
    <script>
        let data = await $wire.chartData;
        let options = {
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['4', '5', '6', '7', '8', '9', '10', '11', '12'],
            },
            yaxis: {
                title: {
                    text: '$ (thousands)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        };
        options.series = data.series;
        let chart = new ApexCharts(document.querySelector('#chart'), options);
        chart.render();

        async function getData() {
            console.log('refresh work orders by brand data')
            data = await $wire.chartData;
            await chart.updateSeries(data.series)
        }

        setInterval(function () {
            let click = $wire.click();
            getData();
        }, Math.floor(Math.random() * 60000) + 30000);

    </script>
    @endscript

</div>
