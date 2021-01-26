
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='portlet light'>
                <div class='portlet-title'>
                  <div class='caption font-green'>
                    <span class='caption-subject bold uppercase'>T_antrian</span>
                  </div>
                </div><!-- /.title -->
                <div class='portlet-body'>
                  <table class="table table-bordered">
                    <tr><td>Layanan Id</td><td><?php echo $layanan_id; ?></td></tr>
                    <tr><td>No Rm</td><td><?php echo $no_rm; ?></td></tr>
                    <tr><td>Antrian No</td><td><?php echo $antrian_no; ?></td></tr>
                    <tr><td>Diagnosa</td><td><?php echo $diagnosa; ?></td></tr>
                    <tr><td>Biaya</td><td><?php echo $biaya; ?></td></tr>
                    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
                    <tr>
                      <td colspan='2'>
                        <div class='form-actions'>
                          <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <a href="<?php echo site_url('t_antrian') ?>" class="btn default">Kembali</a>
                                <a href="<?php echo site_url('t_antrian/update/'.$id) ?>" class="btn btn-success">Edit</a>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.col -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->