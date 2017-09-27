<div class="container">

	<h1>Buku Telepon</h1>

	<a href="/home/tambah"><button class="btn btn-primary">Tambah</button></a>

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
		<?php for($i=0;$i<count($data); ++$i): ?>
			<tr>
				<td><?php echo $i+1; ?></td>
				<td><?php echo $data[$i]['nama']; ?></td>
				<td><?php echo $data[$i]['nohp']; ?></td>
				<td>
					<a href="/home/edit/<?php echo $data[$i]['id'];?>"><button class="btn btn-success">Edit</button></a>
					<a href="/home/delete/<?php echo $data[$i]['id'];?>"><button class="btn btn-danger">Hapus</button></a>
				</td>
			</tr>
		<?php endfor; ?>
		</tbody>
	</table>
</div>