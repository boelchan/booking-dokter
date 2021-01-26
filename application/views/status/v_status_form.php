
<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'>Form STATUS </span>
          </div>
        </div>
        <div class='portlet-body form'>
          <form action="<?php echo $action; ?>" method="post">
            <div class='form-body'>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('status_nama')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Status Nama</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="status_nama" id="status_nama" placeholder="Status Nama" value="<?php echo $status_nama; ?>" />
                      <span class='help-block'> <?php echo form_error('status_nama') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('keterangan')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Keterangan</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                      <span class='help-block'> <?php echo form_error('keterangan') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
                <input type="hidden" name="status_id" value="<?php echo $status_id; ?>" />
              </div>
              <div class='form-actions'>
                <div class='row'>
                  <div class='col-md-offset-5 col-md-7'>
                    <a href="<?php echo site_url('status') ?>" class="btn default">Kembali</a>
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