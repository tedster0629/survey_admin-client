<div class="rowelement">
    <div class="col-3">
       Matrix Rows:
    </div>
    <div class="col-5">
    	<textarea id="answer_box" rows="6" name="matrix_rows" class="form-control"><?php echo $answers['rows']; ?></textarea>
        <p class="help-block">Hint: These are options for the rows. Use comma and space separation format.</p>
    </div>
</div>
<div class="rowelement">
    <div class="col-3">
       Matrix Headers:
    </div>
    <div class="col-5">
    	<textarea id="answer_box" rows="6" name="matrix_headers" class="form-control"><?php echo $answers['headers']; ?></textarea>
        <p class="help-block">Hint: These are options for the columns. Use comma and space separation format.</p>
    </div>
</div>
<div class="separator"></div>
<div class="rowelement">
    <div class="col-3">
       CSS Class:
    </div>
    <div class="col-5">
        <input type="text" id="css_class" name="css_class" class="form-control" value="<?php echo $css_class; ?>" />
    </div>
    <div class="col-12 separate">&nbsp;</div>
    <div class="col-3">
       Position:
    </div>
    <div class="col-5">
       <select name="position" id="position" class="form-select">
       		<?php if($position == 'vertical') { ?>
            <option value="vertical" selected>Vertical</option>
            <option value="horizontal">Horizontal</option>
            <?php } else { ?>
       		<option value="vertical">Vertical</option>
            <option value="horizontal" selected>Horizontal</option>
            <?php } ?>
       </select>
       <p class="help-block">Hint: These configurations depend on the current theme.</p>
    </div>
</div>
<div class="form-actions">
    <div class="float-end">
        <button type="submit" name="update-answers" data-option="update-answers" class="btn btn-primary">Save Changes</button>
    </div>
</div>