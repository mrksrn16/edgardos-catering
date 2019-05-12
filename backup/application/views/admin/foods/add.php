<div class="container">
      <h3>Add Food</h3>
      <a href="<?php echo base_url();?>admin/foods" style="margin-bottom: 10px;display: block;"><button class="btn btn-default">Back</button></a>
      <?php $attr = array('class' => 'form-horizontal');?>
      <?php echo form_open_multipart('', $attr);?>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Name" name="name" required="">
            </div>
          </div>
         <div class="form-group">
          <label for="" class="col-sm-2 control-label">Price</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="" placeholder="Price" name="price" required="">
          </div>
        </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Description" name="description" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-10">
              <select class="form-control" name="category" required="">
                <option value="Pork">Pork</option>
                <option value="Fish">Fish</option>
                <option value="Chicken">Chicken</option>
                <option value="Pasta">Pasta</option>
                <option value="Beef">Beef</option>
                <option value="Drinks">Drinks</option>
                <option value="Dessert">Dessert</option>
              </select>
            </div>
          </div>
           <div class="form-group">
            <label for="" class="col-sm-2 control-label">Image:</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="" name="picture" required="">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="reset" class="btn btn-default">Clear</button>
              <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </div>
          </div>
        </form>
    </div>