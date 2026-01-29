<div class="content">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Edit Aktivitas Tambang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('aktivitas') ?>">Aktivitas Tambang</a></li>
						<li class="breadcrumb-item active">Edit Aktivitas</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<div class="content">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Form Edit Aktivitas Tambang</h3>
			</div>
			<div class="card-body">
				<?= form_open('aktivitas/edit/' . $aktivitas['id_aktivitas']) ?>
				<div class="form-group">
					<label>Tambang</label>
					<select name="id_tambang" class="form-control">
						<option value="">Pilih Tambang</option>
						<?php foreach ($tambang as $row) { ?>
							<option value="<?= $row['id_tambang'] ?>"
								<?= $row['id_tambang'] == $aktivitas['id_tambang'] ? 'selected' : '' ?>>
								<?= $row['nama_tambang'] ?>
							</option>
						<?php } ?>
					</select>
					<?= form_error('id_tambang', '<small class="text-danger">', '</small>') ?>
				</div>
				<div class="form-group">
					<label>Tanggal</label>
					<input type="date" name="tanggal" class="form-control"
						value="<?= $aktivitas['tanggal'] ?>">
					<?= form_error('tanggal', '<small class="text-danger">', '</small>') ?>
				</div>
				<div class="form-group">
					<label>Deskripsi Aktivitas</label>
					<textarea name="deskripsi_aktivitas" class="form-control" rows="4"><?= $aktivitas['deskripsi_aktivitas'] ?></textarea>
					<?= form_error('deskripsi_aktivitas', '<small class="text-danger">', '</small>') ?>
				</div>
				<div class="form-group">
					<label>Dibuat Oleh</label>
					<input type="text" name="dibuat_oleh" class="form-control"
						value="<?= $aktivitas['dibuat_oleh'] ?>">
					<?= form_error('dibuat_oleh', '<small class="text-danger">', '</small>') ?>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Update</button>
					<a href="<?= base_url('aktivitas') ?>" class="btn btn-secondary">Kembali</a>
				</div>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>