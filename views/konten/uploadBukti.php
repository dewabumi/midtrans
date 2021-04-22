<?php if(isset($tidak)) {?>      
            <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>               
              <h4 class="alert-heading">Mohon Maaf!</h4>
              <p class="mb-0"><?php echo $tidak;?></p>
              <hr>
              <p>TERIMA KASIH</p>
            </div>
<?php }?> 

<div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="<?php echo base_url('assets/images/logo2.png');?>" alt="">
    <h2>Upload Bukti Transfermu disini</h2>
    <p class="lead">Silakan Upload bukti transfer anda dengan memasukan nomor Invoice yang anda dapat dan bukti transfer anda.</p>
    <p class="lead">Transfer ke BCA : 7773066860 a.n. Pend. Ganesha Operation PT.</p>
    <p class="lead">Transfer ke BNI : 1984606162 a.n. Pendidikan Ganesha Operation PT</p>
</div>

<form action="<?php echo base_url('Welcome/uploadBukti/');?>" method="POST" enctype="multipart/form-data">
<div class="container">
  <div class="row">

    <div class="col">
        <div class="col-md-12">
            <!-- <form class="needs-validation" novalidate> -->
            <div class="row">
                <div class="col-md-12 mb-3">
                <label for="exampleInputNamaDepan">Nomor Invoice</label>
                <input type="text" name="invoice" class="form-control" placeholder="Masukan Nomor Invoice">
                    <?php if(form_error('pendaftarNama'))
                            {
                                echo '<small id="NamaDepanHelp" class="form-text text-danger">'.form_error('bukti_pendaftarInvoice').'</small>';
                            } else {
                                echo '<small id="NamaDepanHelp" class="form-text text-muted">Silakan Masukan Nomor Invoice.</small>';
                    }?>
                </div>

                <div class="col-md-12 mb-3">
                <label for="exampleInputNamaDepan">Nama Pemilik Rekening</label>
                <input type="text" name="bukti_namaPemilikRek" class="form-control" placeholder="Masukan Nama pemilik rekening">
                    <?php if(form_error('pendaftarNama'))
                            {
                                echo '<small id="NamaDepanHelp" class="form-text text-danger">'.form_error('bukti_namaPemilikRek').'</small>';
                            } else {
                                echo '<small id="NamaDepanHelp" class="form-text text-muted">Silakan nama pemilik rekening.</small>';
                    }?>
                </div>
                
                <div class="mx-auto">
                    <div class="custom-file mb-3">
                        <input type="file" name="bukti_transfer" class="custom-file-input">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <?php if(isset($error)) { ?>
                            <label><?php echo $error;?></label>
                        <?php  } ?>
                    </div>
                </div>    
            </div>
        </div>
    </div>
  </div>
</div>
        <button type="submit" onclick="show()" class="btn btn-success">submit</button>
</form>