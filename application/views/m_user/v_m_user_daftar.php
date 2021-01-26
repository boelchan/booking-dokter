
<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'>Form Daftar Pasien Baru</span>
          </div>
        </div>
        <div class='portlet-body form'>
          <form action="<?php echo $action; ?>" method="post">
            <div class='form-body'>
            <h3>Akun</h3>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('user_name')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>User Name</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" value="<?php echo $user_name; ?>" />
                      <span class='help-block'> <?php echo form_error('user_name') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('user_pass')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>User Pass</label>
                    <div class='col-md-9'>
                      <input type="password" class="form-control" name="user_pass" id="user_pass" placeholder="User Pass" value="<?php echo $user_pass; ?>" />
                      <span class='help-block'> <?php echo form_error('user_pass') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('no_rm')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>No Rm</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="no_rm" id="no_rm" placeholder="No Rm" value="<?php echo $no_rm; ?>" />
                      <span class='help-block'> <?php echo form_error('no_rm') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <?php if ($this->session->userdata('group') == 1) {?>

                  <div class='form-group <?php if(form_error('level')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Level</label>
                    <div class='col-md-9'>
                      <?php 
                      $v_name_4 = '';
                      if (!empty($level)) {                                
                        $v_name_4 = $this->M_level_model->get($level)->{$this->M_level_model->label};
                      }
                      $ddajax = array(
                        'url' => site_url('form/dd/M_level_model'), 
                        'name' =>'level',
                        'current_selected_id' => $level, 
                        'current_selected_name' => $v_name_4, 
                        );
                      $this->load->view('form/v_dropdown_ajax', array('ddajax' => $ddajax ), FALSE); ?>
                      <span class='help-block'> <?php echo form_error('level') ?> </span>
                    </div>
                  <?php } else { ?>
                  <input type="hidden" name="level" value="3">
                  <?php }  ?>
                  </div>
                </div>
                
              </div>
              <h3>Biodata</h3>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('nama')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Nama</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                      <span class='help-block'> <?php echo form_error('nama') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('jenis_kelamin')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Jenis Kelamin</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
                      <span class='help-block'> <?php echo form_error('jenis_kelamin') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('tanggal_lahir')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Tanggal Lahir</label>
                    <div class='col-md-9'>
                      <div class='input-group date date-decade' >
                        <input type='text' class='form-control ' readonly name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>">
                        <span class='input-group-btn'>
                          <button class='btn default' type='button'>
                            <i class='fa fa-calendar'></i>
                          </button>
                        </span>
                      </div>
                      <span class='help-block'> <?php echo form_error('tanggal_lahir') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('alamat')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Alamat</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
                      <span class='help-block'> <?php echo form_error('alamat') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('no_hp')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>No Hp</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
                      <span class='help-block'> <?php echo form_error('no_hp') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
              </div>
              <div class='form-actions'>
                <div class='row'>
                  <div class='col-md-offset-5 col-md-7'>
                    <button type='submit' class='btn blue' >Daftar</button>
                  </div>
                </div>
              </div>
              
            </div>
          </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->