@extends('layouts.app2')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">
                        <h4 style="color: #b960eb;text-decoration: none;">Estadisticas del Año actual</h4>
                    </li>
                </ul>
                {!! Form::open(['action'=>['App\Http\Controllers\AdminController@stats'], 'method' => 'POST']) !!}
                        <select name="mes" id="mes" class="form-select" onchange="this.form.submit()" style="margin: 15px;width: 150px;">
                            <option value="0">Anual</option>
                            <option value="1" @if($month == 1) selected @endif>Enero</option>
                            <option value="2" @if($month == 2) selected @endif>Febrero</option>
                            <option value="3" @if($month == 3) selected @endif>Marzo</option>
                            <option value="4" @if($month == 4) selected @endif>Abril</option>
                            <option value="5" @if($month == 5) selected @endif>Mayo</option>
                            <option value="6" @if($month == 6) selected @endif>Junio</option>
                            <option value="7" @if($month == 7) selected @endif>Julio</option>
                            <option value="8" @if($month == 8) selected @endif>Agosto</option>
                            <option value="9" @if($month == 9) selected @endif>Septiembre</option>
                            <option value="10" @if($month == 10) selected @endif>Octubre</option>
                            <option value="11" @if($month == 11) selected @endif>Noviembre</option>
                            <option value="12" @if($month == 12) selected @endif>Diciembre</option>
                        </select>
                {!! Form::close() !!}
                    <canvas id="myChart" height="500"></canvas>
                <script>
                    const MONTHS = [
                        'Enero',
                        'Febrero',
                        'Marzo',
                        'Abril',
                        'Mayo',
                        'Junio',
                        'Julio',
                        'Agosto',
                        'Septiembre',
                        'Octubre',
                        'Noviembre',
                        'Diciembre'
                    ];

                    //Funcion cuenta meses suministrada por chart.js
                    function months(config) {
                        var cfg = config || {};
                        var count = cfg.count || 12;
                        var section = cfg.section;
                        var values = [];
                        var i, value;

                        for (i = 0; i < count; ++i) {
                            value = MONTHS[Math.ceil(i) % 12];
                            values.push(value.substring(0, section));
                        }

                        return values;
                    }
                    @if($month==0)
                        const labels = months({count: {{$now->month}}});
                    @else
                        const labels = ' ';
                    @endif


                    const data = {
                        labels: labels,
                        datasets: [{
                        label: 'Usuarios Registrados',
                        backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(255, 99, 132)',
                        data: [@foreach($users as $dt) 
                                {{$dt}}, 
                            @endforeach],
                        },{
                            label: 'Likes Enviados',
                            backgroundColor: 'rgb(4, 59, 246)',
                            borderColor: 'rgb(4, 59, 246)',
                            data: [@foreach($likes as $dt) 
                                {{$dt}}, 
                            @endforeach],
                        },{
                            label: 'Calificaciones Enviadas',
                            backgroundColor: 'rgb(247, 239, 5 )',
                            borderColor: 'rgb(247, 239, 5 )',
                            data: [@foreach($ratings as $dt) 
                                {{$dt}}, 
                            @endforeach],
                        },{
                            label: 'Anuncios Creados',
                            backgroundColor: 'rgb(49, 187, 9)',
                            borderColor: 'rgb(49, 187, 9)',
                            data: [@foreach($posts as $dt) 
                                {{$dt}}, 
                            @endforeach],
                        },{
                            label: 'Citas Agendadas',
                            backgroundColor: 'rgb(203, 6, 195)',
                            borderColor: 'rgb(203, 6, 195)',
                            data: [@foreach($citas as $dt) 
                                {{$dt}}, 
                            @endforeach],
                        }]
                    };

                    const config = {    
                        type: @if(count($likes)==1)'bar'@else'line'@endif,
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: @if($month != 0) MONTHS[{{$month-1}}]+' {{$now->year}}' @else'Estadisticas {{$now->year}}'@endif
                                }
                            }
                        },
                    };

                    const myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                </script>  
            </div>
        </div>
    </div>
</div>
<br>
@endsection
