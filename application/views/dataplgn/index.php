 <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Data Pelanggan</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Cari</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Daftar Nama </h2>
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
                          <th>Nama  </th>
                          <th>Alamat</th>
                          <th>No Hp</th>
                          <th>No Telp</th>
                          <th>Tanggal Daftar</th>
                          <th>Tanggal NonAktif</th>
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
                        <td><?php echo $key->notelp; ?></td>
                        <td><?php echo $key->tgldaftar; ?></td>
                        <td><?php echo $key->tglnonaktif; ?></td>
                        <td><?php echo $key->status; ?></td>
                        </tr>
                      <?php $i++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
