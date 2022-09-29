<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://github.com/pipwerks/PDFObject/blob/master/pdfobject.min.js"></script>
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<?php

  if(isset($_POST['tambah'])){

    include "koneksi.php";

    $noSurat = strip_tags($_POST['noSurat']);
    $judul = strip_tags($_POST['Judul']);

    $date = date("Y/m/d");
    $time = date("h:i:sa");

    $kategori = strip_tags($_POST['kategori']);

    $lokasi_file = $_FILES['surat']['tmp_name'];
    $nama_file = $_FILES['surat']['name'];

    $folder = "upload/$nama_file";

    if (move_uploaded_file($lokasi_file,"$folder")){
      //echo "Nama File : <b>$nama_file</b> sukses di upload";
    
      //$query = "INSERT INTO arsip VALUES('$nama_file', '$_POST[deskripsi]', '$tgl_upload')";

      $query = "insert into arsip values (null, '$noSurat', '$kategori', '$judul', '$date $time', '$nama_file')";
                
      mysqli_query($kon, $query);
    }
    else{
      echo "File gagal di upload";
    }

  ///  $query = "insert into arsip values (null, '$noSurat', '1', '$judul', '$date $time', 'coba.pdf')";

  //  mysqli_query($kon, $query);
    
    echo "
      <script>
        alert('Data Berhasil Ditambahkan');
        document.location.href = 'index.php';
      </script>
    ";

  }

?>

<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <h3>Admin</h3>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">ARSIP SURAT</h1>
            <h3 class="welcome-sub-text">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan</h3>
            <h3 class="welcome-sub-text">klik "lihat" pada kolom aksi untuk menampilkan surat</h3>
          </li>
        </ul>
      </div>
      
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-category">Arsip</li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Arsip</span>
            </a>
          </li>
          <li class="nav-item nav-category">About</li>
                    <li class="nav-item">
            <a class="nav-link" href="pages/About/dropdowns.php">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">About</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div>
                  <form class="input-group mb-3" method="get" action="">
                    <input type="text" class="form-control-md" name="cari" placeholder="Cari Surat" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" type="button">Cari</button>
                    </div>
                  </form>
                </div>
              <div class="card">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Nomor Surat</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Waktu Pengerjaan</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        include "koneksi.php";
                        $query = mysqli_query($kon, 'SELECT * FROM arsip');

                        if(isset($_GET['cari'])){
                          $query = mysqli_query($kon, "SELECT * FROM arsip where judul LIKE '%". $_GET['cari']."%'" );


                        }

                        while ($data = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <th scope="row"> <?php echo $data['no_surat'] ?> </th>
                        <td> <?php echo $data['kategori'] ?></td>
                        <td> <?php echo $data['judul'] ?></td>
                        <td> <?php echo $data['waktu'] ?></td>
                        <td>
                          <a href='pages/CRUD/delete.php?id_arsip=<?php echo $data['id_arsip']; ?>' class="btn btn-danger"  onclick="return confirm('Apakah anda ingin menghapus data?');">Hapus</a>
                          <a href='pages/CRUD/download.php?surat=<?php echo $data['surat']; ?>'class="btn btn-warning"> Unduh </a>
                          <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalShow<?php echo $data['id_arsip']; ?>"> Lihat </button>
                          <div class="modal fade" id="modalShow<?php echo $data['id_arsip']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Lihat Arsip Surat</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4> Nomor         : <?php echo $data['no_surat']; ?> </h4>
        <h4> Kategori      : <?php echo $data['kategori']; ?> </h4>
        <h4> Judul         : <?php echo $data['judul']; ?> </h4>
        <h4 class="mb-3" > Waktu Unggah  : <?php echo $data['waktu']; ?> </h4>

        <iframe src="upload/<?php echo $data['surat'] ?>" frameborder="0" height="500" width="100%">
</iframe>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                  <div>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-5 p-4">

              <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Tambahkan Arsip
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Arsip</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data" >
          <div class="mb-3">
            <label for="noSurat">Nomor Surat</label>
            <input type="text" name="noSurat" id="noSurat" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="kategori">Kategori</label>
            <select class="form-select" aria-label="Default select example" name="kategori" required>
              <option value="Surat">Surat</option>
              <option value="Dokumen">Dokumen</option>
              <option value="Sertifikat">Sertifikat</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="Judul">Judul</label>
            <input type="text" name="Judul" id="Judul" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="fie">File</label>
            <input type="file" name="surat" id="file" class="form-control-md" required accept="application/pdf" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->

</body>

</html>

