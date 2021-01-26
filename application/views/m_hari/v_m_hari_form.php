
<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'>Form M HARI </span>
          </div>
        </div>
        <div class='portlet-body form'>
          <form action="<?php echo $action; ?>" method="post">
            <div class='form-body'>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('hari_nama')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Hari Nama</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="hari_nama" id="hari_nama" placeholder="Hari Nama" value="<?php echo $hari_nama; ?>" />
                      <span class='help-block'> <?php echo form_error('hari_nama') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
                <input type="hidden" name="hari_id" value="<?php echo $hari_id; ?>" />
              </div>
              <div class='form-actions'>
                <div class='row'>
                  <div class='col-md-offset-5 col-md-7'>
                    <a href="<?php echo site_url('m_hari') ?>" class="btn default">Kembali</a>
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