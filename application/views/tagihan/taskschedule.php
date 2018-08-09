<!-- page content -->
        <div class="right_col" role="main">
          <div class="col-md-12">
                  <div class="col-md-12" style="padding-top: 100px">
                    <?php if ($this->uri->segment(2)=='start') { ?>
                      <a href="<?php echo site_url('chek_drd/stop') ?>" class="btn btn-large btn-block btn-danger" style="min-height: 400px;font-size: 84px;text-align: center;padding-top: 140px">HENTIKAN CHEK DRD</a>
                    <?php } else
                    { ?>
                      <a href="<?php echo site_url('chek_drd/start') ?>" class="btn btn-large btn-block btn-success" style="min-height: 400px;font-size: 84px;text-align: center;padding-top: 140px">MULAI CHEK DRD</a>
                    <?php }?>
                    
                </div>
            </div>
          </div>
        <!-- /page content -->