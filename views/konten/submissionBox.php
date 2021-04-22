<head>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-cxkp35nEfzm1_n3G"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<style>
  div{text-align: left}
</style>
<div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="<?php echo base_url('assets/images/logo2.png');?>" alt="">
    <h2>Pendaftaran Try Out Ganesha Operation</h2>
    <p class="lead">Silakan isi form dibawah ini.</p>
  </div>
  
  <form action="<?php echo base_url().'Welcome/createSubmission/'?>" method="post">
    <div class="col-md-12 order-md-1">
      <!-- <form class="needs-validation" novalidate> -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="exampleInputNamaDepan">Nama Lengkap</label>
            <input id = "nama" type="text" name="pendaftarNama" class="form-control" placeholder="Masukkan nama lengkap kamu">
      <?php if(form_error('pendaftarNama'))
              {
                echo '<small id="NamaDepanHelp" class="form-text text-danger">'.form_error('pendaftarNama').'</small>';
              } else {
                echo '<small id="NamaDepanHelp" class="form-text text-muted">Silakan masukkan nama kamu.</small>';
      }?>
          </div>

          <div class="col-md-6 mb-3">
            <label for="Ponsel">No. Handphone</label>
			  <input id = "telfon" type="number" name="pendaftarTelepon" class="form-control" placeholder="Masukkan nomor handphone kamu">
			  <?php if(form_error('pendaftarTelepon'))
			  {
				echo '<small id="EmailHelp" class="form-text text-danger">'.form_error('pendaftarTelepon').'</small>';
			  } else {
				echo '<small id="EmailHelp" class="form-text text-muted">Silakan masukkan nomor handphone kamu</small>';
			  }?>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">E-mail <span class="text-muted"> (Pastikan e-mail yang kamu gunakan masih aktif)</span></label>
          <input id = "mail" type="email" name="pendaftarEmail" class="form-control" placeholder="Masukkan Email Kamu">
          <?php if(form_error('pendaftarEmail'))
          {
            echo '<small id="EmailHelp" class="form-text text-danger">'.form_error('pendaftarEmail').'</small>';
          } else {
            echo '<small id="EmailHelp" class="form-text text-muted">Silakan masukkan e-mail</small>';
          }?>
        </div>
        
        <div class="mb-3">
            <label for="Alamat">Alamat Lengkap</label>
            <input id = "alamat" type="text" name="pendaftarAlamat" class="form-control" placeholder="Masukkan Alamat Lengkap Kamu">
            <?php if(form_error('pendaftarAlamat'))
            {
              echo '<small id="EmailHelp" class="form-text text-danger">'.form_error('pendaftarAlamat').'</small>';
            } else {
              echo '<small id="EmailHelp" class="form-text text-muted">Silakan masukkan alamat lengkap kamu</small>';
            }?>
          </div>
      
        <div class="mb-3">
            <label for="TTL">Kota Domisili</label>
             <br>
            <select id= "kota" class="select show-tick" name="pendaftarAsalSekolah" data-live-search="true" data-width="100%">
              <option selected disabled>--Pilih--</option>
              <?php foreach($kota as $kokab) :?>
              <option data-tokens="<?php print $kokab->nama;?>" value="<?php print $kokab->nama;?>"><?php echo $kokab->nama;?></option>
              <?php endforeach;?>
            </select>
            <?php if(form_error('pendaftarAsalSekolah'))
            {
              echo '<small id="EmailHelp" class="form-text text-danger">'.form_error('pendaftarAsalSekolah').'</small>';
            } else {
              echo '<small id="EmailHelp" class="form-text text-muted">silakan pilih kota bimbel kamu</small>';
            }?>
        </div> 
		
	<div class="row">		
		<div class="col-md-6 mb-3">
            <label for="TTL">Tanggal Lahir</label>
            <input id= "tanggal" type="date" name="pendaftarTTL" class="form-control">
            <?php if(form_error('pendaftarTTL'))
            {
              echo '<small id="EmailHelp" class="form-text text-danger">'.form_error('pendaftarTTL').'</small>';
            } else {
              echo '<small id="EmailHelp" class="form-text text-muted">silakan masukkan tanggal lahir kamu</small>';
            }?>
          </div>  
		  
		  <div class="col-md-6 mb-3">
					<label for="exampleInputNamaDepan">Nama Orang Tua</label>
					<input id= "ortu" type="text" name="pendaftaribu" class="form-control" placeholder="">
			  <?php if(form_error('pendaftaribu'))
					  {
						echo '<small id="NamaDepanHelp" class="form-text text-danger">'.form_error('pendaftaribu').'</small>';
					  } else {
						echo '<small id="NamaDepanHelp" class="form-text text-muted">silakan masukkan nama lengkap orang tua kamu.</small>';
			  }?>
			</div>
	</div>
          
<div class="row">
  <div class="col-md-12 mb-3">
    <label for="country">Pilih Jenis Try Out</label>
    <select id= "program" class="select d-block w-100" name="pendaftarTingkat">
      <option selected disabled>--Pilih--</option>
      <option value="SAINTEK">SAINTEK</option>
	  <option value="SOSHUM">SOSHUM</option>
    </select>
  </div>
</div>

    <hr class="mb-4">
    <button class="btn btn-primary btn-lg btn-block" id="pay-button" onclick="show()" type="submit">Daftar</button>
      <!-- </form> -->
    </div>
  </div>
</form>
<br>
<br>
<br>
<br>  
</div>

 <script type="text/javascript">

    $('#pay-button').click(function (event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled");
  
      var nama          = $("#nama").val();
	  var telfon        = $("#telfon").val();
	  var mail          = $("#mail").val();
	  var alamat        = $("#alamat").val();
      var kota          = $("#kota").val();
	  var tanggal       = $("#tanggal").val();
	  var ortu          = $("#ortu").val();
      var program       = $("#program").val();


    $.ajax({
      method : 'POST',
      url: '<?=site_url()?>/snap/token',
      data : { nama: nama, telfon: telfon, mail: mail, alamat: alamat, kota: kota, pendaftarTTL: tanggal, pendaftaribu: ortu, pendaftarTingkat: program},
      cache: false,

      success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });
		var url = "<?php echo base_url().'Welcome/thankyoupage/'?>"
		$.ajax({
             url : url,
             method : "POST",
             data : {pendaftarNama: nama, pendaftarTelepon: telfon, pendaftarEmail: mail, pendaftarAlamat: alamat, pendaftarAsalSekolah: kota, tanggal: tanggal, ortu: ortu, program: program},
             dataType : 'json',
          success: function(data){
            if(data=="sukses") {alert("Transaksi kamu sudah tersimpan");
            kosongkan();
            }
            else
            alert("Transaksi kamu belum tersimpan");

           }
              });

  </script>
