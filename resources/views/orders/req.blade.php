@extends('adminlte::page')
@section('content')
<!--delete -->
<div class="modal fade" id="deleteOrder" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body w-100 text-center ">
                <form method="DELETE" enctype="multipart/form-data"
                    action="{{ route('order.destroy') }}">
                    @csrf
                    <div class="badge bg-red badge text-center">Apakah anda akan menghapus data ?</div>
                    <div class="dropdown-divider"></div>
                    <div>Sebelum Menghapus Data Orderan Yang Telah Terbuat,Pastikan Data Order Sudah Dipindahkan ke Storage Area</div>
                    <input type="hidden" name="id" id="id" value="">
                    <div class="dropdown-divider"></div>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">No, Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--delete -->
<!--store to storage-->
<div class="modal fade" id="storeOrder" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title w-100 text-center " id="exampleModalLabel">Move Order</h5>
            </div>
            <div class="modal-body ">
                <form method="POST" enctype="multipart/form-data"
                    action="{{ route('product.store') }}">
                    @csrf
                    @include('orders.store')
                    <div class="dropdown-divider"></div>
                    <button type="submit" class="btn btn-primary">Yes, Move Order</button>
                    <button type="button"  data-dismiss="modal" class="btn btn-danger">No, Cancel Move Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--store to storage-->
<div class="dropdown-divider"></div>
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title"><b>Finished Order List</b></h3>
    </div>
    <div class="card-body">
        <div class="dropdown-divider"></div>
        <table class="table table-sm text-center">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Item Code</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Building</th>
                    <th scope="col">Operator</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            @foreach($dataOrder as $row)
                    <tbody>
                        <tr class="table-row"  data-did=" {{ $row->id ?? '' }}">
                            <td>{{$row->id}}</td>
                            <td>{{$row->item_code}}</td>
                            <td>{{$row->qty}}</td>
                            <td>{{$row->machine_bld}}</td>
                            <td>{{$row->oprt}}</td>
                            <td><button type="submit"data-toggle="modal" 
                            data-did=" {{ $row->id ?? '' }}"
                            data-ditem_code="{{ $row->item_code ?? '' }}" 
                            data-dqty=" {{ $row->qty }}"
                            data-doprt=" {{ $row->oprt ?? '' }}"
                            data-target="#storeOrder" 
                            class="btn-xs btn-primary">Move to Storage</button><span>
                            <button type="submit" data-did="{{$row->id}}" data-toggle="modal" data-target="#deleteOrder" class="btn-xs btn-danger">Delete</button></span></td>
                        </tr>
                    </tbody>
            @endforeach
        </table>
    </div>
    <div class="card-footer">
        PT Gajah Tunggal tbk | Dept. Material
    </div>
</div>
</div>
</div>
</div>
@endsection
