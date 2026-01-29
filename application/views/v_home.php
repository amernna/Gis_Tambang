<div class="content">
	<div class="mt-4">
		<div class="row">
			<div class="col-md-4">
				<div class="shadow-sm card">
					<div class="text-white card-header bg-primary">
						<h3 class="card-title">Mining Area Overview</h3>
					</div>
					<div class="card-body">
						<ul class="list-group">
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Total Land Area
								<span class="badge bg-primary rounded-pill"><?= number_format($total_area, 2) ?> m²</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center">
								Number of Mining Plots
								<span class="badge bg-secondary rounded-pill"><?= $total_plots ?></span>
							</li>
						</ul>
					</div>
				</div>
				<div class="mt-3">
					<img src="<?= base_url() ?>template/dist/img/logo.png" class="img-fluid" alt="Mining Area Image">
				</div>
			</div>

			<div class="col-md-8">
				<div id="map" style="width: 100%; height: 600px; border: 2px solid #ddd; border-radius: 10px;"></div>
			</div>
		</div>
	</div>
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
		"Mining Areas": gruplahan,
		"Irrigated Lands": grupirigasi,
	};

	// Add mining areas to the map
	<?php foreach ($tambang as $area): ?>
		<?php if (!empty($area['denah_geojson'])): ?>
			var tambangArea = L.geoJSON(<?= $area['denah_geojson'] ?>, {
				style: {
					color: '<?= $area['warna'] ?>',
					fillColor: '<?= $area['warna'] ?>',
					fillOpacity: 0.5
				}
			}).bindPopup(`
				<b>Name: <?= $area['nama_tambang'] ?></b><br>
				Area Type: <?= $area['jenis_tambang'] ?><br>
				Owner: <?= $area['pemilik_area'] ?><br>
				Total Area: <?= $area['luas_area'] ?> m²
			`).addTo(gruplahan);
		<?php endif; ?>
	<?php endforeach; ?>

	L.control.layers(baseLayers, overlays).addTo(map);
</script>

<style>
	.card {
		border-radius: 10px;
	}

	.card-header {
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
	}

	.card-body {
		padding: 20px;
	}

	.list-group-item {
		border: none;
		border-bottom: 1px solid #ddd;
	}

	.list-group-item:last-child {
		border-bottom: none;
	}
</style>