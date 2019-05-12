<section class="slides">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="<?php echo base_url();?>assets/images/slides/slide-1.png" alt="">
          <div class="carousel-caption">
            
          </div>
        </div>
        <div class="item">
          <img src="<?php echo base_url();?>assets/images/slides/slide-2.jpg" alt="">
          <div class="carousel-caption">
            
          </div>
        </div>
        <div class="item">
          <img src="<?php echo base_url();?>assets/images/slides/slide-3.jpg" alt="">
          <div class="carousel-caption">
            
          </div>
        </div>
        
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </section>

    <section class="services">
      <div class="container">
        <h3 class="custom-heading"><span>Events</span></h3>

        <?php if(count($services)):?>
          <?php foreach($services as $service):?>
            <div class="col-sm-4">
              <div class="card card-1">
                <div class="card-image">
                  <a href="<?php echo base_url();?>services/view/<?php echo $service->id;?>">
                    <img src="<?php echo base_url();?>uploads/services/<?php echo $service->image;?>">
                  </a>
                </div>
                <div class="card-details">
                  <p class="card-title"><?php echo $service->name;?></p>
                  <p class="card-description">
                    <?php echo $service->description;?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach;?>
        <?php else:?>
          <p class="no-content">No events found.</p>
        <?php endif;?>
        <div class="row"></div>
        <h3 class="custom-heading"><span>Occasion Motifs</span></h3>

        <?php if(count($motifs)):?>
          <?php foreach($motifs as $motif):?>
            <div class="col-sm-4">
              <div class="card card-1">
                <div class="card-image">
                  <a href="<?php echo base_url();?>uploads/motifs/<?php echo $motif->image;?>" target="_blank">
                    <img src="<?php echo base_url();?>uploads/motifs/<?php echo $motif->image;?>">
                  </a>
                </div>
                <div class="card-details">
                  <p class="card-title"><?php echo $motif->name;?></p>
                  <p class="card-description">
                    <?php echo $motif->description;?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach;?>
        <?php else:?>
          <p class="no-content">No events found.</p>
        <?php endif;?>

      </div>
    </section>