<div class="container jumbotron">
	<form>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" id="nama" required="required">
		</div>
		<div class="form-group">
			<label>Nomor HP</label>
			<input type="text" class="form-control" id="nohp">
		</div>
		<input type="button" class="btn btn-danger" onclick="gohome()" value="Batal"/>
		<button type="submit" class="btn btn-primary" onclick="tambah(); return false;">Tambah</button>
	</form>
</div>

<script>
	var gohome = () =>{
		$('#tambah').addClass('hidden-sm-up hidden-md-up hidden-lg-up')
		$('#home').removeClass('hidden-sm-up')
		$('#home').removeClass('hidden-md-up')
		$('#home').removeClass('hidden-lg-up')
	}
	var tambah = () => {
		let nama = $('#nama').val()
		let nohp = $('#nohp').val()
		$.ajax({
			url:'/home/tambahsave?nama='+nama+'&nohp='+nohp,
		})
		.done(()=>{
			getData()
			gohome()
		})
	}
</script>