<div class="jumbotron">
	<form>
		<input type="text" required="required" class="form-control" id="id" value="<?= $id; ?>" hidden/>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" required="required" class="form-control" id="nama" value="<?= $nama; ?>" />
		</div>
		<div class="form-group">
			<label>Nomor HP</label>
			<input type="text" class="form-control" id="nohp" value="<?= $nohp; ?>" />
		</div>
		<input type="button" class="btn btn-danger" onclick="gohome()" value="Batal"/>
		<input type="submit" class="btn btn-primary" onclick="simpan(); return false;" value="Simpan"/>
	</form>
</div>

<script>
	var gohome = () =>{
		$('#edit').addClass('hidden-sm-up hidden-md-up hidden-lg-up')
		$('#home').removeClass('hidden-sm-up')
		$('#home').removeClass('hidden-md-up')
		$('#home').removeClass('hidden-lg-up')
	}
	var simpan = () => {
		let id = $('#id').val()
		let nama = $('#nama').val()
		let nohp = $('#nohp').val()
		$.ajax({
			url:'/home/editsave?id='+id+'&nama='+nama+'&nohp='+nohp
		})
		.done(()=>{
			gohome()
			getData()
		})
	}
</script>