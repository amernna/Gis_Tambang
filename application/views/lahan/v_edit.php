<div class="content">
	<!-- general form elements -->
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Edit Data Area Tambang</h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<div class="card-body">
			<div class="row">
				<div class="col-sm-7">
					<!-- peta -->
					<div id="map" style="width: 100%; height: 600px;"></div>
					<!-- end peta -->
				</div>

				<div class="col-sm-5">
					<?php
					//notifikasi pesan validasi
					echo validation_errors('<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-ban"></i> ', '</div>');

					//notifikasi gagal upload
					if (isset($error_upload)) {
						echo '<div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-exclamation-triangle"></i> ' . $error_upload . '</div>';
					}

					echo form_open_multipart('tambang/edit/' . $tambang['id_tambang']); ?>

					<div class="form-group">
						<label>Nama Area Tambang</label>
						<input type="text" name="nama_area" class="form-control" placeholder="Nama Area Tambang" value="<?= $tambang['nama_tambang'] ?>">
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Luas Area</label>
								<input type="text" name="luas_area" class="form-control" placeholder="Luas Area" value="<?= $tambang['luas_area'] ?>">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Jenis Tambang</label>
								<select name="jenis_tambang" class="form-control">
									<option value="<?= $tambang['jenis_tambang'] ?>"><?= $tambang['jenis_tambang'] ?></option>
									<option value="Doromit">Doromit</option>
									<option value="Split">Split</option>
									<option value="Marmer">Marmer</option>
									<option value="Pasir">Pasir</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Pemilik Area</label>
						<input type="text" name="pemilik_area" class="form-control" placeholder="Pemilik Area" value="<?= $tambang['pemilik_area'] ?>">
					</div>

					<div class="form-group">
						<label>Alamat Pemilik</label>
						<input type="text" name="alamat_pemilik" class="form-control" placeholder="Alamat Pemilik" value="<?= $tambang['alamat_pemilik'] ?>">
					</div>

					<div class="form-group">
						<label>Denah GeoJSON</label>
						<textarea name="denah_geojson" rows="4" class="form-control"><?= $tambang['denah_geojson'] ?></textarea>
					</div>

					<div class="row">
						<?php if (!empty($tambang['gambar'])): ?>
							<div class="col-sm-12 mb-3">
								<img src="<?= base_url('gambar/' . $tambang['gambar']) ?>" width="200px">
							</div>
						<?php endif; ?>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Warna Denah</label>
								<div class="input-group my-colorpicker2">
									<input type="text" name="warna" class="form-control" value="<?= $tambang['warna'] ?>">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-square"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Ganti Gambar</label>
								<input type="file" name="gambar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Sumber Daya</label>
						<input type="text" name="sumber_daya" class="form-control" placeholder="Sumber Daya" value="<?= $tambang['sumber_daya'] ?>">
					</div>

					<div class="form-group">
						<label>Tanggal Dibuat</label>
						<input type="date" name="tanggal_dibuat" class="form-control" value="<?= $tambang['tanggal_dibuat'] ?>">
					</div>

					<div class="form-group">
						<label>Status</label>
						<select name="status" class="form-control">
							<option value="<?= $tambang['status'] ?>"><?= $tambang['status'] ?></option>
							<option value="Aktif">Aktif</option>
							<option value="Tidak Aktif">Tidak Aktif</option>
						</select>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="reset" class="btn btn-warning">Reset</button>
					</div>

					<?php echo form_close(); ?>

				</div>
			</div>

			<script>
				var gruplahan = L.layerGroup();
				var grupirigasi = L.layerGroup();
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
					layers: [peta3, gruplahan, grupirigasi]
				});

				var baseLayers = {
					"Grayscale": peta1,
					"Satelite": peta2,
					"Streets": peta3
				};

				var overlays = {
					"Lahan": gruplahan,
					"Irigasi": grupirigasi,
				};

				L.control.layers(baseLayers, overlays).addTo(map);

				// FeatureGroup is to store editable layers
				var drawnItems = new L.geoJSON(<?= $tambang['denah_geojson'] ?>);
				map.addLayer(drawnItems);
				var drawControl = new L.Control.Draw({
					draw: {
						polygon: true,
						marker: false,
						circle: false,
						circlemarker: false,
						rectangle: false,
						polyline: false,
					},
					edit: {
						featureGroup: drawnItems
					}
				});
				map.addControl(drawControl);

				//membuat draw
				map.on('draw:created', function(event) {
					var layer = event.layer;
					var feature = layer.feature = layer.feature || {};
					feature.type = feature.type || "Feature";
					var props = feature.properties = feature.properties || {};
					drawnItems.addLayer(layer);
					$("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
				});

				//edit draw
				map.on('draw:edited', function(e) {
					$("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
				});

				//delete draw
				map.on('draw:deleted', function(e) {
					$("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
				});

				map.fitBounds(drawnItems.getBounds());
			</script>

			<script>
				$(function() {
					//color picker with addon
					$('.my-colorpicker2').colorpicker()

					$('.my-colorpicker2').on('colorpickerChange', function(event) {
						$('.my-colorpicker2 .fa-square').css('color', event.color.toString());
					});
				})
			</script>
		</div>
	</div>
</div>