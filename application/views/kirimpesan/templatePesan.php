<!-- page content -->
        <div class="right_col" role="main">
          <div class="row">
            <div class="page-title"></div>
              <div class="title_left"></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Template Pesan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                       <table id="datatable-responsive" class="table table-striped table-bordered" cellspacing="0" width="100%">
                       <thead>
                        <tr>
                          <th width="5%">NO</th>
                          <th>JUDUL</th>
                          <th width="70%">ISI</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($pesan as $key){ ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $key->title; ?></td>
                          <td><?php echo $key->isi; ?></td>
                          <td><a id="btn"  data-toggle="modal" href='#modal-id' class="btn btn-success btn-sm" onclick="gets(<?php echo $key->id ?>)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
                          <a id="btn"  data-toggle="modal" href="<?php echo site_url('pesan/erasepesan/').$key->id; ?>" class="btn btn-danger btn-sm" onclick="gets(<?php echo $key->id ?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus</a>
                          </td>
                        </tr>
                      <?php $i++; } ?>
                      </tbody>
                    </table>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <a onclick="adds()" data-toggle="modal" href='#modal-id' class="btn btn-block btn-default" id="btnTmbh"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span> Tambah</a>
                      
                      </div>
                  </div>
                </div>
                </div>
                
                <div>
                  <div class="modal fade" id="modal-id">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Template Pesan</h4>
                        </div>
                        <div class="modal-body">
                          <form id="myForm" action="" method="POST">
                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <label for="message">Titel</label>
                              <input type="text" class="form-control" id="idtitle" name="title" >
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                              <label for="message">Isi Pesan</label>
                              <textarea type="text" name="isi" class="form-control" id="idisi" maxlength="160" rows="5"></textarea>
                            </div>
                            <input id="getid" type="text" name="id" hidden value="1">
                            <br>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <a style="display: none;" onclick="ale()" value="Submit form" class="btn btn-block btn-warning" id="btnEdit"><span class="glyphicon glyphicon-pencil" aria-hidden="true" ></span> Edit</a>
                            <a style="display: none;" onclick="ale()" class="btn btn-block btn-danger" id="btnAdd"><span class="glyphicon glyphicon-plus" aria-hidden="true" ></span> Tambah</a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </div>
         <script>
          
          function gets(id)
             {$.ajax({
                  type  : 'ajax',
                  url   : '<?php echo base_url()?>index.php/pesan/getPesan/'+id ,
                  async : false,
                  dataType : 'json',
                  success : function(data){
                    document.getElementById('getid').value = data[0].id;
                    document.getElementById('idtitle').value = data[0].title;
                    document.getElementById('idisi').value = data[0].isi;
                    document.getElementById('btnEdit').style.display="block";
                     document.getElementById('btnAdd').style.display="none";
                    document.getElementById('myForm').action="<?php echo site_url('pesan/editpesan') ?>";
                    }         
              });
            }

            function adds()
             {
                    document.getElementById('btnAdd').style.display="block";
                    document.getElementById('btnEdit').style.display="none";
                    document.getElementById('myForm').action="<?php echo site_url('pesan/addpesan') ?>";
            }
          </script>
          <script type="text/javascript">
          function ale() {
            swal({
            title: "Anda Yakin Mengirim Pesan?",
            text: "Anda Tidak bisa membatalkan aksi ini",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#94e881',
            confirmButtonText: 'Perbarui',
            cancelButtonText: "Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: false
         },
         function(isConfirm){

           if (isConfirm)
             {
                  if(document.getElementById('getid').value!=""&&document.getElementById('idtitle').value!=""&&document.getElementById('idisi').value!="")
                  {
                    swal("Berhasil", "Berhasil Diperbarui", "success");
                    myFunction();  

                  }
                  else
                  {
                    swal("Gagal", "Gagal Diperbarui", "error");
                  }
                  
            }
           else
             {
                swal("Gagal", "Gagal Diperbarui", "error");
             }
          });
        };

         function myFunction() {
                    document.getElementById("myForm").submit();
                }
        </script>
        
        <!-- /page content -->