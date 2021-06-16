@extends('adminlte::page')

@section('title', 'Create Group')

@section('content_header')
    <h1>Shedule</h1>
@stop
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-4">

            <ul class="sort_menu list-group">
                @foreach ($data as $row)
                <li class="list-group-item" data-id="{{$row->id}}">
                    <span class="handle fas fa-fw fa-barcode"></span> {{$row->oprt_group}}</li>
                @endforeach
            </ul>

        </div>
    </div>
</div>




<style>
    .list-group-item {
        display: flex;
        align-items: center;
    }

    .highlight {
        background: #f7e7d3;
        min-height: 30px;
        list-style-type: none;
    }

    .handle {
        min-width: 18px;
        background: #FFFFFF;
        height: 15px;
        display: inline-block;
        cursor: move;
        margin-right: 10px;
    }
</style>

<script>
    $(document).ready(function(){

    	function updateToDatabase(idString){
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
	
    	   $.ajax({
              url:'{{url('groups/update-order')}}',
              methode:'POST',
              data:{ids:idString},
           })
           
    	}

        var target = $('.sort_menu');
        target.sortable({
            connectWith: '.connectedSortable',
            handle: '.handle',
            placeholder: 'highlight',
            
            update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'})
               updateToDatabase(sortData.join(','))
            }
        })
        
    })
</script>


@endsection

@section('js')
<script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
@show