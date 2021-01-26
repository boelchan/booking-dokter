
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='portlet light'>
                <div class='portlet-title'>
                  <div class='caption font-green'>
                    <span class='caption-subject bold uppercase'>T_layanan</span>
                  </div>
                </div><!-- /.title -->
                <div class='portlet-body'>
                  <table class="table table-bordered">
                    <tr><td>M Hari Id</td><td><?php echo $m_hari_id; ?></td></tr>
                    <tr><td>Jam Buka</td><td><?php echo $jam_buka; ?></td></tr>
                    <tr><td>Jam Tutup</td><td><?php echo $jam_tutup; ?></td></tr>
                    <tr><td>Max Antrian</td><td><?php echo $max_antrian; ?></td></tr>
                    <tr>
                      <td colspan='2'>
                        <div class='form-actions'>
                          <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <a href="<?php echo site_url('t_layanan') ?>" class="btn default">Kembali</a>
                                <a href="<?php echo site_url('t_layanan/update/'.$id) ?>" class="btn btn-success">Edit</a>
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