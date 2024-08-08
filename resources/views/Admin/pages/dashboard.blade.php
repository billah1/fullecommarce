@extends('Admin.master')
@push('css')
    <!-- Add these lines in the head tag of your layout file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.min.js"></script>

@endpush
@section('content')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-12">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            General Report
                        </h2>
                        <a href="" class="ml-auto flex items-center text-primary"> <i data-feather="refresh-ccw"
                                                                                      class="w-4 h-4 mr-3"></i> Reload
                            Data </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="shopping-cart" class="report-box__icon text-primary"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $itemSale }}</div>
                                    <div class="text-base text-slate-500 mt-1">Item Sales</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="credit-card" class="report-box__icon text-pending"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $totalOrders }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total Orders</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="monitor" class="report-box__icon text-warning"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $totalProducts }}</div>
                                    <div class="text-base text-slate-500 mt-1">Total Products</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="user" class="report-box__icon text-success"></i>
                                        <div class="ml-auto">
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{ $totalUsers }}</div>
                                    <div class="text-base text-slate-500 mt-1">Unique Visitor</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-6 mt-8">
                    <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Sales Report
                        </h2>
                    </div>
                    <div class="intro-y box p-5 mt-12 sm:mt-5">
                        <div class="flex flex-col xl:flex-row xl:items-center">
                            <div class="flex">
                                <div>
                                    <div class="text-primary dark:text-slate-300 text-lg xl:text-xl font-medium">
                                        ৳{{ $currentMonthTotal }}
                                    </div>
                                    <div class="mt-0.5 text-slate-500">This Month</div>
                                </div>
                                <div
                                    class="w-px h-12 border border-r border-dashed border-slate-200 dark:border-darkmode-300 mx-4 xl:mx-5"></div>
                                <div>
                                    <div class="text-slate-500 text-lg xl:text-xl font-medium">৳{{ $previousMonthTotal }}</div>
                                    <div class="mt-0.5 text-slate-500">Last Month</div>
                                </div>
                            </div>
                        </div>
                        <div class="report-chart">
                            <div id="salesChart" height="163" class="mt-6"></div>
                        </div>
                    </div>
                </div>
                <!-- END: Sales Report -->
                <!-- BEGIN: Weekly Top Seller -->
                <div class="col-span-12 sm:col-span-6 lg:col-span-6 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Unique Visitors
                        </h2>
                    </div>
                    <div class="intro-y box p-5 mt-5">
                        <div class="mt-3" id="uniqueVisitsChart" height="300"></div>
                    </div>
                </div>
{{--                <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">--}}
{{--                    <div class="intro-y flex items-center h-10">--}}
{{--                        <h2 class="text-lg font-medium truncate mr-5">--}}
{{--                            Sales Report--}}
{{--                        </h2>--}}
{{--                        <a href="" class="ml-auto text-primary truncate">Show More</a>--}}
{{--                    </div>--}}
{{--                    <div class="intro-y box p-5 mt-5">--}}
{{--                        <canvas class="mt-3" id="report-donut-chart" height="300"></canvas>--}}
{{--                        <div class="mt-8">--}}
{{--                            <div class="flex items-center">--}}
{{--                                <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>--}}
{{--                                <span class="truncate">17 - 30 Years old</span> <span class="font-medium xl:ml-auto">62%</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center mt-4">--}}
{{--                                <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>--}}
{{--                                <span class="truncate">31 - 50 Years old</span> <span class="font-medium xl:ml-auto">33%</span>--}}
{{--                            </div>--}}
{{--                            <div class="flex items-center mt-4">--}}
{{--                                <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>--}}
{{--                                <span class="truncate">>= 50 Years old</span> <span class="font-medium xl:ml-auto">10%</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            fetch('/sales-data')
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: [{
                            name: "Sales",
                            data: data.data
                        }],
                        chart: {
                            type: 'line',
                            height: 350
                        },
                        xaxis: {
                            categories: data.labels
                        },
                        yaxis: {
                            title: {
                                text: 'Sales ($)'
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "$" + val
                                }
                            }
                        }
                    };

                    var chart = new ApexCharts(document.querySelector("#salesChart"), options);
                    chart.render();
                })
                .catch(error => console.log(error));
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            fetch('/unique-user-visits')
                .then(response => response.json())
                .then(data => {
                    var options = {
                        series: data.data,
                        chart: {
                            type: 'radialBar',
                            height: 448
                        },
                        plotOptions: {
                            radialBar: {
                                dataLabels: {
                                    name: {
                                        fontSize: '22px',
                                    },
                                    value: {
                                        fontSize: '16px',
                                    },
                                    total: {
                                        show: true,
                                        label: 'Total Unique Site Visitors',
                                        formatter: function (w) {
                                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                            return data.data
                                        }
                                    }
                                }
                            }
                        },
                        labels: data.labels,
                    };

                    var chart = new ApexCharts(document.querySelector("#uniqueVisitsChart"), options);
                    chart.render();
                })
                .catch(error => console.log(error));
        });
    </script>
@endpush
