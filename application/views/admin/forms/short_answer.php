<div class="rowelement">
    <div class="col-3" style = "margin-bottom : 20px">
        <input type="hidden" id="short_answer" name="short_answer" class="form-control"  value = "short_answer" />
        Short answer
    </div>
    <div class="col-3" style = "margin-bottom : 20px">
        <input type="radio" name="group" id="group" value="number">
        <label for="number">Number :</label>
        <select name="n_rule" id="n_rule">
            <option value="greater_than" id="greater_than" name = "greater_than">Greater than</option>
            <option value="greater_than_or_equal_to" id="greater_than_or_equal_to" name = "greater_than_or_equal_to" >Greater than or equal to</option>
            <option value="less_than" id="less_than" name = "less_than" >Less than</option>
            <option value="less_tahn_or_equal_to" id="less_tahn_or_equal_to" name = "less_tahn_or_equal_to" >Less tahn or equal to</option>
            <option value="equal_to" id="equal_to" name = "equal_to" >Equal to</option>
            <option value="not_equal_to" id="not_equal_to" name = "not_equal_to" >Not equal to</option>
            <option value="between" id="between" name = "between" >Between</option>
            <option value="not_between" id="not_between" name = "not_between" >Not between</option>
            <option value="is_number" id="is_number" name = "is_number" >Is number</option>
            <option value="whole_number" id="whole_number" name = "whole_number" >Whole number</option>
        </select>
        <input  placeholder = "Number" id="val_number" name = "val_number" />
        <input  placeholder = "Custom error text" id="n_err_message" name = "n_err_message" />
    </div>
    <div class="col-3" style = "margin-bottom : 20px">
        <input type="radio" name="group" id="group" value="text" >
        <label for="text">Text : </label>
        <select name="t_rule" id="t_rule">
            <option value="t_contains"  id="t_contains" name = "t_contains" >Contains</option>
            <option value="t_doesnt_contain" id="t_doesnt_contain" name = "t_doesnt_contain" >Doesn't contain</option>
            <option value="email" id="email" name = "email" >Email</option>
            <option value="url" id="url" name = "url" >URL</option>
        </select>
        <input  placeholder = "Text" id="val_text" name = "val_text" />
        <input  placeholder = "Custom error text" id="t_err_message" name = "t_err_message" />
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