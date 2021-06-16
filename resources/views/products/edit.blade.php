<div class="card" style="width: 20rem;">
  <div class="card-body">
  <input type="hidden" name="id" id="id" class="form-control text-uppercase">
  <input type="hidden" name="item_code" id="item_code" class="form-control text-uppercase">
  <img class="card-img-top" src="/img/barcode.png" alt="Card image cap">
  <div class="dropdown-divider"></div>
  <input type="text" name="barcode" id="barcode" class="form-control text-uppercase text-center">
  <div class="dropdown-divider"></div>
  <input type="hidden" name="qty" id="qty" class="form-control text-uppercase text-center">
  <div class="form-group col-md">
            <label>Select Location</label>
            <select id="inputState" name="storage_id" class="form-control text-uppercase">
                <option selected>Location</option>
                @foreach($storages as $id => $storage)
                    <option value="{{ $id+1 }}"
                        {{ old('storage_id') == $id ? 'selected' : '' }}>
                        {{ $storage->location }}</option>
                @endforeach
            </select>
        </div>
  <input type="hidden" name="operator" id="operator" class="form-control text-uppercase text-center">
  
</div>
</div>
