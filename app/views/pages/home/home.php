<div class="container">
	<div id="home">
		<h1>Buku Telepon</h1>

		<button class="btn btn-primary" onclick="tambahpage()">Tambah</button>

		<table class="table">
			<thead>
				<tr>
					<th>Nomor</th>
					<th>Nama</th>
					<th>Nomor HP</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<div id="tambah"></div>
	<div id="edit"></div>
</div>

<script>
	var setRow = (data)=>{
		var tbodycontent = '';
		if(data.length <= 0){
			$('thead').addClass('hidden-sm-up hidden-md-up hidden-lg-up')
			$('#home').html($('#home').html()+'<h4 class="text-center text-danger" id="alertkosong">Kontak Kosong</h4>')
			$('tbody').html('')
		}
		else{
			$('thead').removeClass('hidden-sm-up')
			$('thead').removeClass('hidden-md-up')
			$('thead').removeClass('hidden-lg-up')
			$('#alertkosong').remove()
			for(var i=0;i<data.length;++i){
				tbodycontent += '<tr>'
				tbodycontent += '<td>'+(i+1)+'</td>'
				tbodycontent += '<td>'+data[i].nama+'</td>'
				tbodycontent += '<td>'+data[i].nohp+'</td>'
				tbodycontent += `<td>
									<button class="btn btn-success" onclick="editpage(${data[i].id})">Edit</button>
									<button class="btn btn-danger" onclick="hapus(${data[i].id})">Hapus</button>
								</td>`
				tbodycontent += '</tr>'
			}
			$('tbody').html(tbodycontent)
		}
	}
	var getData = () => {
		$.ajax({
			url:'/home/getkontaks',
		})
		.done((kontaks)=>{
			setRow(JSON.parse(kontaks))
		})
	}
	getData()
	var tambahpage = () => {
		$('#home').addClass('hidden-sm-up hidden-md-up hidden-lg-up')
		$('#tambah').removeClass('hidden-sm-up')
		$('#tambah').removeClass('hidden-md-up')
		$('#tambah').removeClass('hidden-lg-up')
		$.ajax({
			url:'/home/tambah/',
		})
		.done((data)=>{
			$('#tambah').html(data)
		})
	}
	var editpage = (id) => {
		$('#home').addClass('hidden-sm-up hidden-md-up hidden-lg-up')
		$('#edit').removeClass('hidden-sm-up')
		$('#edit').removeClass('hidden-md-up')
		$('#edit').removeClass('hidden-lg-up')
		$.ajax({
			url:'/home/edit/'+id,
		})
		.done((data)=>{
			$('#edit').html(data)
		})
	}
	var hapus = (id) => {
		$.ajax({
			url:'/home/delete/'+id,
		})
		.done(()=>{
			getData()
		})
	}
</script>