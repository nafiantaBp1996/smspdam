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
            <div>
              <?php echo form_open('tagihan/FilterData'); ?>
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                          <label>
                            <input name="chknosamb" value="checked" type="checkbox" id="cekNosamb" onclick="nosamb()">
                            No Samb
                            <input type="number" id="textNosamb" class="form-control" name="nos" disabled >
                          </label>
                      </div>
                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                          <label>
                            <input name="chktagihan" value="checked" type="checkbox" id="cekTag"  onclick="tagihan()">
                            Tagihan
                            <input type="number" id="textTag" class="form-control" name="tag" disabled placeholder="minimal"><br>
                            <input type="number" id="textTagMax" class="form-control" name="tagmax" disabled placeholder="maximal">
                          </label>
                      </div>

                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">                        
                          <label>
                            <input name="chktotal" type="checkbox" value="checked" id="cekTot" onclick="total()">
                            Total
                            <input type="number" name="totmin" id="textTotmin" class="form-control" disabled placeholder="minimal"><br>
                            <input type="number" name="totmax" id="textTotmax" class="form-control" disabled placeholder="maximal">
                          </label>                       
                      </div>
                      <div class="form-group col-xs-2" >
                        <label for="inputsm"></label>
                        <button type="submit" class="btn btn-default btn-block"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Load</button>
                      </div>
              <?php echo form_close(); ?>
                      
            </div>

            <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Filter Data<small><?php echo $title ?></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                      <legend></legend>
          
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
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form id="myForm" action="<?php echo site_url('curlsms/broadcast') ?>" method="POST">
                        <input type="text" name="status" value="<?php echo $status ?>" >
                         <input type="text"id="awal" name="awal" value="<?php echo $awal; ?>" >
                        <input type="text" id="akhir" name="akhir" value="<?php echo $akhir; ?>" >
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