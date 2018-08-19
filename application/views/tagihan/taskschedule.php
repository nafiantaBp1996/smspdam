<!-- page content -->
        <div class="right_col" role="main">
          <h2>Proses Hari Ini : <?php echo date('d-m-Y'); ?></h2>
          <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo site_url('report/reportdrd/2') ?>">
                  <div class="tile-stats">
                  <div class="icon"><i style="color: #5864bc" class="fa fa-caret-square-o-right"></i></div>
                  <div style="color: #5864bc" class="count"><?php echo $report[0]->total ?></div>
                  <h3>Total Dikirim</h3>
                  <p>Dikirim pada tanggal <?php echo date('d-m-Y'); ?></p>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo site_url('report/reportdrd/2') ?>">
                <div class="tile-stats">
                  <div class="icon"><i style="color: #33a563" class=" fa fa-check-square-o"></i></div>
                  <div style="color: #33a563" class="count"><?php echo $report[0]->sukses ?></div>
                  <h3>Terkirim</h3>
                  <p>Terkirim pada tanggal <?php echo date('d-m-Y'); ?></p>
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo site_url('report/reportdrd/3') ?>">
                <div class="tile-stats">
                  <div class="icon"><i style="color: #ff0000" class="fa fa-times"></i></div>
                  <div style="color: #ff0000" class="count"><?php echo $report[0]->gagal ?></div>
                  <h3>Gagal</h3>
                  <p>Gagal Dikirim tanggal <?php echo date('d-m-Y'); ?></p>
                </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?php echo site_url('report/reportdrd/4') ?>">
                <div class="tile-stats">
                  <div class="icon"><i style="color: #ffa01c" class="fa fa-warning"></i></div>
                  <div style="color: #ffa01c" class="count "><?php echo $report[0]->nonumber ?></div>
                  <h3>Nomer Tidak Valid</h3>
                  <p>Nomer Tidak Valid tanggal <?php echo date('d-m-Y'); ?></p>
                </div>
                </a>
              </div>
            </div>
            <div class="row">
              <!-- bar chart -->
              <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Pengiriman Pesan <small><?php echo date('Y'); ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="line-exampl" style="width:100%; height:280px;"></div>
                  </div>
                </div>
              </div>  
            <div class="col-md-4">
                    <?php if ($this->uri->segment(2)=='start') { ?>
                      <a href="<?php echo site_url('chek_drd/stop') ?>" class="btn btn-app btn-block " style="height:360px;font-size: 30px;text-align: center;padding-top:15%;"><i class="fa fa-stop" style="font-size: 200px;color: red;"></i>STOP DRD CHECKER</a>
                    <?php } else
                    { ?>
                     <a href="<?php echo site_url('chek_drd/start') ?>" class="btn btn-app btn-block" style="height:360px;font-size: 30px;text-align: center;padding-top:15%;"><i class="fa fa-play" style="font-size: 200px;color: green;"></i>START DRD CHECKER</a>
                    <?php }?>
              </div>


            </div>
          </div>

    <script src="<?php echo base_url(); ?>/assets/vendors/jquery/dist/jquery.min.js"></script>
    <!-- morris.js -->
    <script src="<?php echo base_url(); ?>/assets/vendors/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendors/morris.js/morris.min.js"></script>
    <script>
    Morris.Bar({
      element: 'line-exampl',
      data: [<?php echo $chart; ?>],
      xkey: 'tahun',
      ykeys: ['sukses', 'nonumb','gagal'],
      labels: ['Sukses', 'Tidak Valid','Gagal'],
      hideHover:'false',
      barColors:['#008e04','#ea9809','#d11f08']
    });        
    </script>