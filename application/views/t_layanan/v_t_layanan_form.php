
<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'>Form T LAYANAN </span>
          </div>
        </div>
        <div class='portlet-body form'>
          <form action="<?php echo $action; ?>" method="post">
            <div class='form-body'>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('m_hari_id')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>M Hari Id</label>
                    <div class='col-md-9'>
                      <?php 
                      $v_name_1 = '';
                      if (!empty($m_hari_id)) {                                
                        $v_name_1 = $this->M_hari_model->get($m_hari_id)->{$this->M_hari_model->label};
                      }
                      $ddajax = array(
                        'url' => site_url('form/dd/M_hari_model'), 
                        'name' =>'m_hari_id',
                        'current_selected_id' => $m_hari_id, 
                        'current_selected_name' => $v_name_1, 
                        );
                      $this->load->view('form/v_dropdown_ajax', array('ddajax' => $ddajax ), FALSE); ?>
                      <span class='help-block'> <?php echo form_error('m_hari_id') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('jam_buka')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Jam Buka</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="jam_buka" id="jam_buka" placeholder="Jam Buka" value="<?php echo $jam_buka; ?>" />
                      <span class='help-block'> <?php echo form_error('jam_buka') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('jam_tutup')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Jam Tutup</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="jam_tutup" id="jam_tutup" placeholder="Jam Tutup" value="<?php echo $jam_tutup; ?>" />
                      <span class='help-block'> <?php echo form_error('jam_tutup') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('max_antrian')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Max Antrian</label>
                    <div class='col-md-9'>
                      <div class="input-group">
                        <input type="text" class="form-control mask-number" name="max_antrian" id="max_antrian" placeholder="Max Antrian" value="<?php echo $max_antrian; ?>" />
                        <span class="input-group-addon"> Antrian </span>
                      </div>
                      <span class='help-block'> <?php echo form_error('max_antrian') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
                <input type="hidden" name="layanan_id" value="<?php echo $layanan_id; ?>" />
              </div>
              <div class='form-actions'>
                <div class='row'>
                  <div class='col-md-offset-5 col-md-7'>
                    <a href="<?php echo site_url('t_layanan') ?>" class="btn default">Kembali</a>
                    <?php if ($button == 'Create'): ?>
                    <button type='submit' class='btn green' name='mode' value='new' >Simpan</button>
                    <?php endif ?>
                    <button type='submit' class='btn blue' >Selesai</button>
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