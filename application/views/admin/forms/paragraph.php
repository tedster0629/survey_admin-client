<div class="rowelement">
    <div class="col-3">
    <input type="hidden" id="paragraph" name="paragraph" class="form-control"   value = "paragraph" />
       Paragraph
    </div>
    <div class="col-3" style = "margin-bottom : 20px">
        <input type="radio" name="group" id="group" value="length" >
        <label for="length">Length :</label>
        <select name="l_rule" id="l_rule">
            <option value="maximum_character_count"  id="maximum_character_count" name = "maximum_character_count" >Maximum character count</option>
            <option value="minimum_character_count" id="minimum_character_count" name = "minimum_character_count" >Minimum character count</option>
        </select>
        <input  placeholder = "Number" id="val_l_number" name = "val_l_number" />
        <input  placeholder = "Custom error text" id="l_err_message" name = "l_err_message" />
    </div>
    <div class="col-3" style = "margin-bottom : 20px">
        <input type="radio" name="group" id="group" value="regular_expression" >
        <label for="regular_expression">Regular expression :</label>
        <select name="r_rule" id="r_rule">
            <option value="r_contains"  id="r_contains" name = "r_contains" >Contains</option>
            <option value="r_doesnt_contain" id="r_doesnt_contain" name = "r_doesnt_contain" >Doesn't contain</option>
            <option value="matches" id="matches" name = "matches" >Matches</option>
            <option value="doesnt_match" id="doesnt_match" name = "doesnt_match" >Doesn't match</option></select>
        <input  placeholder = "Pattern" id="pattern" name = "pattern" />
        <input  placeholder = "Custom error text" id="r_err_message" name = "r_err_message" />
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