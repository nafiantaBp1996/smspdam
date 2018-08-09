 <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Report </h2>
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
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                       
                        <tr>
                          <th>No</th>
                          <th>No Samb</th>
                          <th>Tgl Kirim</th>
                          <th>Text Report</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($report as $key) { ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $key->nosamb; ?></td>
                        <td><?php echo $key->tgl_kirim; ?></td>
                        <td><?php echo $key->text; ?></td>
                        <td><?php if ($key->status==1)
                        {
                          echo "<b style='color:green;'>Success</b>";
                        } else
                        {
                          echo "<b style='color:red;'>Gagal</b>";
                        } ?></td>
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
