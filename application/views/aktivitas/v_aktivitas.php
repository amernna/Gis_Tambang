<div class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Aktivitas Tambang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
						<li class="breadcrumb-item active">Aktivitas Tambang</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Daftar Aktivitas Tambang</h3>
				<div class="card-tools">
					<a href="<?= base_url('aktivitas/add') ?>" class="btn btn-primary btn-sm">Tambah Aktivitas</a>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID Tambang</th>
							<th>Tanggal</th>
							<th>Deskripsi Aktivitas</th>
							<th>Dibuat Oleh</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($aktivitas as $row) { ?>
							<tr>
								<td><?= $row['id_tambang'] ?></td>
								<td><?= $row['tanggal'] ?></td>
								<td><?= $row['deskripsi_aktivitas'] ?></td>
								<td><?= $row['dibuat_oleh'] ?></td>
								<td>
									<a href="<?= base_url('aktivitas/edit/' . $row['id_aktivitas']) ?>" class="btn btn-info btn-sm">Edit</a>
									<a href="<?= base_url('aktivitas/delete/' . $row['id_aktivitas']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus aktivitas ini?')">Hapus</a>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>