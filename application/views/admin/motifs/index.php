<div class="container">
  <h3>Occasion Motif</h3>
  <a href="<?php echo base_url();?>admin/motifs/add"><button class="btn btn-primary">Add new</button></a>
  <div class="input-group pull-right col-xs-4">
    <?php $attr = array('class' => 'form-inline');?>
    <?php echo form_open('admin/motifs/search', $attr);?>
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" id="" placeholder="Search Occasion Motif" name="keyword">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>
  <table class="table table-striped" style="margin-top: 10px;">
    <tr>
      <th>Name</th>
      <th>Description</th>
      <th></th>
    </tr>
    <?php if(count($motifs)):?>
    <?php foreach($motifs as $motif):?>
    <tr>
      <td><?php echo $motif->name;?></td>
      <td><?php echo $motif->description;?></td>
      <td>
        <a href="<?php echo base_url();?>admin/motifs/view/<?php echo $motif->id;?>"><button class="btn btn-info btn-xs">View</button></a>
        <a href="<?php echo base_url();?>admin/motifs/edit/<?php echo $motif->id;?>""><button class="btn btn-primary btn-xs">Update</button></a>
        <a href="<?php echo base_url();?>admin/motifs/delete/<?php echo $motif->id;?>" onclick="return confirm('Delete this motif?')"><button class="btn btn-danger btn-xs">Delete</button></a>
      </td>
    </tr>
    <?php endforeach;?>
    <?php else:?>
    <tr>
      <td colspan="3">No motif found.</td>
    </tr>
    <?php endif;?>
  </table>
</div>