@extends('adminlte::page')
@section('content')
<!-- Modal -->
<div class="modal fade" id="editOrder" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title w-100 text-center " id="exampleModalLabel">Edit Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <form method="POST" enctype="multipart/form-data"
                    action="{{ route('order.update') }}">
                    @csrf
                    @include('orders.edit')
                    <div class="dropdown-divider"></div>
                    <button type="submit" class="btn btn-secondary">Edit Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('order.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text" name="item_code" id="item_code" class="form-control"
                                    placeholder="Code Steel">
                            </div>
                            <div class="form-group col-md">
                                <input type="text" name="qty" class="form-control" id="qty" placeholder="Qty">
                            </div>
                            <div class="form-group col-md">
                                <input class="form-control" name="created_at" type="datetime-local" id="datetimepicker">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <input type="text" name="machine_bld" class="form-control" placeholder="Building">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="oprt" class="form-control" placeholder="Operator">
                            </div>
                            <input type="hidden" name="id" id="id" class="form-control text-uppercase">
                            <input type="hidden" name="flag" id="flag" value="1" class="form-control text-uppercase">
                            <input type="hidden" name="note" id="flag" value="Menunggu Status Berikutnya" class="form-control text-uppercase">
                            <div class="form-row">
                                <div class="form-group col-md">
                                    <select id="inputState" name="kanban_id" class="form-control text-uppercase">
                                        @foreach($kanbans as $id => $kanban)
                                            <option value="{{ $id+1 }}"
                                                {{ old('kanban_id') == $id ? 'selected' : '' }}>
                                                {{ $kanban->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <button type="submit" class="btn btn-primary">Save Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @foreach($kanbans as $knbn)
            <div class="col-md-2">
                @if($knbn->id == '1')
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <b>{{ $knbn->status }} :</b><span>
                                <h3>{{ $knbn->orders->sum('flag') }}</h3>
                            </span>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                @elseif($knbn->id == '2')
                    <div class="small-box bg-info">
                        <div class="inner">
                            <b>{{ $knbn->status }} :</b><span>
                                <h3>{{ $knbn->orders->sum('flag') }}</h3>
                            </span>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-flag"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                @elseif($knbn->id == '3')
                    <div class="small-box bg-success">
                        <div class="inner">
                            <b>{{ $knbn->status }} :</b><span>
                                <h3>{{ $knbn->orders->sum('flag') }}</h3>
                            </span>
                            <div class="dropdown-divider"></div>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="/orders/req" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                @endif
            </div>

        @endforeach
        <div class="container">
            <div class="row">
                @foreach($kanbans as $knbn)
                    <div class="col-6 col-md-4">
                        <div class="dropdown-divider"></div>
                        @if($knbn->id == '1')
                            <div class="card card-danger">
                            @elseif($knbn->id == '2')
                                <div class="card card-primary">
                                @elseif($knbn->id == '3')
                                    <div class="card card-success">
                        @endif
                        <div class="card-header">
                            <h3 class="card-title"><b>{{ $knbn->status }}</b></h3>
                        </div>
                        <div class="card-body">
                            @foreach($knbn->orders->sortBy('id') as $order)
                                <ul class="list-group" id="sid{{$order->id}}">
                                <li data-toggle="modal" data-target="#editOrder"
                                    data-did=" {{ $order->id ?? '' }}"
                                    data-ditem_code=" {{ $order->item_code ?? '' }}"
                                    data-dqty=" {{ $order->qty }}"
                                    data-dmachine_bld=" {{ $order->machine_bld ?? '' }}"
                                    data-doprt=" {{ $order->oprt ?? '' }}"
                                    data-dkanban_id=" {{ $knbn->status ?? '' }}"
                                    data-dflag=" {{ $order->flag ?? '' }}"
                                    data-dnote=" {{ $order->note ?? '' }}"
                                    data-dcreated_at=" {{ $order->created_at ?? '' }}"
                                    class="list-group-item list-group-item-action">
                                        @if($order->kanban_id == '1')
                                            <div class="card bg-danger">
                                                <blade
                                                    @elseif($order->kanban_id == '2')
                                                <div class="card bg-info">
                                                    <blade
                                                        @elseif($order->kanban_id == '3')
                                                    <div class="card bg-success">
                                        @endif
                                        <div>
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h5 class="card-title"><img src="/img/man.png" alt="">
                                                    | {{ $order->oprt ?? '' }}
                                                </h5>
                                                <style>
                                                    img {

                                                        vertical-align: center;
                                                        width: 25px;
                                                        height: 25px;
                                                        border-radius: 50%;
                                                    }
                                                </style>
                                                <b><span id="race<?php echo $order['id'];?>"></span></b>
                                                <img src="/img/watch.gif" alt="">
                                            </div>
                                            <div class="card-body">
                                            <span>| <i class="fa fa-tag" aria-hidden="true"></i><span>
                                            {{ $order->note }}
                                                <div class="dropdown-divider"></div>
                                                <span>| <i class="fa fa-barcode" aria-hidden="true"></i><span>
                                                        {{ $order->item_code }} |
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        <span>{{ $order->qty ?? '' }}
                                                            | <i class="fa fa-cog" aria-hidden="true"></i>
                                                            <span>{{ $order->machine_bld ?? '' }}
                                                                | <i class="fa fa-exclamation-triangle"
                                                                    aria-hidden="true"></i></span>
                                                            <div class="dropdown-divider"></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                        @endforeach
                                        </div>
                                        <div class="card-footer">
                            PT Gajah Tunggal tbk | Dept. Material
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
var countdowns = [
<?php foreach ($orders as $order) {?>
  {
    id : <?php echo $order['id'];?>,
            date: new Date("<?php echo date('M j, Y H:i:s', strtotime($order->created_at));?>").getTime()
  },
<?php }?>
];
// Update the count down every 1 second
var timer = setInterval(function() {
// Get todays date and time
var now = Date.now();
var index = countdowns.length - 1;
// we have to loop backwards since we will be removing
// countdowns when they are finished
while(index >= 0) {
var countdown = countdowns[index];
// Find the distance between now and the count down date
var distance = countdown.date - now;
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
var timerElement = document.getElementById("race" + countdown.id);
    // If the count down is over, write some text 
    if (distance < 0) {
      timerElement.innerHTML =  "<h6 class='badge bg-red badge'> SHORTAGE </h6>";
      //timerElement.className = "badge badge-warning";
      // this timer is done, remove it
      countdowns.splice(index, 1);
    } else {
      timerElement.innerHTML =  hours + ":" + minutes + ": " + seconds + ""; 
    }
    index -= 1;
  }
  // if all countdowns have finished, stop timer
  if (countdowns.length < 1) {
    clearInterval(timer);
  }
}, 1000);
</script>
<style>
    .list-group {
        cursor: pointer;
    }
</style>

@endsection