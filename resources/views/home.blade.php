@extends('layouts.app')

@section('content')

<!--sidebar wrapper -->
@include('partials.sidebar')
<!--end sidebar wrapper -->

<!--start header -->
@include('partials.topbar')
<!--end header -->

<div class="page-content">
    <div class="row">
        <div class="col-md-3">
            <div class="card radius-10">
                <a href="{{URL::to('brand')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">BRANDS</p>
                                <h4 class="my-1">{{ $brands}}</h4>
                                <p class="mb-0 font-13 text-success">
                                    Total Brands</p>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card radius-10">
                <a href="{{URL::to('category')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">CATEGORIES</p>
                                <h4 class="my-1">{{ $categories}}</h4>
                                <p class="mb-0 font-13 text-success">
                                    Total Categories</p>
                            </div>
                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                        <!-- <div id="chart2"></div> -->
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card radius-10">
                <a href="{{URL::to('products')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">PRODUCTS</p>
                                <h4 class="my-1">{{ $products}}</h4>
                                <p class="mb-0 font-13 text-danger">
                                    Total Products</p>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
                            </div>
                        </div>
                        <!-- <div id="chart3"></div> -->
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card radius-10">
                <a href="{{URL::to('product_item')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">ITEMS</p>
                                <h4 class="my-1">{{ $productitems}}</h4>
                                <p class="mb-0 font-13 text-danger">
                                    Total Items</p>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
                            </div>
                        </div>
                        <!-- <div id="chart3"></div> -->
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--end row-->
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10">
                <a href="{{URL::to('stock_price_detail')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">TOTAL PURCHASE </p>
                                <h4 class="my-1">{{ $results->total_purchase_price}}</h4>
                                <p class="mb-0 font-13 text-success">
                                    Total Purchase Amount</p>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto"><i class='bx bx-cart'></i>
                            </div>
                        </div>
                        <!-- <div id="chart1"></div> -->
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <a href="{{URL::to('stock_price_detail')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">TOTAL INVESTMENT</p>
                                <h4 class="my-1">{{ $results->total_investment}}</h4>
                                <p class="mb-0 font-13 text-success">
                                    Total Investment Amount</p>
                            </div>
                            <div class="widgets-icons bg-light-warning text-warning ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                        <!-- <div id="chart2"></div> -->
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <a href="{{URL::to('stock_price_detail')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">TOTAL EXP SALE</p>
                                <h4 class="my-1">{{ $results->total_sale_price}}</h4>
                                <p class="mb-0 font-13 text-danger">
                                    Total Expected Sales Amount </p>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto"><i class='bx bxs-binoculars'></i>
                            </div>
                        </div>
                        <!-- <div id="chart3"></div> -->
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row row-cols-1 row-cols-lg-3">
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Investment Graph</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                        </div>
                    </div>
                    <div class="mt-5" id="investment"></div>
                </div>
                <!-- <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Kids <span class="badge bg-success rounded-pill">25</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Women <span class="badge bg-danger rounded-pill">10</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Men <span class="badge bg-primary rounded-pill">65</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                        Furniture <span class="badge bg-warning text-dark rounded-pill">14</span>
                    </li>
                </ul> -->
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <p class="font-weight-bold mb-1 text-secondary">Visitors</p>
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="mb-0">43,540</h4>
                        </div>
                        <div class="">
                            <p class="mb-0 align-self-center font-weight-bold text-success ms-2">4.4 <i class='bx bxs-up-arrow-alt mr-2'></i>
                            </p>
                        </div>
                    </div>
                    <div id="chart4"></div>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Time</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                        </div>
                    </div>
                    <div id="container"></div>
                    <!-- <div class="mt-5" id="chart20"></div> -->
                </div>
                <!-- <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex align-items-center justify-content-between text-center">
                        <div>
                            <h6 class="mb-1 font-weight-bold">$289.42</h6>
                            <p class="mb-0 text-secondary">Last Week</p>
                        </div>
                        <div class="mb-1">
                            <h6 class="mb-1 font-weight-bold">$856.14</h6>
                            <p class="mb-0 text-secondary">Last Month</p>
                        </div>
                        <div>
                            <h6 class="mb-1 font-weight-bold">$987,25</h6>
                            <p class="mb-0 text-secondary">Last Year</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <a href="{{URL::to('low_stock_items')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Low Stock Items</p>
                                <h5 class="mb-0">{{$low_stock}}</h5>
                            </div>
                            <div class="ms-auto"><i class="bx bx-cart font-30"></i>
                            </div>
                        </div>
                        <div class="progress radius-10 mt-4 h-5">
                            <div class="progress-bar bg-warning w-100" role="progressbar"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <a href="{{URL::to('out_stock_items')}}" target="_blank">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0">Out of Stock Items</p>
                                <h5 class="mb-0">{{$zero_stock}}</h5>
                            </div>
                            <div class="ms-auto"><i class="bx bx-wallet font-30"></i>
                            </div>
                        </div>
                        <div class="progress radius-10 mt-4 h-5">
                            <div class="progress-bar bg-danger w-100" role="progressbar"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total # of Purchases</p>
                            <h5 class="mb-0">{{$total_purchases}}</h5>
                        </div>
                        <div class="ms-auto"><i class="bx bx-bulb font-30"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 mt-4 h-5">
                        <div class="progress-bar bg-success w-100" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Purchase Amount</p>
                            <h5 class="mb-0">{{$total_purchase_amount->total_purchase}}</h5>
                        </div>
                        <div class="ms-auto"><i class="bx bx-chat font-30"></i>
                        </div>
                    </div>
                    <div class="progress radius-10 mt-4 h-5">
                        <div class="progress-bar bg-info w-100" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-xl-8 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Warehouse Metrics</h5>
                        </div>
                        <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table align-middle mb-0 table-hover" id="Transaction-History">
                            <thead class="table-success">
                                <tr>
                                    <th>Warehouse Name</th>
                                    <th>Purchases</th>
                                    <th>Investments</th>
                                    <th>Exp Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wherehouse_stats as $stats)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <!-- <img src="" class="rounded-circle" width="46" height="46" alt="" /> -->
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">
                                                    {{get_warehouse_details($stats->wh_id)->wh_title}}
                                                </h6>
                                                <!-- <p class="mb-0 font-13 text-secondary">Refrence Id #4278620
                                                </p> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            {{$stats->total_purchase_price_inwarehouse}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            {{$stats->total_investment_inwarehouse}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="">
                                            {{$stats->total_sale_price_inwarehouse}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-secondary">Total # of Sales</p>
                            <h4 class="mb-0">{{$sales_stats->sales}}</h4>
                        </div>
                        <div class="ms-auto">
                            <!-- <p class="mb-0 font-13 text-success">+12.34 Increase</p>
                            <p class="mb-0 font-13 text-secondary">From Last Week</p> -->
                        </div>
                    </div>
                </div>
                <!-- <div id="chart12"></div> -->
            </div>
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-secondary">Revenue</p>
                            <h4 class="mb-0">{{$sales_stats->rvenue}}</h4>
                        </div>
                        <div class="ms-auto">
                            <!-- <p class="mb-0 font-13 text-success">+21.34 Increase</p>
                            <p class="mb-0 font-13 text-secondary">From Last Week</p> -->
                        </div>
                    </div>
                </div>
                <!-- <div id="chart13"></div> -->
            </div>
        </div>
        <div class="col-xl-2">
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-secondary">Cost</p>
                            <h4 class="mb-0">{{$sales_stats->total_investment}}</h4>
                        </div>
                        <div class="ms-auto">
                            <!-- <p class="mb-0 font-13 text-success">+18.42 Increase</p>
                            <p class="mb-0 font-13 text-secondary">From Last Week</p> -->
                        </div>
                    </div>
                </div>
                <!-- <div id="chart14"></div> -->
            </div>
            <div class="card radius-10 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <p class="mb-1 text-secondary">Profit</p>
                            <h4 class="mb-0">{{$sales_stats->total_profit}}</h4>
                        </div>
                        <div class="ms-auto">
                            <!-- <p class="mb-0 font-13 text-success">+18.42 Increase</p>
                            <p class="mb-0 font-13 text-secondary">From Last Week</p> -->
                        </div>
                    </div>
                </div>
                <!-- <div id="chart14"></div> -->
            </div>
        </div>
    </div>
    <!--end row-->


</div>

<script>
    $(function() {
        "use strict";
        var e = {
            series: [<?php echo $results->total_purchase_price; ?>, <?php echo $results->total_investment; ?>,
                <?php echo $results->total_sale_price; ?>
            ],
            chart: {
                height: 240,
                type: "pie"
            },
            legend: {
                position: "bottom",
                show: !1
            },
            plotOptions: {
                pie: {
                    pie: {
                        size: "80%"
                    }
                }
            },
            colors: ["#17a00e", "#0d6efd", "#0dcaf0"],
            dataLabels: {
                enabled: !1
            },
            labels: ["Purchase", "Investment", "Exp Sale"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        height: 200
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }]
        };
        new ApexCharts(document.querySelector("#investment"), e).render();
    })
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    /**
     * Get the current time
     */
    function getNow() {
        var now = new Date();
        return {
            hours: now.getHours() + now.getMinutes() / 60,
            minutes: now.getMinutes() * 12 / 60 + now.getSeconds() * 12 / 3600,
            seconds: now.getSeconds() * 12 / 60
        };
    }

    /**
     * Pad numbers
     */
    function pad(number, length) {
        // Create an array of the remaining length + 1 and join it with 0's
        return new Array((length || 2) + 1 - String(number).length).join(0) + number;
    }

    var now = getNow();

    // Create the chart
    Highcharts.chart('container', {

            chart: {
                type: 'gauge',
                plotBackgroundColor: null,
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: '80%'
            },

            credits: {
                enabled: false
            },

            title: {
                text: 'Pakistan Standerd Time'
            },

            pane: {
                background: [{
                    // default background
                }, {
                    // reflex for supported browsers
                    backgroundColor: Highcharts.svg ? {
                        radialGradient: {
                            cx: 0.5,
                            cy: -0.4,
                            r: 1.9
                        },
                        stops: [
                            [0.5, 'rgba(255, 255, 255, 0.2)'],
                            [0.5, 'rgba(200, 200, 200, 0.2)']
                        ]
                    } : null
                }]
            },

            yAxis: {
                labels: {
                    distance: -20
                },
                min: 0,
                max: 12,
                lineWidth: 0,
                showFirstLabel: false,

                minorTickInterval: 'auto',
                minorTickWidth: 1,
                minorTickLength: 5,
                minorTickPosition: 'inside',
                minorGridLineWidth: 0,
                minorTickColor: '#666',

                tickInterval: 1,
                tickWidth: 2,
                tickPosition: 'inside',
                tickLength: 10,
                tickColor: '#666',
                title: {
                    text: 'Powered by<br/>Hammad',
                    style: {
                        color: '#BBB',
                        fontWeight: 'normal',
                        fontSize: '8px',
                        lineHeight: '10px'
                    },
                    y: 10
                }
            },

            tooltip: {
                formatter: function() {
                    return this.series.chart.tooltipText;
                }
            },

            series: [{
                data: [{
                    id: 'hour',
                    y: now.hours,
                    dial: {
                        radius: '60%',
                        baseWidth: 4,
                        baseLength: '95%',
                        rearLength: 0
                    }
                }, {
                    id: 'minute',
                    y: now.minutes,
                    dial: {
                        baseLength: '95%',
                        rearLength: 0
                    }
                }, {
                    id: 'second',
                    y: now.seconds,
                    dial: {
                        radius: '100%',
                        baseWidth: 1,
                        rearLength: '20%'
                    }
                }],
                animation: false,
                dataLabels: {
                    enabled: false
                }
            }]
        },

        // Move
        function(chart) {
            setInterval(function() {
                now = getNow();

                if (chart.axes) { // not destroyed
                    var hour = chart.get('hour'),
                        minute = chart.get('minute'),
                        second = chart.get('second'),
                        // run animation unless we're wrapping around from 59 to 0
                        animation = now.seconds === 0 ?
                        false : {
                            easing: 'easeOutBounce'
                        };

                    // Cache the tooltip text
                    chart.tooltipText =
                        pad(Math.floor(now.hours), 2) + ':' +
                        pad(Math.floor(now.minutes * 5), 2) + ':' +
                        pad(now.seconds * 5, 2);


                    hour.update(now.hours, true, animation);
                    minute.update(now.minutes, true, animation);
                    second.update(now.seconds, true, animation);
                }

            }, 1000);

        });

    /**
     * Easing function from https://github.com/danro/easing-js/blob/master/easing.js
     */
    Math.easeOutBounce = function(pos) {
        if ((pos) < (1 / 2.75)) {
            return (7.5625 * pos * pos);
        }
        if (pos < (2 / 2.75)) {
            return (7.5625 * (pos -= (1.5 / 2.75)) * pos + 0.75);
        }
        if (pos < (2.5 / 2.75)) {
            return (7.5625 * (pos -= (2.25 / 2.75)) * pos + 0.9375);
        }
        return (7.5625 * (pos -= (2.625 / 2.75)) * pos + 0.984375);
    };
</script>
<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->

<!--start page footer -->
@include('partials.footer')
<!--start page footer -->

<!--start switcher-->
@include('partials.theme_customizer')
<!--end switcher-->

@endsection