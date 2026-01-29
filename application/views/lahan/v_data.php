<div class="content">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Data Tambang</h3>
			<div class="card-tools">
				<a href="<?= base_url('tambang/add') ?>" class="btn btn-sm btn-success">
					<i class="fas fa-plus"></i> Tambah Data
				</a>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="datatable">
					<thead>
						<tr>
							<th>No</th>
							<th>Gambar</th>
							<th>Nama Tambang</th>
							<th>Jenis Tambang</th>
							<th>Luas Area</th>
							<th>Pemilik</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($tambang as $key => $value) { ?>
							<tr>
								<td><?= $no++ ?></td>
								<td>
									<?php if (!empty($value['gambar'])): ?>
										<img src="<?= base_url('gambar/' . $value['gambar']) ?>"
											style="width: 100px; height: 100px; object-fit: cover;"
											class="img-thumbnail"
											data-toggle="modal"
											data-target="#imageModal<?= $value['id_tambang'] ?>">
									<?php else: ?>
										<span class="badge bg-secondary">Tidak ada gambar</span>
									<?php endif; ?>
								</td>
								<td><?= $value['nama_tambang'] ?></td>
								<td><?= $value['jenis_tambang'] ?></td>
								<td><?= $value['luas_area'] ?> m²</td>
								<td><?= $value['pemilik_area'] ?></td>
								<td>
									<?php
									if ($value['status'] == 'Aktif') {
										echo '<span class="badge bg-success">Aktif</span>';
									} else {
										echo '<span class="badge bg-danger">Tidak Aktif</span>';
									}
									?>
								</td>
								<td>
									<div class="btn-group" role="group">
										<a href="<?= base_url('tambang/detail/' . $value['id_tambang']) ?>" class="btn btn-sm btn-info" title="Detail">
											<i class="fas fa-eye"></i>
										</a>
										<a href="<?= base_url('tambang/edit/' . $value['id_tambang']) ?>" class="btn btn-sm btn-warning" title="Edit">
											<i class="fas fa-edit"></i>
										</a>
										<a href="<?= base_url('tambang/delete/' . $value['id_tambang']) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
											<i class="fas fa-trash"></i>
										</a>
									</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Image Modal -->
	<?php foreach ($tambang as $key => $value) {
		if (!empty($value['gambar'])):
	?>
			<div class="modal fade" id="imageModal<?= $value['id_tambang'] ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel<?= $value['id_tambang'] ?>" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="imageModalLabel<?= $value['id_tambang'] ?>">Gambar <?= $value['nama_tambang'] ?></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-center">
							<img src="<?= base_url('gambar/' . $value['gambar']) ?>" class="img-fluid" alt="Gambar Tambang">
						</div>
					</div>
				</div>
			</div>
	<?php endif;
	} ?>
</div>

<script>
	$(document).ready(function() {
		$('#datatable').DataTable({
			"responsive": true,
			"autoWidth": false,
			"ordering": true,
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "Semua"]
			]
		});
	});
</script>