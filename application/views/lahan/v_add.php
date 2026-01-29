<div class="content">
	<!-- general form elements -->
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Input Data Area Tambang</h3>
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

					//notifikasi sukses simpan data
					if ($this->session->flashdata('sukses')) {
						echo '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="icon fas fa-check"></i> ';
						echo $this->session->flashdata('sukses');
						echo '</div>';
					}

					echo form_open_multipart('tambang/add'); ?>

					<div class="form-group">
						<label>Nama Area Tambang</label>
						<input type="text" name="nama_area" class="form-control" placeholder="Nama Area Tambang">
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Luas Area</label>
								<input type="text" name="luas_area" class="form-control" placeholder="Luas Area">
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Jenis Tambang</label>
								<select name="jenis_tambang" class="form-control">
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
						<input type="text" name="pemilik_area" class="form-control" placeholder="Pemilik Area">
					</div>

					<div class="form-group">
						<label>Alamat Pemilik</label>
						<input type="text" name="alamat_pemilik" class="form-control" placeholder="Alamat Pemilik">
					</div>

					<div class="form-group">
						<label>Denah GeoJSON</label>
						<textarea name="denah_geojson" rows="4" class="form-control"></textarea>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Warna Denah</label>
								<div class="input-group my-colorpicker2">
									<input type="text" name="warna" class="form-control">
									<div class="input-group-append">
										<span class="input-group-text"><i class="fas fa-square"></i></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Gambar</label>
								<input type="file" name="gambar" class="form-control">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>Sumber Daya</label>
						<input type="text" name="sumber_daya" class="form-control" placeholder="Sumber Daya">
					</div>

					<div class="form-group">
						<label>Tanggal Dibuat</label>
						<input type="date" name="tanggal_dibuat" class="form-control">
					</div>

					<div class="form-group">
						<label>Status</label>
						<select name="status" class="form-control">
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
				<!-- /.card -->
			</div>

			<script>
				var gruplahan = L.layerGroup();
				var grupirigasi = L.layerGroup();
				var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
						'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
						'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
					id: 'mapbox/streets-v11'
				});


				var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
					attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
						'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
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
				var drawnItems = new L.FeatureGroup();
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

				//edit draww
				map.on('draw:edited', function(e) {
					$("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
				});

				//delete draw
				map.on('draw:deleted', function(e) {
					$("[name=denah_geojson]").html(JSON.stringify(drawnItems.toGeoJSON()));
				});
			</script>

			<script>
				$(function() {
					//Initialize Select2 Elements
					$('.select2').select2()

					//Initialize Select2 Elements
					$('.select2bs4').select2({
						theme: 'bootstrap4'
					})

					//Datemask dd/mm/yyyy
					$('#datemask').inputmask('dd/mm/yyyy', {
						'placeholder': 'dd/mm/yyyy'
					})
					//Datemask2 mm/dd/yyyy
					$('#datemask2').inputmask('mm/dd/yyyy', {
						'placeholder': 'mm/dd/yyyy'
					})
					//Money Euro
					$('[data-mask]').inputmask()

					//Date range picker
					$('#reservation').daterangepicker()
					//Date range picker with time picker
					$('#reservationtime').daterangepicker({
						timePicker: true,
						timePickerIncrement: 30,
						locale: {
							format: 'MM/DD/YYYY hh:mm A'
						}
					})
					//Date range as a button
					$('#daterange-btn').daterangepicker({
							ranges: {
								'Today': [moment(), moment()],
								'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
								'Last 7 Days': [moment().subtract(6, 'days'), moment()],
								'Last 30 Days': [moment().subtract(29, 'days'), moment()],
								'This Month': [moment().startOf('month'), moment().endOf('month')],
								'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
							},
							startDate: moment().subtract(29, 'days'),
							endDate: moment()
						},
						function(start, end) {
							$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
						}
					)

					//Timepicker
					$('#timepicker').datetimepicker({
						format: 'LT'
					})

					//Bootstrap Duallistbox
					$('.duallistbox').bootstrapDualListbox()

					//Colorpicker
					$('.my-colorpicker1').colorpicker()
					//color picker with addon
					$('.my-colorpicker2').colorpicker()

					$('.my-colorpicker2').on('colorpickerChange', function(event) {
						$('.my-colorpicker2 .fa-square').css('color', event.color.toString());
					});

					$("input[data-bootstrap-switch]").each(function() {
						$(this).bootstrapSwitch('state', $(this).prop('checked'));
					});

				})
			</script>
		</div>
	</div>
</div>