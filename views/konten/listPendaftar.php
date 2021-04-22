<div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="<?php echo base_url('assets/images/logo2.png');?>" alt="">
    <h2>List Pendaftar</h2>
    
    

  <p class="lead">List Semua Pendaftar</p>
</div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nomor Pendaftaran</th>
      <th scope="col">Nama</th>
      <th scope="col">Program Belajar</th>
      <th scope="col">E-mail</th>
	  <th scope="col">Nomor Handphone</th>
	  <th scope="col">Alamat</th>
	  <th scope="col">Unit Bimbel</th>
	  <th scope="col">Tanggal Pendaftaran</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php $i  = 1;?>
  <?php foreach($listPendaftar as $list) :?>
    <tr>
      <th scope="row"><?php echo $i++;?></th>
      <td><?php echo $list->pendaftarInvoice;?></td>
      <td><?php echo $list->pendaftarNama;?></td>
	  <td><?php echo $list->pendaftarTingkat;?></td>
	  <td><?php echo $list->pendaftarEmail;?></td>
	  <td><?php echo $list->pendaftarTelepon;?></td>
	  <td><?php echo $list->pendaftarAlamat;?></td>
	  <td><?php echo $list->pendaftarAsalSekolah;?></td>
	  <td><?php echo $list->entry_date;?></td>
      <td><a href="<?php print base_url('Admin/Hapus/'.$list->pendaftarId);?>" class="btn btn-sm btn-danger">Hapus</a></td>
    </tr>
  <?php endforeach;?>
  </tbody>
</table>
