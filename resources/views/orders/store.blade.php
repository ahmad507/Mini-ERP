<div class="form-row">
    <!--hidden inpput manipulation-->
    <input type="hidden" name="id" id="id" class="form-control text-uppercase">
    <!--hidden inpput manipulation-->
    <div class="form-group col-md-4">
        <input type="text" name="item_code" id="item_code" class="form-control" placeholder="Code Steel">
    </div>
    <div class="form-group col-md-4">
        <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">
    </div>
    <div class="form-group col-md-4">
        <input type="text" name="qty" id="qty" class="form-control text-uppercase" placeholder="Qty">
    </div>
    <div class="form-group col-md-4">
        <input type="text" name="operator" id="operator" class="form-control" placeholder="Operator">
    </div>
    <div class="form-group col-md">
        <select id="inputState" name="storage_id" class="form-control text-uppercase">
            @foreach($location as $id => $location)
                <option value="{{ $id }}"
                    {{ old('storage_id') == $id ? 'selected' : '' }}>
                    {{ $location }}</option>
            @endforeach
        </select>
    </div>
    <div class="dropdown-divider"></div>
</div>