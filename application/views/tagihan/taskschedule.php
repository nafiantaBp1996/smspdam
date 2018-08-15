<!-- page content -->
        <div class="right_col" role="main">
          <h2>Proses Hari Ini : <?php echo date('d-m-Y'); ?></h2>
          <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i style="color: #5864bc" class="fa fa-caret-square-o-right"></i></div>
                  <div style="color: #5864bc" class="count"><?php echo $report[0]->total ?></div>
                  <h3>Total Dikirim</h3>
                  <p>Dikirim pada tanggal <?php echo date('d-m-Y'); ?></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i style="color: #33a563" class=" fa fa-check-square-o"></i></div>
                  <div style="color: #33a563" class="count"><?php echo $report[0]->sukses ?></div>
                  <h3>Terkirim</h3>
                  <p>Terkirim pada tanggal <?php echo date('d-m-Y'); ?></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i style="color: #ff0000" class="fa fa-times"></i></div>
                  <div style="color: #ff0000" class="count"><?php echo $report[0]->gagal ?></div>
                  <h3>Gagal</h3>
                  <p>Gagal Dikirim tanggal <?php echo date('d-m-Y'); ?></p>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i style="color: #ffa01c" class="fa fa-warning"></i></div>
                  <div style="color: #ffa01c" class="count "><?php echo $report[0]->nonumber ?></div>
                  <h3>Nomer Tidak Valid</h3>
                  <p>Nomer Tidak Valid tanggal <?php echo date('d-m-Y'); ?></p>
                </div>
              </div>
            </div>  
            <div class="col-md-12">
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