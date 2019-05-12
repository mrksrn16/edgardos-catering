<div class="container">
      <h3>Edit Food - <b><?php echo $food->name;?></b></h3>
      <a href="<?php echo base_url();?>admin/foods" style="margin-bottom: 10px;display: block;"><button class="btn btn-default">Back</button></a>
      <?php $attr = array('class' => 'form-horizontal');?>
      <?php echo form_open_multipart('', $attr);?>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Name" name="name" required="" value="<?php echo $food->name;?>">
            </div>
          </div>
          <div class="form-group">
          <label for="" class="col-sm-2 control-label">Price</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="" placeholder="Price" name="price" required="" value="<?php echo $food->price;?>">
          </div>
        </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Description" name="description" value="<?php echo $food->description;?>" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10">
              <select class="form-control" name="category" required="">

                <option value="Pork" <?php if($food->category == 'Pork'){ echo 'selected'; }?>>Pork</option>
                <option value="Fish" <?php if($food->category == 'Fish'){ echo 'selected'; }?>>Fish</option>
                <option value="Chicken" <?php if($food->category == 'Chicken'){ echo 'selected'; }?>>Chicken</option>
                <option value="Pasta" <?php if($food->category == 'Pasta'){ echo 'selected'; }?>>Pasta</option>
                <option value="Beef" <?php if($food->category == 'Beef'){ echo 'selected'; }?>>Beef</option>
                <option value="Drinks" <?php if($food->category == 'Drinks'){ echo 'selected'; }?>>Drinks</option>
                <option value="Dessert" <?php if($food->category == 'Dessert'){ echo 'selected'; }?>>Dessert</option>

              </select>
            </div>
          </div>
           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Image:</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="" name="picture">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="submit" class="btn btn-primary" value="Update">
            </div>
          </div>
        </form>
    </div>