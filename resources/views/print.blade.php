<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
<div class="page-breakr">
                <div class="row">
                    @foreach($cuttings as $cutting)
                        <div class="col-md-6">
                            <div class="card card-info" id="invoice" >
                                <div class="card-header">
                                    <h2 class="card-title"><b>{{ $cutting->mesin }}</b></h2>
                                </div>
                <div class="card-body">               
                        <table class="table table-sm text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Code</th>
                                    <th scope="col">Treatment</th>
                                    <th scope="col">Angle</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Est. Empty</th>
                                    <th scope="col">Sch</th>
                                    <th scope="col">Act</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cutting->schedules->sortBy('empty') as $schedule)
                                <tr>
                                    <td>{{$schedule->code}}</td>
                                    <td>{{$schedule->treatment}}</td>
                                    <td>{{$schedule->sudut}}</td>
                                    <td>
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
                                                {{ $schedule->class ?? '' }}
                                            </div>
                                                @endif
                                    
                                    </td>
                                    <td>{{$schedule->stock}}</td>
                                    <td>{{$schedule->empty}}</td>
                                    <td>{{$schedule->sch}}</td>
                                    <td>{{$schedule->act}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                           
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                   
                    <span><b>Total Sch: {{ $cutting->schedules->sum('sch') }} Rolls</b></span>
                    
                    <span><b>Total SKU: {{ $cutting->schedules->count('code') }} SKU</b></span>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        @endforeach
    </div>
</body>
</html>

  
