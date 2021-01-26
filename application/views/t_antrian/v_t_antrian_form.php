
<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'>Form T ANTRIAN </span>
          </div>
        </div>
        <div class='portlet-body form'>
          <form action="<?php echo $action; ?>" method="post">
            <div class='form-body'>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('layanan_id')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Layanan Id</label>
                    <div class='col-md-9'>
                      <?php 
                      $v_name_1 = '';
                      if (!empty($layanan_id)) {                                
                        $v_name_1 = $this->T_layanan_model->get($layanan_id)->{$this->T_layanan_model->label};
                      }
                      $ddajax = array(
                        'url' => site_url('form/dd/T_layanan_model'), 
                        'name' =>'layanan_id',
                        'current_selected_id' => $layanan_id, 
                        'current_selected_name' => $v_name_1, 
                        );
                      $this->load->view('form/v_dropdown_ajax', array('ddajax' => $ddajax ), FALSE); ?>
                      <span class='help-block'> <?php echo form_error('layanan_id') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('no_rm')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>No Rm</label>
                    <div class='col-md-9'>
                      <?php 
                      $v_name_2 = '';
                      // if (!empty($no_rm)) {                                
                      //   $v_name_2 = $this->M_user_model->get($no_rm)->{$this->M_user_model->label};
                      // }
                      $ddajax = array(
                        'url' => site_url('form/dd_rm/M_user_model'), 
                        'name' =>'no_rm',
                        'current_selected_id' => $no_rm, 
                        'current_selected_name' => $no_rm, 
                        );
                      $this->load->view('form/v_dropdown_ajax', array('ddajax' => $ddajax ), FALSE); ?>
                      <span class='help-block'> <?php echo form_error('no_rm') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('antrian_no')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Antrian No</label>
                    <div class='col-md-9'>
                      <div class="input-group">
                        <span class="input-group-addon"> ke </span>
                        <input type="text" class="form-control mask-number" name="antrian_no" id="antrian_no" placeholder="Antrian No" value="<?php echo $antrian_no; ?>" />
                      </div>
                      <span class='help-block'> <?php echo form_error('antrian_no') ?> </span>
                    </div>
                  </div>
                </div>
                            
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('diagnosa')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Diagnosa</label>
                    <div class='col-md-9'>
                      <textarea class="form-control" rows="3" name="diagnosa" id="diagnosa" placeholder="Diagnosa" <?php echo ($this->session->userdata('group') == 2) ? 'readonly':'' ?>><?php echo $diagnosa; ?></textarea>
                      <span class='help-block'> <?php echo form_error('diagnosa') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('biaya')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Biaya</label>
                    <div class='col-md-9'>
                      <div class="input-group">
                        <span class="input-group-addon"> Rp. </span>
                        <input type="text" class="form-control mask-number" <?php echo ($this->session->userdata('group') == 2) ? 'readonly':'' ?> name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $biaya; ?>" />
                      </div>
                      <span class='help-block'> <?php echo form_error('biaya') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('status')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Status</label>
                    <div class='col-md-9'>
                      <?php 
                      $v_name_6 = '';
                      if (!empty($status)) {                                
                        $v_name_6 = $this->Status_model->get($status)->{$this->Status_model->label};
                      }
                      $ddajax = array(
                        'url' => site_url('form/dd/Status_model'), 
                        'name' =>'status',
                        'current_selected_id' => $status, 
                        'current_selected_name' => $v_name_6, 
                        );
                      $this->load->view('form/v_dropdown_ajax', array('ddajax' => $ddajax ), FALSE); ?>
                      <span class='help-block'> <?php echo form_error('status') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
                <input type="hidden" name="antrian_id" value="<?php echo $antrian_id; ?>" />
              </div>
              <div class='form-actions'>
                <div class='row'>
                  <div class='col-md-offset-5 col-md-7'>
                    <a href="<?php echo site_url('t_antrian') ?>" class="btn default">Kembali</a>
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