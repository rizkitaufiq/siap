<?php
 include '../system/koneksi.php'

?>

<?php
if($_POST['rowid']){
 	$id = $_POST['rowid'];

 	$sql = "SELECT * FROM tmp_koleksita WHERE id_tmpkoleksita = $id";
 	$result = $con->query($sql);
 	foreach ($result as $lihat){ ?>


    <form method="post" action="hapusTApus1.php">
        <?php echo "<input type='hidden' name='id' value='".$lihat['id_tmpkoleksita']."'>"?>
        <table class="table">
 		<tbody>
 			<tr>
 				<td>Judul</td>
 				<td><?php echo $lihat['judul'];?></td>
 			</tr>
 			<tr>
 				<td>Penulis</td>
 				<td><?php echo $lihat['penulis'];?></td>
 			</tr>
 			<tr>
 				<td>Nim</td>
 				<td><?php echo $lihat['nim'];?></td>
 			</tr>
 			<tr>
 				<td>Jurusan</td>
 				<td><?php echo $lihat['jurusan'];?></td>
 			</tr>
 			<tr>
 				<td>Dosen Pembimbing I</td>
 				<td><?php echo $lihat['dosbimTA'];?></td>
 			</tr>
 			<tr>
 				<td>Dosen Pembimbing II</td>
 				<td><?php echo $lihat['dosbimTA1'];?></td>
 			</tr>
 			<tr>
 				<td>Subjek</td>
 				<td><?php echo $lihat['subjek'];?></td>
 			</tr>
 			<tr>
 				<td>Barcode</td>
 				<td><?php echo $lihat['barcode'];?></td>
 			</tr>
 			<tr>
 				<td>Acc Nomer</td>
 				<td><?php echo $lihat['accno'];?></td>
 				<br>
 			</tr>
 			<tr>
 				<br>
 				<td>
 					<input type="submit" name="edit" id="delete" value="Hapus" class="btn-danger btn"></td>
 			</tr>
 		</tbody>
 	</table>
    </form>
	<?php
 	}
}



