@extends('adminlte::page')
@section('content')
<div class="container">
    <div class="row">
    @foreach($cuttings as $cutting)
        <div class="col-6 col-md-4">
        
            <div class="card card-info" >

                <div class="card-header">
                <h3 class="card-title">{{$cutting->mesin}}</h3>
            </div>
            
  
             
    <div class="card-body">
    
    <ul class="list-group">
        <li class="list-group-item">{{$cutting->capacity}}</li>
        
    </ul>
     
    </div>
    

    
  
  <!-- /.card-body -->
  <div class="card-footer">
    The footer of the card
  </div>
  <!-- /.card-footer -->
</div>
<!-- /.card -->

        </div>
        @endforeach
    </div>
</div>

@endsection