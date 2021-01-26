
<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'>Form ANTRIAN </span>
          </div>
        </div>
        <div class='portlet-body form'>
          <form action="<?php echo $action; ?>" method="post">
            <div class='form-body'>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('layanan_id')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Jadwal</label>
                    <div class='col-md-9'>
                        <label for=""><?php echo $row->hari_nama ?></label>
                    </div>
                  </div>
                </div>

                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('layanan_id')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Jam</label>
                    <div class='col-md-9'>
                        <label for=""><?php echo date('H:i', strtotime($row->jam_buka)) .' - '. date('H:i', strtotime($row->jam_tutup)) ?></label>
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
                        <input type="text" class="form-control mask-number" name="antrian_no" id="antrian_no" placeholder="Antrian No" value="" />
                      </div>
                      <span class='help-block'> <?php echo form_error('antrian_no') ?> </span>
                    </div>
                  </div>
                </div>
                
                
              </div>
              <input type="hidden" name="layanan_id" value="<?php echo $layanan_id?>">
              <input type="hidden" name="no_rm" value="<?php echo $no_rm?>">
              <div class='form-actions'>
                <div class='row'>
                  <div class='col-md-offset-5 col-md-7'>
                    <a href="<?php echo site_url() ?>" class="btn default">Kembali</a>
                    <button type='submit' class='btn blue' >Booking ?</button>
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