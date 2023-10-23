<div class="rowelement">
    <div class="col-3">
    <input type="hidden" id="date" name="date" class="form-control" value = "date" />
       Date update
    </div>
    
</div>
<div class="separator"></div>
<div class="rowelement">
    <div class="col-3">
       CSS Class:
    </div>
    <div class="col-5">
        <input type="text" id="css_class" name="css_class" class="form-control" value="<?php echo $css_class; ?> />
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
        <button type="submit" name="update-answers" data-option="update-answers" class="btn btn-primary">Add Answer</button>
    </div>
</div>