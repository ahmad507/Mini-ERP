<div class="form-row">
    <!--hidden inpput manipulation-->
    <input type="hidden" name="id" id="id" class="form-control text-uppercase">
    <input type="hidden" name="flag" id="flag" class="form-control text-uppercase">
    <!--hidden inpput manipulation-->
    <div class="form-group col-md-4">
        <input type="text" name="item_code" id="item_code" class="form-control" placeholder="Code Steel">
    </div>
    <div class="form-group col-md-3">
        <input type="text" name="qty" id="qty" class="form-control" placeholder="Qty">
    </div>
    <div class="form-group col-md">
        <input class="form-control" name="created_at" type="text" data-provide="timepicker" id="datetimepicker">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md">
        <input type="text" name="machine_bld" id="machine_bld" class="form-control" placeholder="Building">
    </div>
    <div class="form-group col-md">
        <input type="text" name="oprt" id="oprt" class="form-control" placeholder="Operator">
    </div>
    <div class="form-group col-md">
        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
    </div>
</div>
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
