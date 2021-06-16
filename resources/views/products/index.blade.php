@extends('adminlte::page')
@section('content')
<div class="dropdown-divider"></div>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><b>Stock Material</b></h3>
    </div>
    <div class="card-body">
        @foreach($storages as $storage)
            @if($storage->location != 'HLM')
                <div class="badge bg-green badge">
                    <div>{{ $storage->location }}</div>
                    <div class="dropdown-divider"></div>
                    <div>{{ ($storage->products->count('code')) }}</div>
                </div>
            @elseif($storage->location == 'HLM')
                <div class="badge bg-red badge">
                    <div>{{ $storage->location }}</div>
                    <div class="dropdown-divider"></div>
                    <div>{{ ($storage->products->count('code')) }}</div>
                </div>
            @endif
        @endforeach
        <div class="dropdown-divider"></div>
        <table class="table table-sm text-center table-hover">
            <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Barcode</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Location</th>
                    <th scope="col">Operator</th>
                </tr>
            </thead>
            @foreach($storages as $storage)
                @foreach($storage->products->sortBy('item_code') as $product)
                    <tbody>
                        <tr class="table-row">
                            <td>{{ $product->item_code }}</td>
                            <td>{{ $product->barcode }}</td>
                            <td>{{ $product->qty }}</td>
                            <td>{{ $storage->location }}</td>
                            <td>{{ $product->operator }}</td>
                        </tr>
                    </tbody>
                @endforeach
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