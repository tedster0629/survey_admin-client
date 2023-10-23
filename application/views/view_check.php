<div class="container">
    <div class = "box" style = "padding : 30px">
        <form  method = "POST" action = "<?php echo base_url();?>check/testpassword?id=<?php echo $id = $this->input->get('id');?>">
            <p>You need a password to access this survey</p>
            <input class = "form-control mb-3" type="text" name="password" /><input class = "btn btn-primary" type="submit" name="submit" value="Validate" />
        </form>
    </div>
</div>