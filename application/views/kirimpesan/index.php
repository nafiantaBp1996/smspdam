<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kirim Pesan</h2>
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
                    <br />
                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                      <label for="message">Nomor HP :</label>
                        <input type="number" class="form-control" id="nohp" placeholder="Awali dengan 62 bukan 0" name="numbers" >
                        <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <label for="message">Pesan :</label>
                        <textarea type="text" name="content" class="form-control" id="content"></textarea>
                        </div>
                      <br>
                      <div class="form-group">
                        
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group" align="right">
                        
                          <button onclick="alertt()"  name="submit" class="btn btn-success">Kirim</button>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        <script type="text/javascript">
          function kirimpesan() {
          var nohp = document.getElementById("nohp").value;
          var content = document.getElementById("content").value;
          // Returns successful data submission message when the entered information is stored in database.
          var dataString = 'nohp=' + nohp + '&content=' + content;
          if (nohp == '' || content == '' ) {
            return 0;
          } else
          {
          // AJAX code to submit form.
          $.ajax(
            {
              type: "POST",
              url: "<?php echo site_url('curlsms/kirim') ?>",
              data: dataString,
              cache: false,
              success:function()
              {
                
              }
            });
            return 1;
          }
          }

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

           if (isConfirm){
             if (kirimpesan()==1)
             {
                swal({
                    title: "Pesan dikirim ke No"+ document.getElementById("nohp").value,
                    text: "",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonColor: '#94e881',
                    confirmButtonText: 'OK',
                    closeOnConfirm: false,
                    closeOnCancel: false
                 },function(isConfirm)
                  {
                    if (isConfirm) 
                    {
                      redir();
                    }
                  });
                
             }
             else
             {
                swal("Tidak Terkirim", "Maaf Pesan Tdak terkirim Cek No Hp", "error");
             }
            } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
         });
        };
        function redir()
        {
          window.location = '<?php echo site_url('report/Lastest/1'); ?>';
        }
        </script>