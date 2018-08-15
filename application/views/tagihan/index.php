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
            <div class="title_left">
              </div>
            <div class="pull-right">
              <?php if ($this->uri->segment(2)=='lancar')
              {
                echo form_open('tagihan/lancar');
              } else 
              {
                echo form_open('tagihan/tidaklancar');
              } ?>
                      <div class="form-group col-xs-4">
                        <label for="inputsm">Batas Awal</label>
                        <input class="form-control input-sm" id="awal" name="awal" type="numbers" required placeholder="Batas Awal" value="<?php echo $awal; ?>">
                      </div>
                      <div class="form-group col-xs-4">
                        <label for="inputsm">Akhir</label>
                        <input class="form-control input-sm" id="akhir" name="akhir" type="numbers" required placeholder="Batas Akhir" value="<?php echo $akhir; ?>">
                      </div>
                      <div class="form-group col-xs-3" >
                        <label for="inputsm"></label>
                        <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Load</button>
                      </div>
              <?php echo form_close(); ?>
                      
            </div>

            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Tagihan <small><?php echo $title ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
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
                    <form id="myForm" action="<?php echo site_url('curlsms/broadcast') ?>" method="POST">
                        <input type="text" name="status" value="<?php echo $status ?>" hidden>
                         <input type="text" hidden="" id="awal" name="awal" value="<?php echo $awal; ?>" >
                        <input type="text"  hidden="" id="akhir" name="akhir" value="<?php echo $akhir; ?>" >
                        <a onclick="alertt()" value="Submit form" class="btn btn-block btn-warning">Kirim Pesan Ke Customer</a>
                    </form>
                    </div>
                </div>
              </div>
            
          </div>
        </div>
        <script type="text/javascript">
          function alertt() {
            swal({
            title: "Anda Yakin Mengirim Pesan?",
            text: "Anda Tidak bisa membatalkan aksi ini",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#94e881',
            confirmButtonText: 'Kirim',
            cancelButtonText: "Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: false
         },
         function(isConfirm){

           if (isConfirm)
             {
                  swal("Terkirim", "Pesan Terkirim", "success");
                  myFunction();
            }
           else
             {
                swal("Tidak Terkirim", "Maaf Pesan Tdak terkirim Cek No Hp", "error");
             }
          });
        };

         function myFunction() {
                    document.getElementById("myForm").submit();
                }
        </script>
        <!-- /page content -->