<?php if($this->session->userdata('group') == '3') {?>
<section class='content'>
<div class='row'>

<?php foreach ($jadwal as $d) {?>
    <div class='col-md-6'>
      <div class='portlet light'>
        <div class='portlet-title'>
          <div class='caption font-green'>
            <span class='caption-subject bold uppercase'> <?php echo $d->hari_nama ?></span>
          </div>
          <div class="actions">
                <div class="btn-group" >
                        <?php echo anchor('t_antrian/booking/'.$d->layanan_id,'<i class="fa fa-pencil"></i> Booking',array('class'=>'btn btn-circle btn-info btn-sm'));?>
                </div>
          </div>

        </div>
        <div class='portlet-body form'>
                    <h4><?php echo date('H:i', strtotime($d->jam_buka)) .' - '. date('H:i', strtotime($d->jam_tutup)) ?></h4>
        </div>
      </div>
    </div>
<?php } ?>

  </div>
</section>
<?php } ?>