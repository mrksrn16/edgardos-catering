<div class="container">
      <h3>Edit Team - <b><?php echo $team->name;?></b></h3>
      <a href="<?php echo base_url();?>admin/teams" style="margin-bottom: 10px;display: block;"><button class="btn btn-default">Back</button></a>
      <?php $attr = array('class' => 'form-horizontal');?>
      <?php echo form_open_multipart('', $attr);?>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="" placeholder="Name" name="name" required="" value="<?php echo $team->name;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="col-sm-2 control-label">Members</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="members" required="" placeholder="Members" style="min-height: 200px;"><?php echo strip_tags($team->members);?></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" name="submit" class="btn btn-primary" value="Update">
            </div>
          </div>
        </form>
    </div>