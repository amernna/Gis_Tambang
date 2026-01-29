<div class="content">
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Detail Data Area Tambang</h3>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-sm-7">
					<!-- peta -->
					<div id="map" style="width: 100%; height: 600px;"></div>
					<!-- end peta -->
				</div>

				<div class="col-sm-5">
					<table class="table table-bordered">
						<tr>
							<th>Nama Tambang</th>
							<td><?= $tambang['nama_tambang'] ?></td>
						</tr>
						<tr>
							<th>Luas Area</th>
							<td><?= $tambang['luas_area'] ?></td>
						</tr>
						<tr>
							<th>Jenis Tambang</th>
							<td><?= $tambang['jenis_tambang'] ?></td>
						</tr>
						<tr>
							<th>Pemilik Area</th>
							<td><?= $tambang['pemilik_area'] ?></td>
						</tr>
						<tr>
							<th>Alamat Pemilik</th>
							<td><?= $tambang['alamat_pemilik'] ?></td>
						</tr>
						<tr>
							<th>Sumber Daya</th>
							<td><?= $tambang['sumber_daya'] ?></td>
						</tr>
						<tr>
							<th>Tanggal Dibuat</th>
							<td><?= $tambang['tanggal_dibuat'] ?></td>
						</tr>
						<tr>
							<th>Status</th>
							<td><?= $tambang['status'] ?></td>
						</tr>
						<?php if (!empty($tambang['gambar'])): ?>
							<tr>
								<th>Gambar</th>
								<td>
									<img src="<?= base_url('gambar/' . $tambang['gambar']) ?>" width="200px">
								</td>
							</tr>
						<?php endif; ?>
					</table>
					<a href="<?= base_url('tambang/edit/' . $tambang['id_tambang']) ?>" class="btn btn-warning">Edit</a>
					<a href="<?= base_url('tambang/delete/' . $tambang['id_tambang']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
				</div>
			</div>

			<script>
				var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
						'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
					id: 'mapbox/streets-v11'
				});

				var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
						'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
					id: 'mapbox/satellite-v9'
				});

				var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
				});

				var map = L.map('map', {
					center: [-0.30143100741789675, 100.73905917099766],
					zoom: 13,
					layers: [peta3]
				});

				var baseLayers = {
					"Grayscale": peta1,
					"Satelite": peta2,
					"Streets": peta3
				};

				L.control.layers(baseLayers).addTo(map);

				// Add GeoJSON layer
				var drawnItems = new L.geoJSON(<?= $tambang['denah_geojson'] ?>);
				map.addLayer(drawnItems);

				// Fit map to GeoJSON bounds
				map.fitBounds(drawnItems.getBounds());
			</script>
		</div>
	</div>
</div>