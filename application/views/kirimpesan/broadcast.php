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
            </div>

            <div class="clearfix"></div>
            <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel" style="height: auto;">
                <div class="x_title">
                  <h2>Filter Data<small>Pelanggan</small></h2>
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
                <div class="x_content" style="margin-right: 10px">
                  <?php echo form_open('pesan/broadcast'); ?>
                          <div class="col-md-3 col-sm-3 col-xs-12" style="padding-top: 10px">
                              <label>
                                <input name="chknosamb" value="checked" type="checkbox" id="cekNosamb" onclick="nosamb();">
                                No Samb
                                <input type="number" id="textNosamb" class="form-control col-md-12" name="nos" disabled >
                              </label>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12" style="padding-top: 10px">
                              <label>
                                <input name="chkrayon" value="checked" type="checkbox" id="cekRayon" onclick="rayon();">
                                Rayon
                                <select name="selrayon" class="select2_single form-control" tabindex="-1" id="selRayon" disabled >
                                <?php foreach ($rayon as $key){?>
                                    <option value="<?php echo $key->koderayon ?>"><?php echo $key->namarayon ?></option>
                                <?php } ?>
                              </select>
                              </label>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12" style="padding-top: 10px">
                              <label>
                                <input name="chkkelurahan" value="checked" type="checkbox" id="cekKelurahan" onclick="kelurahan();">
                                Kelurahan
                                <select name="selkelurahan"  class="select2_single form-control" tabindex="-1" id="selKelurahan" disabled>
                                <option></option>
                                <?php foreach ($kelurahan as $key){?>
                                    <option value="<?php echo $key->kodekelurahan ?>"><?php echo $key->kelurahan ?></option>
                                <?php } ?>                      </select>
                              </label>
                          </div>
                          <div class="col-md-3 col-sm-3 col-xs-12" style="padding-top: 10px">
                              <label>
                                <input name="chkgolongan" value="checked" type="checkbox" id="cekGolongan" onclick="golongan();">
                                Golongan
                                <select name="selgolongan" class="select2_single form-control" tabindex="-1" id="selGolongan" disabled>
                                <option></option>
                                <?php foreach ($golongan as $key){?>
                                    <option value="<?php echo $key->kodegol ?>"><?php echo $key->golongan ?></option>
                                <?php } ?>
                              </select>
                              </label>
                          </div>
                          <div class="col-md-12">
                            <label for="inputsm"></label>
                            <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Load</button>
                          </div>
            <?php echo form_close(); ?>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Isi Pesan<small>Broadcast</small></h2>
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
                <div class="x_content" style="margin-right: 10px">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="form-group col-md-12">
                      <div class="col-sm-3">
                        <script>
                          function startData()
                          {
                            intervals = setInterval("getData()",1);
                          }
                          
                          function getData()
                            {
                              var one = document.getElementById('selectPesan').value;
                              $.ajax({
                                  type  : 'ajax',
                                  url   : '<?php echo base_url()?>index.php/pesan/getPesan/'+one ,
                                  async : false,
                                  dataType : 'json',
                                  success : function(data){
                                    var html=data[0].isi;
                                    $('#txtPesan').html(html);
                                     
                                  }

                              });
                            }
                            function stopData()
                            {
                              clearInterval(intervals);
                            }
                          </script>
                        <label>Template : </label>
                      </div>
                      <div class="col-md-5">
                        <select id="selectPesan" class="select2_single form-control" tabindex="-1" placeholder="Template Pesan" name="selPesan" onFocus="startData();" onBlur="stopData();">
                          <option></option>
                          <?php foreach ($pesan as $key){?>
                                    <option value="<?php echo $key->id ?>"><?php echo $key->title ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="margin: 0;padding: 0">
                          <a href="<?php echo site_url('pesan/templatepesan') ?>" class="btn btn-block btn-success"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit Template</a>
                        </div>  
                      </div>
                    <br>
                  </div>
                  <form id="myForm" action="<?php echo site_url('pesan/kirim') ?>" method="POST">
                                                   
                  <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <textarea id="txtPesan" name="textpesan" maxlength="160" style="font-size: 14pt;resize: none;" class="form-control" rows="5" placeholder="Tulis Pesan Disini"></textarea>
                    </div>
                  </div>
                  
                  <div class="col-md-12">
                    <label for="inputsm"></label>
                    <a onclick="alertt()" value="Submit form" class="btn btn-block btn-warning"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Kirim Pesan</a>
                    <input hidden="" id="querys" name="query" type="text" value="<?php echo $que ?>" >
                  </div>
                  </form>
                </div>
              </div>
            </div>
            </div>

              <div class="col-md-6 col-sm-6 col-xs-6">
              
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Pelanggan<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
                      <legend></legend>
          
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>No Samb</th>
                          <th>Nama  </th>
                          <th>Alamat</th>
                          <th>No Hp</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($daftarpelanggan as $key) { ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $key->nosamb; ?></td>
                        <td><?php echo $key->nama; ?></td>
                        <td><?php echo $key->alamat; ?></td>
                        <td><?php echo $key->nohp; ?></td>
                        <td><?php echo $key->status; ?></td>
                        </tr>
                      <?php $i++; } ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
              </div>
            
          </div>
        </div>
        <!-- /compose -->
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
                  if(document.getElementById('querys').value!=""&&document.getElementById('txtPesan').value!="")
                  {
                    swal("Terkirim", "Pesan Terkirim", "success");
                    myFunction();  

                  }
                  else
                  {
                    swal("Tidak Terkirim", "Maaf Pesan Tdak terkirim Data Kosong", "error");
                  }
                  
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