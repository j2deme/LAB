@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div id="chart"></div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/apexcharts.min.js') }}"></script>
<script>
  var options = {
    chart: {
      height: 350,
      type: 'bar',
    },
    plotOptions: {
      bar: {
        horizontal: false,
        endingShape: 'rounded'
      }
    },
    dataLabels: {
      enabled: true
    },
    series: [{
      data: @json($items->pluck('stock'))
    }],
    xaxis: {
      categories: @json($items->pluck('name')),
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val + " unidades"
        }
      }
    }
  }

  var chart = new ApexCharts(document.querySelector("#chart"), options);

  chart.render();
</script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/apexcharts.css') }}">
<style>
  #chart {
    max-width: 650px;
    margin: 35px auto;
  }

</style>
@endsection
