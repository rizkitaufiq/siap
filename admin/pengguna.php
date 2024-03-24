<?php
include"../system/koneksi.php";
include"../pagination2.php";

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
                            <a href="#"><i class="fa fa-bookmark nav-icon"></i> Pustakawan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="koleksikpPUS.php"><i class="fa fa-min nav-icon"></i> Arsip KP</a>
                                        <a href="koleksitaPUS.php"><i class="fa fa-min nav-icon"></i> Arsip TA</a>
                                        <a href="koleksiebookPUS.php"><i class="fa fa-min nav-icon"></i> E-Book</a>
                                </li>   
                            </ul>
                        </li>
                        <li>
                            <a href="pengguna.php"><i class="fa fa-user nav_icon"></i>Pengguna</a>                
                        </li>
                        <li>
                            <a href="saran.php"><i class="fa fa-comment nav_icon"></i>Saran</a>
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
     		<h1 style="margin-left: 43%">PENGGUNA</h1>
     		<div class="bs-example4" data-example-id="simple-responsive-table">
    <div class="table-responsive">
        <div class="row">
            <div class="col-md-6">
                <button type="button" name="tambah" data-toggle="modal" data-target="#tambahmodal" class="btn-primary btn">+ Tambah</button>
            </div>
            <div class="col-md-6">
                <div class="search pull-right">
                    <form action="pengguna.php" method="GET">
                        <input type="text" value="" name="cari" placeholder="Cari">
                    </form>
                    <?php
                        if(isset($_GET['cari'])){
                            $cari = $_GET['cari'];
                        }
                    ?>
                </div>
            </div>
        </div>
        <br><br>
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nim</th>
            <th>Jurusan</th>
            <th style="width: 3%;">Lihat</th>
            <th style="width: 3%">Edit</th>
            <th style="width: 3%">Hapus</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1; 
                $adjacents = isset($_GET['adjacents']) ? intval($_GET['adjacents']) : 3; 
                    $rpp = 5; 
                    if(isset($_REQUEST['cari']) && $_REQUEST['cari']<>""){
                        $cari = isset($_REQUEST['cari']) ? urldecode($_REQUEST['cari']) : ''; 
                        $lihat = mysqli_query($con, "SELECT * FROM user WHERE username LIKE '%$cari%' OR password LIKE '%$cari%' OR nama_user LIKE '%$cari%' ORDER BY username ASC"); 
                        $reload = $_SERVER['PHP_SELF'] . "?cari=".$cari."&amp;adjacents=".$adjacents; 
                    } else{
                        $lihat = mysqli_query($con, "SELECT * FROM user WHERE level='anggota' OR level='non anggota' ORDER BY username ASC"); 
                        $reload = $_SERVER['PHP_SELF']."?adjacents=".$adjacents; 
                    }
                    $tcount = mysqli_num_rows($lihat); 
                    $tpages = isset($tcount) ? ceil($tcount / $rpp) : 1; 
                    $count = 0; 
                    $i = ($page - 1) * $rpp; 
                    $mulai = ($page>1) ? ($page * $rpp) - $rpp: 0;
                    $no = $mulai+0;
                    while (($count<$rpp) && ($i<$tcount)){
                            mysqli_data_seek($lihat, $i);
                            $hasil = mysqli_fetch_array($lihat);
                            $no++;
                echo "<tr>";
                echo "<td scope='row'>".$no."</td>";
                echo "<td>".$hasil['username']."</td>";
                echo "<td>".$hasil['password']."</td>";
                echo "<td>".$hasil['nama_user']."</td>";
                echo "<td><button name='lihat' data-id='".$hasil['id']."' data-toggle='modal' data-target='#lihat' class='btn-succes btn fa fa-eye' ></button></td>";
                echo "<td><button name='edit' data-id='".$hasil['id']."' data-toggle='modal' data-target='#edit' class='btn-primary btn fa fa-pencil'></button></td>";
                echo "<td><button name='hapus' data-id='".$hasil['id']."' data-toggle='modal' data-target='#hapus' class='btn-danger btn fa fa-trash-o'></button></td>";
            echo "</tr>";
            $i++;
            $count++;
            }
        ?>
        </tbody>
    </table>
<?php
     echo"<table>";
                        echo "<tr>";
                            echo "<td>";
                            echo "<a class='btn btn-default'>Halaman</a>";
                            echo "</td>";
                            echo "<td style='width: 3%;'>";
                            echo "</td>";
                            echo "<td>";
                            echo paginate_two($reload, $page, $tpages, $adjacents);
                            echo "</td>";
                        echo "</tr>";
                    echo"</table>";
?>

    <div class="modal fade" id="tambahmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h1 style="text-align: center;">Isi Arsip KP</h1>
                </div>
            <div class="modal-body">
                <form method="post" id="insert_form" action="tambahPENGGUNA.php">
                    <label>Masukan Nama</label>
                    <input type="text" name="username" class="form-control1" required="">
                    <br><br>
                    <label>Masukan Nim</label>
                    <input type="text" name="password" class="form-control1" required="">
                    <br><br>
                    <label>Jurusan</label>
                    <select style="margin-left: 5%;" class="btn-primary btn" name="nama_user">
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Geologi">Teknik Geologi</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Teknik Industri">Teknik Industri</option>
                        <option value="Teknik Industri">Non Anggota</option>
                    </select> 
                    <br><br>
                    <label>Status</label>
                    <select style="margin-left: 7%;" class="btn-primary btn" name="level">
                        <option value="Anggota">  Anggota</option>
                        <option value="Non Anggota">  Non Anggota</option>
                    </select>
                    <br><br>
                    <div class="modal-footer">
                        <input  type="submit" class="btn-danger btn" data-dismiss="modal" value="Batal">
                        <input  type="submit" name="simpan" id="insert" value="Tambah" class="btn-primary btn"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
               
            </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="lihat">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="text-align: center;" class="modal-title">Lihat Pengguna</h4>
                </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
    
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="text-align: center;" class="modal-title">Pengguna</h4>
                </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="text-align: center;" class="modal-title">Yakin Hapus Data Arsip Ini ?</h4>
                </div>
            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-primary btn" data-dismiss="modal">Batal</button>
            </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function(){
            $('#lihat').on('show.bs.modal', function (e){
                var rowid = $(e.relatedTarget).data('id');

                $.ajax({
                    type   : 'POST',
                    url    : 'lihat_pengguna.php',
                    data   : 'rowid= ' + rowid,
                    success: function(data){
                        $('.fetched-data').html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#edit').on('show.bs.modal', function (e){
                var rowid = $(e.relatedTarget).data('id');

                $.ajax({
                    type   : 'POST',
                    url    : 'edit_daftarpengguna.php',
                    data   : 'rowid= ' + rowid,
                    success: function(data){
                        $('.fetched-data').html(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#hapus').on('show.bs.modal', function (e){
                var rowid = $(e.relatedTarget).data('id');

                $.ajax({
                    type   : 'POST',
                    url    : 'hapus_daftarpengguna.php',
                    data   : 'rowid= ' + rowid,
                    success: function(data){
                        $('.fetched-data').html(data);
                    }
                });
            });
        });
    </script>
    
     
       	
      
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
$con -> close();
?>
