    <div class="form-row">
        <div class="form-group col-md-3">
            <input type="hidden" name="id" id="id" class="form-control text-uppercase">
            <label>Code</label>
            <input type="text" name="code" id="code" class="form-control text-uppercase">
        </div>
        <div class="form-group col-md">
            <label>Select Machine</label>
            <select id="inputState" name="cutting_id" class="form-control text-uppercase">
                <option selected>Machine</option>
                @foreach($cuttings as $id => $cutting)
                    <option value="{{ $id+1 }}"
                        {{ old('cutting_id') == $id ? 'selected' : '' }}>
                        {{ $cutting->mesin }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Material</label>
            <input type="text" name="treatment" id="material" class="form-control" >
        </div>
        <div class="form-group col-md-3">
            <label>Angle</label>
            <input type="text" name="sudut" id="sudut" class="form-control" >
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label>Class</label>
            <input type="text" name="class" id="class" class="form-control" >
        </div>
        <div class="form-group col-md">
            <label>Stock</label>
            <input type="text" name="stock" id="stock" class="form-control" >
        </div>
        <div class="form-group col-md">
            <label>Est. Empty</label>
            <input class="form-control" name="empty" type="text" data-provide="timepicker" id="datetimepicker" >
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md">
            <label>Schedule</label>
            <input type="text" name="sch" id="sch" class="form-control" >
        </div>
        <div class="form-group col-md">
            <label>Actual</label>
            <input type="text" name="act" id="act" class="form-control" >
        </div>
        <div class="form-group col-md">
            <label>Number</label>
            <input type="text" name="position" id="position" class="form-control" >
        </div>
    </div>
