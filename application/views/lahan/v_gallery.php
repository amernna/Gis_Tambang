<div class="content">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Galeri Tambang</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<?php foreach ($tambang as $key => $value) { ?>
					<div class="col-md-4 mb-4">
						<div class="card">
							<?php if (!empty($value['gambar'])): ?>
								<img src="<?= base_url('gambar/' . $value['gambar']) ?>"
									class="card-img-top"
									style="height: 250px; object-fit: cover;"
									alt="<?= $value['nama_tambang'] ?>">
							<?php else: ?>
								<div class="card-img-top bg-secondary d-flex justify-content-center align-items-center" style="height: 250px;">
									<span class="text-white">Tidak ada gambar</span>
								</div>
							<?php endif; ?>

							<div class="card-body">
								<h5 class="card-title"><?= $value['nama_tambang'] ?></h5>
								<p class="card-text">
									<strong>Jenis:</strong> <?= $value['jenis_tambang'] ?><br>
									<strong>Luas:</strong> <?= $value['luas_area'] ?> m²<br>
									<strong>Status:</strong>
									<?php
									if ($value['status'] == 'Aktif') {
										echo '<span class="badge bg-success">Aktif</span>';
									} else {
										echo '<span class="badge bg-danger">Tidak Aktif</span>';
									}
									?>
								</p>
								<div class="btn-group" role="group">
									<a href="<?= base_url('tambang/detail/' . $value['id_tambang']) ?>" class="btn btn-sm btn-info mr-1" title="Detail">
										<i class="fas fa-eye"></i>
									</a>
									<a href="<?= base_url('tambang/edit/' . $value['id_tambang']) ?>" class="btn btn-sm btn-warning mr-1" title="Edit">
										<i class="fas fa-edit"></i>
									</a>
									<a href="<?= base_url('tambang/delete/' . $value['id_tambang']) ?>" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
										<i class="fas fa-trash"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>

			<!-- Lightbox Modal -->
			<?php foreach ($tambang as $key => $value) {
				if (!empty($value['gambar'])):
			?>
					<div class="modal fade" id="lightboxModal<?= $value['id_tambang'] ?>" tabindex="-1" role="dialog">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"><?= $value['nama_tambang'] ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body text-center">
									<img src="<?= base_url('gambar/' . $value['gambar']) ?>" class="img-fluid" alt="Gambar Tambang">
									<div class="mt-3">
										<strong>Jenis Tambang:</strong> <?= $value['jenis_tambang'] ?><br>
										<strong>Luas Area:</strong> <?= $value['luas_area'] ?> m²<br>
										<strong>Pemilik:</strong> <?= $value['pemilik_area'] ?>
									</div>
								</div>
							</div>
						</div>
					</div>
			<?php endif;
			} ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// Enable lightbox on image click
		$('.card-img-top').on('click', function() {
			var modalId = $(this).closest('.card').find('[data-target]').data('target');
			$(modalId).modal('show');
		});
	});
</script>