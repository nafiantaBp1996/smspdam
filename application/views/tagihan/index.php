<!-- page content -->
<?php 
function rupiah($angka){
  
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
 
    }
 ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              

            </div>

            <div class="clearfix"></div>

            
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Tagihan <small><?php echo $title ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
          
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                       <thead>
                        <tr>
                          <th>NO</th>
                          <th>NOSAMB</th>
                          <th>NAMA</th>
                          <th>NO HP</th>
                          <th>TAGIHAN</th>
                          <th>BULAN TERAKHIR</th>
                          <th>BULAN TERBARU</th>
                          <th>TOTAL</th>
                          <th>Kirim</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($dataPelanggan as $key){ ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $key->nosamb; ?></td>
                          <td><?php echo $key->nama; ?></td>
                          <td><?php echo $key->nohp; ?></td>
                          <td><?php echo $key->lmbr; ?></td>
                          <td><?php echo $key->periodemin; ?></td>
                          <td><?php echo $key->periodemax; ?></td>
                          <td><?php echo rupiah($key->total); ?></td>
                          <td><a href="<?php echo site_url('curlsms/pesan/'.$key->nosamb); ?>" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Peringatan</a></td>
                        </tr>
                      <?php $i++; } ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="<?php echo site_url('curlsms/broadcast') ?>" method="POST" role="form">
                        <button type="submit" name="submit" class=" btn btn-large btn-block btn-warning"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Peringatan Ke Semua List</button>
                        <input type="text" name="status" hidden value="<?php echo $status ?>" >
                    </form>
                    </div>
                </div>
              </div>
            
          </div>
        </div>
        <!-- /page content -->