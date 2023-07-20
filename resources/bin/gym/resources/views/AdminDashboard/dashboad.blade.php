@extends('AdminDashboard.Main.app')
@section('page-title','Dashboard')
@push('mycss')
<!--here is you css-->
<link rel="stylesheet" href="{{asset('assets/css/shared/iconly.css')}}">
@endpush
@section('page_content')


<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Members</h6>
                                    <h6 class="font-extrabold mb-0">{{$member}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Services</h6>
                                    <h6 class="font-extrabold mb-0">{{$service}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Bar</h6>
                                    <h6 class="font-extrabold mb-0">{{$bar}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Monthly Sale</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="col-12 col-lg-3">
            
            <div class="card">
                <div class="card-header">
                    <h6>Member Gender Stats</h6>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                <h6>Member Category Stats</h6>
                </div>
                <div class="card-body">
                    <div id="chart-member-category"></div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('myscript')
<script src="{{ asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js')}}"></script>
<script>

   var male = <?php echo json_encode($male); ?>;
   var female = <?php echo json_encode($female); ?>;
   var daily = <?php echo json_encode($daily); ?>;
   var monthly = <?php echo json_encode($monthly); ?>;
   var bar_data=<?php echo json_encode($monthly_bar); ?>;
let optionsVisitorsProfile = {
    series: [male, female],
    labels: ["Male", "Female"],
    colors: ["#435ebe", "#55c6e8"],
    chart: { type: "donut", width: "100%", height: "350px" },
    legend: { position: "bottom" },
    plotOptions: { pie: { donut: { size: "30%" } } }
};
let optionsVisitorsProfileNew = {
    series: [daily, monthly],
    labels: ["Daily", "Monthly"],
    colors: ["#435ebe", "#55c6e8"],
    chart: { type: "donut", width: "100%", height: "350px" },
    legend: { position: "bottom" },
    plotOptions: { pie: { donut: { size: "30%" } } }
};
var optionsProfileVisit = {
    annotations: { position: "back" },
    dataLabels: { enabled: !1 },
    chart: { type: "bar", height: 300 },
    fill: { opacity: 1 },
    plotOptions: {},
    series: [{ name: "sales", data: bar_data}],
    colors: "#435ebe",
    xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"] }
};


 new ApexCharts(document.getElementById("chart-visitors-profile"),optionsVisitorsProfile).render();
 new ApexCharts(document.getElementById("chart-member-category"),optionsVisitorsProfileNew).render();
 new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit).render();

</script>
<!--here is you css-->
@endpush