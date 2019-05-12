<div class="container">
      <h3>Add Packages</h3>
      <a href="<?php echo base_url();?>admin/packages" style="margin-bottom: 10px;display: block;"><button class="btn btn-default">Back</button></a>
      <?php $attr = array('class' => 'form-horizontal');?>
      <?php echo form_open_multipart('', $attr);?>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Name" name="name" required="">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Foods</label>
            <div class="col-sm-10">
              <?php 
                $categories = ['Pork', 'Fish', 'Chicken', 'Pasta', 'Beef', 'Drinks', 'Dessert'];
                foreach($categories as $category):
              ?>
              <div class="col-sm-3">
                <p><b><?php echo $category?></b></p>
                
                <?php 
                $this->db->where('category', $category);
                $res = $this->db->get('foods')->result();
                ?>
                <?php if($res):?>
                  <?php foreach($res as $r):?>
                    <input type="checkbox" name="foods[]" value="<?php echo $r->name?>"> <?php echo $r->name?>
                  <?php endforeach;?>
                <?php else:?>
                  <p>No foods available.</p>
                <?php endif;?>
              </div>
              <?php endforeach;?>
            </div>
          </div>
         <div class="form-group">
          <label for="" class="col-sm-2 control-label">Details</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="details" placeholder="Details" style="height: 200px;"></textarea>
          </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="" placeholder="Price" name="price" required="">
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