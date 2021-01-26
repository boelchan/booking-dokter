
<!-- Main content -->
<section class='content'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'>Form MENU </span>
          </div>
        </div>
        <div class='portlet-body form'>
          <form action="<?php echo $action; ?>" method="post">
            <div class='form-body'>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('menu_nama')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Menu Nama</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="menu_nama" id="menu_nama" placeholder="Menu Nama" value="<?php echo $menu_nama; ?>" />
                      <span class='help-block'> <?php echo form_error('menu_nama') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('link')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Link</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
                      <span class='help-block'> <?php echo form_error('link') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('icon')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Icon</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
                      <span class='help-block'> <?php echo form_error('icon') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('order')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Order</label>
                    <div class='col-md-9'>
                      <div class="input-group">
                        <input type="text" class="form-control mask-number" name="order" id="order" placeholder="Order" value="<?php echo $order; ?>" />
                        <span class="input-group-addon"> detik </span>
                      </div>
                      <span class='help-block'> <?php echo form_error('order') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('is_active')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Is Active</label>
                    <div class='col-md-9'>
                      <div class="input-group">
                        <input type="text" class="form-control mask-number" name="is_active" id="is_active" placeholder="Is Active" value="<?php echo $is_active; ?>" />
                        <span class="input-group-addon"> detik </span>
                      </div>
                      <span class='help-block'> <?php echo form_error('is_active') ?> </span>
                    </div>
                  </div>
                </div>
                
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('is_parent')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Is Parent</label>
                    <div class='col-md-9'>
                      <div class="input-group">
                        <input type="text" class="form-control mask-number" name="is_parent" id="is_parent" placeholder="Is Parent" value="<?php echo $is_parent; ?>" />
                        <span class="input-group-addon"> detik </span>
                      </div>
                      <span class='help-block'> <?php echo form_error('is_parent') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class='row'>
                <div class='col-md-6'>
                  <div class='form-group <?php if(form_error('controller')){echo 'has-error';} ?>'>
                    <label class='col-md-3 control-label'>Controller</label>
                    <div class='col-md-9'>
                      <input type="text" class="form-control" name="controller" id="controller" placeholder="Controller" value="<?php echo $controller; ?>" />
                      <span class='help-block'> <?php echo form_error('controller') ?> </span>
                    </div>
                  </div>
                </div>
                
              </div>
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
              </div>
              <div class='form-actions'>
                <div class='row'>
                  <div class='col-md-offset-5 col-md-7'>
                    <a href="<?php echo site_url('menu') ?>" class="btn default">Kembali</a>
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