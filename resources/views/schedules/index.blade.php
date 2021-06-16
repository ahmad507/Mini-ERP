@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>Chart</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="canvas" height="280" width="560">
                       
                    </canvas>
                    <div class="dropdown-divider"></div>
                    @foreach($cuttings as $cutting)
                        <div class="badge bg-blue badge">
                            {{ $cutting->mesin }}
                            <div class="dropdown-divider"></div>
                            <div> SKU :{{ $cutting->schedules->count('code') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- ============================================================================================================ --}}
        {{-- CARD DETAIL SCHEDULE --}}
        <div class="col-md-5">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"><b>Add Schedule Cutting</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('schedule.store') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <input type="text" name="code" class="form-control text-uppercase" placeholder="Code Steel">
                        
                    </div>
                    <div class="form-group col-md-3">
                        <select id="inputState" name="cutting_id" class="form-control text-uppercase">
                            <option selected>Machine</option>
                            @foreach($cuttings as $id => $cutting)
                                <option value="{{ $id+1 }}"
                                    {{ old('cutting_id') == $id ? 'selected' : '' }}>
                                    {{ $cutting->mesin }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select id="inputState" name="treatment" class="form-control text-uppercase">
                            @foreach($materials as $id =>  $material)
                                <option value="{{ $id }}"
                                    {{ old('treatment') == $id ? 'selected' : '' }}>
                                    {{ $material }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <select id="inputState" name="sudut" class="form-control text-uppercase">
                            @foreach($suduts as $id =>  $sudut)
                                <option value="{{ $id }}"
                                    {{ old('sudut') == $id ? 'selected' : '' }}>
                                    {{ $sudut }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <select id="inputState" name="class" class="form-control text-uppercase">
                            @foreach($classes as $id =>  $class)
                                <option value="{{ $id }}"
                                    {{ old('class') == $id ? 'selected' : '' }}>
                                    {{ $class }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md">
                        <input type="text" name="stock" class="form-control" placeholder="STOCK">
                    </div>
                    <div class="form-group col-md">
                        <input class="form-control" name="empty" type="time" id="datetimepicker">
                    </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <input type="text" name="sch" class="form-control" placeholder="SCHEDULE">
                        </div>
                        <div class="form-group col-md">
                            <input type="text" name="act" class="form-control" placeholder="ACTUAL">
                        </div>
                        <div class="form-group col-md">
                            <input type="text" name="position" class="form-control" placeholder="NUMBER">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Store</button>
                    </form>
                    </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <div class="dropdown-divider"></div>
                            <div class="badge bg-blue badge">
                                <div> Total Schedules</div>
                                <div class="dropdown-divider"></div>
                                <div>{{ $schedules->sum('sch') }} Rolls</div>
                            </div>
                            <div class="badge bg-blue badge">
                                <div> Total SKU</div>
                                <div class="dropdown-divider"></div>
                                <div>{{ $schedules->count('code') }} Sku </div>
                            </div>
                            <div class="badge bg-blue badge">
                                <div> Capacity</div>
                                <div class="dropdown-divider"></div>
                                <div>{{($cuttings->sum('capacity'))}}</div>
                            </div>
                            <div class="badge bg-blue badge">
                                <div>Margin</div>
                                <div class="dropdown-divider"></div>
                                <div>{{ $schedules->sum('sch')-($cuttings->sum('capacity'))}} Rolls</div>
                            </div>
                            <div class="dropdown-divider"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Detail Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!--FORM EDIT-->
                <form method="POST" enctype="multipart/form-data"
                    action="{{ route('schedule.update') }}">

                    @csrf
                    <div class="card-body">
                        @include('schedules.edit')
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- ============================================================================================================ --}}
{{-- CARD DETAIL SCHEDULE BY MACHINE --}}
<div class="container">
    <div class="row">
        @foreach($cuttings as $cutting)
            <div class="col-md-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h2 class="card-title"><b>{{ $cutting->mesin }}</b></h2>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                <div class="card-body">               
                        @foreach($cutting->schedules->sortBy('empty') as $schedule)
                        
                        
                            <ul class="list-group" id="sid{{$schedule->id}}">
                                <li data-toggle="modal" data-target="#edit"
                                    data-mid=" {{ $schedule->id ?? '' }}"
                                    data-mcode=" {{ $schedule->code ?? '' }}"
                                    data-mcutting_id=" {{ $cutting->mesin }}"
                                    data-mtreatment=" {{ $schedule->treatment ?? '' }}"
                                    data-msudut=" {{ $schedule->sudut ?? '' }}"
                                    data-mclass=" {{ $schedule->class ?? '' }}"
                                    data-mstock=" {{ $schedule->stock ?? '' }}"
                                    data-mempty=" {{ $schedule->empty ?? '' }}"
                                    data-msch=" {{ $schedule->sch ?? '' }}"
                                    data-mact=" {{ $schedule->act ?? '' }}"
                                    data-mposition=" {{ $schedule->position ?? '' }}"
                                    class="list-group-item list-group-item-action">
                                    <div class="badge bg-black badge">
                                        {{ $schedule->code ?? '' }}
                                        <div class="dropdown-divider"></div>
                                        <a>{{ $schedule->empty ?? '' }}</a>
                                    </div>
                                    <div class="badge bg-black badge">STK :
                                        {{ $schedule->stock ?? '' }}
                                        <div class="dropdown-divider"></div>
                                        <div>SCH : {{ $schedule->sch ?? '' }}</div>
                                    </div>
                                    <div class="badge bg-black badge">
                                        {{ $schedule->treatment ?? '' }}
                                        <div class="dropdown-divider"></div>
                                        <div>{{ $schedule->sudut ?? '' }}</div>
                                    </div>
                                    <span>
                                        @if($schedule->class == 'A')
                                            <div class="badge badge-primary badge">
                                                {{ $schedule->class ?? '' }}</div>
                                            
                                            
                                                @elseif($schedule->class == 'B')
                                            <div class="badge bg-green badge">
                                                {{ $schedule->class ?? '' }}</div>

                                           
                                                @elseif($schedule->class == 'C')
                                            <div class="badge bg-orange badge">
                                                {{ $schedule->class ?? '' }}</div>

                                            
                                                @elseif($schedule->class == 'NC')
                                            <div class="badge bg-yellow badge">
                                                {{ $schedule->class ?? '' }}</div>

                                            
                                                @elseif($schedule->class == 'BO')
                                            <div class="badge bg-red badge">
                                                {{ $schedule->class ?? '' }}</div>
                                                @endif
                                    </span>
                                    
                                </li>
                            </ul>
                           
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                    
                    <div class="card-footer">
                   
                    <b>Total : {{ $cutting->schedules->sum('sch') }} Rolls</b>
                    
                    </div>
                   
                   
                  
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>
        @endforeach
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var machine = <?php echo $machine; ?>;
    var dataSch = <?php echo $dataSch; ?>;
   
    var barChartData = {
        labels: machine,
        datasets: [{
            label: 'Schedule',
            backgroundColor: '#2093C3',
            data: dataSch
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 1,
                        borderColor: '#2093C3',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Total Schedules'
                }
            }
        });
    };
</script>
@endsection


