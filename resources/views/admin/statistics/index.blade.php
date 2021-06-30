@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 table_padding">
                <div class="d-flex justify-content-between align-items-center table_title">
                    <h1>Statistiche</h1>
                </div>
                <div class="panel">
                    <div class="panel-body table-responsive">
                        <table class="table">
                            <form>
                                <select class="btn my-orange text-capitalize" name="what1" id="what1" onchange="destroy1();graph1()">
                                    @foreach (['Ordini','Incassi'] as $what)
                                        <option value="{{$what}}">{{$what}}</option>
                                    @endforeach
                                </select>
                                <select class="btn my-orange text-capitalize" name="year" id="year" onchange="destroy1();graph1()">
                                    @foreach ([0,1,2,3,4,5,6,7,8,9] as $year)
                                        <option value="{{$year}}">{{$year + 2012}}</option>
                                    @endforeach
                                </select>
                            </form>
                            <div id="month-container" style="width:50vw; margin-bottom: 50px; min-width: 400px;">
                                <canvas id="myChart1"></canvas>
                            </div>
            
                            <form>
                                <select class="btn my-orange text-capitalize" name="what2" id="what2" onchange="destroy2();graph2()">
                                    @foreach (['Ordini','Incassi'] as $what)
                                        <option value="{{$what}}">{{$what}}</option>
                                    @endforeach
                                </select>
                            </form>
                            <div id="year-container" style="width:50vw; min-width: 400px;">
                                <canvas id="myChart2"></canvas>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function graph1() {
            var what1 = document.getElementById('what1').value;
            if (what1 == 'Ordini') {
                var arrays = <?php echo json_encode($orders_by_month_pretty); ?>;
            } else {
                var arrays = <?php echo json_encode($amount_by_month_pretty); ?>;
            };
            for (var i = 0; i < arrays.length; i++) {
                var year = document.getElementById('year').value;
                if (i == year) {
                    var ctx1 = document.getElementById('myChart1').getContext('2d');
                    var array = arrays[year];
                    var myChart1 = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
                            datasets: [{
                                label: what1 + ' per mese',
                                data: array,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            }
        };
        function destroy1() {
            $('#myChart1').remove();
            $('#month-container').append('<canvas id="myChart1" style="width:50vw; margin-bottom: 50px; min-width: 400px;"></canvas>');
        };
        graph1();

        function graph2() {
            var what2 = document.getElementById('what2').value;
            if (what2 == 'Ordini') {
                var array = <?php echo json_encode($orders_by_year_pretty); ?>;
            } else {
                var array = <?php echo json_encode($amount_by_year_pretty); ?>;
            };
            var ctx_years = document.getElementById('myChart2').getContext('2d');
            var myChart2 = new Chart(ctx_years, {
                type: 'bar',
                data: {
                    labels: ['2012','2013','2014','2015','2016','2017','2018','2019','2020','2021'],
                    datasets: [{
                        label: what2 + ' per anno',
                        data: array,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        function destroy2() {
            $('#myChart2').remove();
            $('#year-container').append('<canvas id="myChart2" style="width:50vw; margin-bottom: 50px; min-width: 400px;"></canvas>');
        };
        graph2();

    </script>
@endsection
