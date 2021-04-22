<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Try Out Ganesha Operation</title>
<link rel="shortcut icon" href="<?php print base_url('vendor/SI/img/favicon.ico');?>" />

<!-- Bootstrap Core CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- datatable -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css"/>

    <style>
	.container {
	  max-width: 960px;
	}

	.lh-condensed { line-height: 1.25; }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      .fullscreen-bg {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
    z-index: -100;
}

.fullscreen-bg__video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

#loading-div-background{
      display: none;
      background: rgba(0,0,0,0.5);
      z-index: 99;
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
      filter: alpha(opacity=80);
      -moz-opacity: 0.8;
      -khtml-opacity: 0.8;
      opacity: 0.8;
}

#loading-div{
      color: white;
      font-size: 40px;
      padding: 10px;
      position: fixed;
      top: 40%;
      left: 45%;
      z-index: 100;
      margin-right: -25%;
      margin-bottom: -25%;
      text-align: center;

}

@media (min-aspect-ratio: 16/9) {
  .fullscreen-bg__video {
    width: 100%;
    height: auto;
  }
}

@media (max-aspect-ratio: 16/9) {
  .fullscreen-bg__video {
    width: auto;
    height: 100%;
  }
}

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/album.css');?>">

 
</head>

<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    
    <div id="loading-div-background">
      <div id="loading-div" class="ui-corner-all">
        <img style="height:150px;width:150px;margin:30px;" src="<?echo base_url('/assets/images/loading.gif');?>" alt="Loading.."/><br>Silakan Tunggu.
      </div>
    </div>

    <?php if($this->uri->segment(1) == 'Admin') { ?>
      <!-- Image and text -->
      <nav class="navbar navbar-light">
        <a class="navbar-brand" href="#">
          <img src="<?php echo base_url('assets/images/logo2.png');?>" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Admin/Export/');?>">Export Data</a>
            </li>
          <?php if($this->uri->segment(1) == 'Admin') { ?>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url('Admin');?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Admin/pendaftarAll');?>">Semua Pendaftar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Admin/pendaftarBelum');?>">Pendaftar Belum Bayar</a>
            </li>
            <hr>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Auth/logout');?>">Logout</a>
            </li>
          <?php } else if($this->uri->segment(2) == 'pendaftarAll') { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Admin');?>">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url('Admin/pendaftarAll');?>">Semua Pendaftar <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Admin/pendaftarBelum');?>">Pendaftar Belum Bayar</a>
            </li>
            <hr>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Auth/logout');?>">Logout</a>
            </li>
          <?php } else if($this->uri->segmen(2) == 'pendaftarBelum') { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Admin');?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Admin/pendaftarAll');?>">Semua Pendaftar</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo base_url('Admin/pendaftarBelum');?>">Pendaftar Belum Bayar <span class="sr-only">(current)</span></a>
            </li>
            <hr>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('Auth/logout');?>">Logout</a>
            </li>
          <?php } ?>
          </ul>
        </div>        
      </nav>
    <?php }?>


