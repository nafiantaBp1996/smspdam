<!-- page content -->

        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              

            </div>

            <div class="clearfix"></div>

            
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Api</h2>
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

                  <form method="post" action="<?php echo base_url()."index.php/api/add"; ?>">

                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form-group has-feedback">
                    
                    <input type="text" name="variable" id="variable" class="form-control" placeholder="Tambah Variable"><span class="fa fa-pencil form-control-feedback right" aria-hidden="true"></span>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <button type="submit" name="submit" class="btn btn-success glyphicon glyphicon-plus "></button>
                  </div>

                </form>

                  <div class="x_content">
                  <legend></legend>  
          
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                       <thead>
                        <tr>
                          
                          <th>ID</th>
                          <th>VARIBLE</th>
                          <th>VALUE</th>
                          <th>OPSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($data as $key){ ?>
                        <tr>                          
                          <td><?php echo $key->id; ?></td>
                          <td><?php echo $key->variable; ?></td>
                          <td><?php echo $key->value; ?></td>
                          <td><a href="<?php echo site_url('api/edit_data/'.$key->id); ?>" class="btn btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> <a href="<?php echo site_url('api/delete/'.$key->id); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                        </tr>
                      <?php $i++; } ?>
                      </tbody>
                    </table>
                  </div>
                  

                  
                </div>
              </div>
            
          </div>
        </div>
        <!-- /page content -->