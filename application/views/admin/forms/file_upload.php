<div class="rowelement">
    <div class="col-3">
    <input type="hidden" id="file_upload" name="file_upload" class="form-control" value = "file_upload" />
       File upload
    </div>
    <div class="col-3" style = "margin-bottom : 20px">
        <label for="maximum_file_size">Maximum file size</label>
        <select name="rule" id="rule">
            <option value="1048576">1 MB</option>
            <option value="10485760">10 MB</option>
            <option value="104857600">100 MB</option>
            <option value="1048576000">1 GB</option></select>
            <option value="10485760000">10 GB</option>
        </select>
    </div>
    
</div>
<div class="separator"></div>
<div class="rowelement">
    <div class="col-3">
       CSS Class:
    </div>
    <div class="col-5">
        <input type="text" id="css_class" name="css_class" class="form-control" />
    </div>
    <div class="col-12 separate">&nbsp;</div>
    <div class="col-3">
       Position:
    </div>
    <div class="col-5">
       <select name="position" id="position" class="form-select">
       		<option value="vertical">Vertical</option>
            <option value="horizontal">Horizontal</option>
       </select>
       <p class="help-block">Hint: These configurations depend on the current theme.</p>
    </div>
</div>
<div class="form-actions">
    <div class="float-end">
        <button type="submit" name="add-answers" data-option="add-answers" class="btn btn-primary">Add Answer</button>
    </div>
</div>