@extends('adminlte::page')
@section('content')
<!-- Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 22rem;">
        <div class="modal-content">
        <div class="modal-header bg-blue">
                <h5 class="modal-title" id="exampleModalLabel">Detail Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center">
            <form method="POST" enctype="multipart/form-data"
                    action="{{ route('product.update') }}">
                    @csrf
                    <div class="card-body">
                        @include('products.edit')
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    
            </form>
            </div>
        </div>
    </div>
</div>
{{-- ============================================================================================================ --}}
<div class="container">
    <div class="row">
        @foreach($storages->sortBy('id') as $storage)
            <div class="col-6 col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <b>
                            <h3 class="card-title"><i class="fas fa-tags"></i>{{ $storage->location }}</h3>
                        </b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                    
                        <table class="table table-sm text-center table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Code</th>
                                        <th scope="col">Barcode</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Operator</th>
                                    </tr>
                                </thead>
                                @foreach($storage->products->sortBy('item_code') as $product)
                                <tbody id="bid{{$product->id}}">
                                    <tr class="table-row" id="editProduct" data-toggle="modal" data-target="#editProduct" 
                                        data-nid=" {{ $product->id ?? '' }}"
                                        data-nitem_code=" {{ $product->item_code ?? '' }}"
                                        data-nbarcode=" {{ $product->barcode }}"
                                        data-nqty=" {{ $product->qty ?? '' }}"
                                        data-nstorage_id=" {{ $product->storage_id ?? '' }}"
                                        data-noperator=" {{ $product->operator ?? '' }}">
                                        <td>{{$product->item_code}}</td>
                                        <td>{{$product->barcode}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$product->operator}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                        </table>
                    </div>
                    <div class="card-footer">
                    <span><b>Total Stock: {{ $storage->products->count('storage_id') }} Rolls</b></span>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
        @endforeach
    </div>
</div>
@endsection

