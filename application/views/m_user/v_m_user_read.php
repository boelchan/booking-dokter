
        <!-- Main content -->
        <section class='content'>
          <div class='row'>
            <div class='col-xs-12'>
              <div class='portlet light'>
                <div class='portlet-title'>
                  <div class='caption font-green'>
                    <span class='caption-subject bold uppercase'>M_user</span>
                  </div>
                </div><!-- /.title -->
                <div class='portlet-body'>
                  <table class="table table-bordered">
                    <tr><td>User Name</td><td><?php echo $user_name; ?></td></tr>
                    <tr><td>User Pass</td><td><?php echo $user_pass; ?></td></tr>
                    <tr><td>No Rm</td><td><?php echo $no_rm; ?></td></tr>
                    <tr><td>Level</td><td><?php echo $level; ?></td></tr>
                    <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
                    <tr><td>Jenis Kelamin</td><td><?php echo $jenis_kelamin; ?></td></tr>
                    <tr><td>Tanggal Lahir</td><td><?php echo $tanggal_lahir; ?></td></tr>
                    <tr><td>Alamat</td><td><?php echo $alamat; ?></td></tr>
                    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
                    <tr>
                      <td colspan='2'>
                        <div class='form-actions'>
                          <div class='row'>
                            <div class='col-md-offset-5 col-md-7'>
                                <a href="<?php echo site_url('m_user') ?>" class="btn default">Kembali</a>
                                <a href="<?php echo site_url('m_user/update/'.$id) ?>" class="btn btn-success">Edit</a>
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