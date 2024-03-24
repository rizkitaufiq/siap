<?php
include"../system/koneksi.php";

session_start();
if($_SESSION['level'] !="admin" || $_SESSION['status'] !="login"){
    header('location:index.php');
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Administrator</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="../css/administrator.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="../css/lines.css" rel='stylesheet' type='text/css' />
<link href="../css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Nav CSS -->
<link href="../css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<script src="../js/custom.js"></script>
<!-- Graph JavaScript -->
<script src="../js/d3.v3.js"></script>
<script src="../js/rickshaw.js"></script>
</head>
<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Sistem Informasi Arsip Perpustakaan</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
                <button style="margin-top: 15%" class="m_2"><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></button>
            </ul>
            
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="administrator.php"><i class="fa fa-dashboard fa-fw nav_icon"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book nav_icon"></i>Jenis Koleksi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="koleksiKP.php">Arsip KP</a>
                                    <a href="koleksiTA.php">Arsip TA</a>
                                    <a href="koleksiEBOOK.php">E-Book</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href="graphs.html"><i class="fa fa-book nav-icon"></i> Pustakawan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="koleksikpPUS.php"><i class="fa fa-min nav-icon"></i> Arsip KP</a>
                                        <a href="koleksitaPUS.php"><i class="fa fa-min nav-icon"></i> Arsip TA</a>
                                        <a href="koleksiebookPUS.php"><i class="fa fa-min nav-icon"></i> EBOOK</a>
                                </li>   
                            </ul>
                        </li>
                        <li>
                            <a href="pengguna.php"><i class="fa fa-user nav_icon"></i>Pengguna</a>                
                        </li>
                        
                        <li>
                            <a href="saran.php"><i class="fa fa-comment nav_icon"></i>Saran</a> 
                        </li>    
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

    <div id="page-wrapper">
        <div class="graphs">
            <div class="col_3">
                <div class="container">
    <h2 style="margin-left: 43%">E-BOOK</h2>
                </div>
                <ul class="nav nav-tabs">
            <li class="active"><a href="reportEBOOKHarian.php">Laporan Harian</a></li>
            <li><a href="reportEBOOKBulanan.php">Laporan Bulanan</a></li>
            <li><a href="reportEbookTahunan.php">Laporan Tahunan</a></li>
        </ul>
            <div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
        <div class="col-md-6">
                <a href="cetakEH.php"><button type="button" name="tambah" class="btn-primary btn" style="margin-left: -5%"> Cetak</button></a>
            </div>
            <br><br>
           <table class="table">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama</th>
                  <th>Jurusan</th>
                  <th>Judul</th>
                  <th>Waktu</th>
                </tr>
              </thead>
              <tbody>
        <?php
        $halaman = 5;
        $page    = isset($_GET["halaman"])?(int)$_GET["halaman"]:1;
        $mulai   = ($page>1) ? ($page * $halaman) - $halaman : 0;
        $result  = mysqli_query($con,"SELECT * FROM log JOIN user ON log.id_user=user.id JOIN koleksiebook ON log.id_koleksi=koleksiebook.id_koleksiEBOOK");
        $total   = mysqli_num_rows($result);
        $pages   = ceil($total/$halaman);
        $query   = mysqli_query($con,"SELECT * FROM log JOIN user ON log.id_user=user.id JOIN koleksiebook ON koleksiebook.id_koleksiEBOOK=log.id_koleksi ORDER BY waktu DESC LIMIT $mulai, $halaman");
        $no      = $mulai+0;

        while($hasil  = mysqli_fetch_array($query)){

                $no++;

                    echo "<tr>";
                    echo "<th scope='row'>".$no."</th>";
                    echo "<td>".$hasil['username']."</td>";
                    echo "<td>".$hasil['nama_user']."</td>";
                    echo "<td>".$hasil['judul']."</td>";
                    echo "<td>".$hasil['waktu']."</td>";
                }
                ?>
              </tbody>
            </table>
      
      <table>
          <tr>
              <td>
                  <button class="btn-default btn">Halaman</button>
                   <?php
        
            for ($i=1; $i<=$pages; $i++){
        ?>
            <a class="btn-default btn" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php }
        
        ?>
            </td>
        </tr>
      </table> 
        
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
$con -> close();
?>
