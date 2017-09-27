<div class="container jumbotron">
	<form action="/home/editsave" method="POST">
		<input type="text" required="required" class="form-control" name="id" value="<?= $id; ?>" hidden/>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" required="required" class="form-control" name="nama" value="<?= $nama; ?>" />
		</div>
		<div class="form-group">
			<label>Nomor HP</label>
			<input type="text" required="required" class="form-control" name="nohp" value="<?= $nohp; ?>" />
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
	</form>
</div>