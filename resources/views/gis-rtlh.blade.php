<x-app-layout>
  
  <x-slot name="title">
    Gis Rtlh
  </x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
            <a href="{{ url('/dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>GIS RTLH</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">GIS RTLH</div>
          </div>
      </div>

      <div class="section-body">
        <!-- <h2 class="section-title">Users</h2>
        <p class="section-lead">
          We use 'DataTables' made by @SpryMedia. You can check the full documentation <a href="https://datatables.net/">here</a>.
        </p> -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h4>Basic DataTables</h4>
              </div> -->
              <div class="card-body">
                <div id="mapid" style="height: 600px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal fade" id="featureModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="feature-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="feature-info"></div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div> -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('plugins/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.js') }}"></script>
    <script src="{{ asset('plugins/leaflet-groupedlayercontrol/example/exampledata.js') }}"></script>
    <script src="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/leaflet.markercluster.js') }}"></script>
    <script>
    $(function() {
      // banjarmasin = -3.317219,114.524172
      // var map = L.map('mapid').setView([-3.317219,114.524172], 13);

      var osmStreet = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaGFuYWZpMDciLCJhIjoiY2tubmNiY2N6MDV3ZDJvcGdrMXh3aTh3eSJ9.gHOs5sTl8lPwP-IzHYgH_g', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
      });

      var markerClusters = new L.MarkerClusterGroup({
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true,
        disableClusteringAtZoom: 17
      });

      var map = L.map(document.getElementById('mapid'), {
        zoom: 13,
        center: [-3.314771,114.6185566],
        layers: [osmStreet, markerClusters],
        zoomControl: false,
        attributionControl: false
      });

      var greenIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      var blueIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      let kelurahanLayer = L.geoJson(null);
      let Kelurahan = L.geoJson(null, {
        style: function (feature) {
          return {
            color: "#42a7f5",
            fill: true,
            fillOpacity: 0,
            opacity: 0.3,
            width: 0.01,
            clickable: false,
            riseOnHover: true
          };
        },

        onEachFeature: function (feature, layer) {
         
          layer.on({
            mouseover: function (e) {
              let layer = e.target;
              layer.setStyle({
                weight: 3,
                color: "#00FFFF",
                fillOpacity: 0.05,
                opacity: 1
              });

              if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
              }
            },
            mouseout: function (e) {
              Kelurahan.resetStyle(e.target);
            }
          });
        }
      });

      $.getJSON("{{ route('gis-kelurahan-geojson') }}", function ( response ) {
        Kelurahan.addData(response.data);
      });

      let kecamatanColors = {"Banjarmasin Barat":"#ffb400",
        "Banjarmasin Selatan":"#70a1d7",
        "Banjarmasin Tengah":"#a1de93",
        "Banjarmasin Timur":"#f47c7c",
        "Banjarmasin Utara":"#f7f48b"};
      
      let kecamatanLayer = L.geoJson(null);
      let Kecamatan = L.geoJson(null, {
        style: function (feature) {
          return {
            name: Kecamatan,
            color: "white",
            fillColor: kecamatanColors[feature.properties.KECAMATAN],
            fillOpacity: 0.7,
            opacity: 1,
            width: 1,
            dashArray: '3',
            clickable: true,
            riseOnHover: true
          };
        },

        onEachFeature: function (feature, layer) {

          if (feature.properties) {
              let content = "<table class='table table-sm table-striped table-bordered table-condensed'>" + "<tr><th>KODE KEC.</th><td>" + feature.properties.KODE_KEC +
              "<tr><th>LUAS (KM<sup>2</sup>)</th><td>" + feature.properties.LUAS +
              "</td></tr>" + "<tr><th>JUMLAH KELURAHAN</th><td>" + feature.properties.JUMLAH_KEL + 
              "</td></tr>" + "<tr><th>JUMLAH PENDUDUK (JIWA)</th><td>" + feature.properties.JUMLAH_JIWA + 
              "</td></tr>" + "<tr><th>KEPADATAN PENDUDUK (JIWA/KM<sup>2</sup>)</th><td>" + feature.properties.KEPADATAN + 
              // "</td></tr>" + "<tr><th>AKSES AMAN (%)</th><td>" + feature.properties.AKSES_AMAN + 
              // "</td></tr>" + "<tr><th>AKSES DASAR/CUBLUK (%)</th><td>" + feature.properties.AKSES_DASAR + 
              // "</td></tr>" + "<tr><th>TANPA AKSES/ PENGGUNA JAMBAN DI PINGGIR SUNGAI (%)</th><td>" + feature.properties.TANPA_AKSES + 
              "</td></tr>" +  "</td></tr>" + "<table>" ;

              layer.on({
                click: function (e) {
                  $("#feature-title").html(feature.properties.KECAMATAN);
                  $("#feature-info").html(content);
                  $("#featureModal").modal("show");
                    
                }
              });
          }

          layer.on({
            mouseover: function (e) {
              
              let layer = e.target;
              layer.setStyle({
                weight: 4,
                color: "#666",
                fillOpacity: 0.1,
                dashArray: '',
                opacity: 1
              });


              if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
              }

            },
            mouseout: function (e) {
              Kecamatan.resetStyle(e.target);
            }
          });
        }
      });

      $.getJSON("{{ route('gis-kecamatan-geojson') }}", function ( response ) {
        Kecamatan.addData(response.data);
      });

      //Legenda Kecamatan//
      let kecLegend = L.control({
        name: 'kecLegend',
        position: 'bottomleft'
      });

      kecLegend.onAdd = function (map) {
          let divKec = L.DomUtil.create("divKec", "info legend");
          divKec.innerHTML += "<h6><b>Legenda :</b> Kecamatan</h6>";
          divKec.innerHTML += '<p><i style="background: #ffb400"></i><span>Banjarmasin Barat</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #70a1d7"></i><span>Banjarmasin Selatan</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #a1de93"></i><span>Banjarmasin Tengah</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #f47c7c"></i><span>Banjarmasin Timur</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #f7f48b"></i><span>Banjarmasin Utara</span><br></p>';
            
          return divKec;
      };

      // rtlh
      let rtlhLayer = L.geoJson(null);
      let gRtlh = L.geoJSON(null, {
        pointToLayer: function(geoJsonPoint, latlng) {
          return L.marker(latlng, {icon: greenIcon, data: geoJsonPoint});
        } 
        });

      $.get("{{ route('gis-rtlh-map1') }}", function( response ) {
        gRtlh.addData(response.data);
        map.addLayer(rtlhLayer);
      });

      // penerima bantuan
      let rtlhLayer2 = L.geoJson(null);
      let gRtlh2 = L.geoJSON(null, {
        pointToLayer: function(geoJsonPoint, latlng) {
          return L.marker(latlng, {icon: blueIcon, data: geoJsonPoint});
        } 
        });

      $.get("{{ route('gis-rtlh-map2') }}", function( response ) {
        gRtlh2.addData(response.data);
        map.addLayer(rtlhLayer2);
      });

      /*DELINIASI KUMUH*/
      let kumuhLayer = L.geoJson(null);
      let kumuh = L.geoJson(null, {
        style: function (feature) {
          return {
            color: "grey",
            fillColor: "magenta",
            fillOpacity: 0.5,
            opacity: 0.5,
            width: 0.001,
            clickable: true,
            title: feature.properties.KATEGORI,
            riseOnHover: true
          };
        },
        onEachFeature: function (feature, layer) {
          if (feature.properties) {
            let content = "<table class='table table-sm table-striped table-bordered table-condensed'>" + "<tr><th>KRITERIA KUMUH</th><td>" + feature.properties.KRITERIA_KUMUH + "<tr><th>LUASAN KUMUH (M<SUP>2</SUP>)</th><td>" + feature.properties.LUAS + "</td></tr>" + "<tr><th>KELURAHAN</th><td>" + feature.properties.KELURAHAN + "</td></tr>" + "<tr><th>RT</th><td>" + feature.properties.RT+ "</td></tr>" +  "</td></tr>" + "<table>";
            layer.on({
              click: function (e) {
                $("#feature-title").html(feature.properties.KATEGORI);
                $("#feature-info").html(content);
                $("#featureModal").modal("show");

              }
            });
          }
          layer.on({
            mouseover: function (e) {
              let layer = e.target;
              layer.setStyle({
                weight: 3,
                color: "#00FFFF",
                opacity: 1
              });
              if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
              }
            },
            mouseout: function (e) {
              kumuh.resetStyle(e.target);
            }
          });
        }
      });

      $.getJSON("{{ route('gis-kumuh-geojson') }}", function ( response ) {
        kumuh.addData(response.data);
      });

      // Overlay layers are grouped
      var groupedOverlays = {
        "UTILITAS KOTA & BATAS ADMINISTRASI": {
          "Kelurahan": kelurahanLayer,
          "Kecamatan": kecamatanLayer,
        },
        "DATA": {
          "<img src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png' width='8' height='14'>&nbsp; RTLH": rtlhLayer,
          "<img src='https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png' width='8' height='14'>&nbsp; Penerima Bantuan": rtlhLayer2
        },
        "TEMATIK": {
          "Deliniasi Kumuh 2015": kumuhLayer,
        }
      };

      // Use the custom grouped layer control, not "L.control.layers"
      L.control.groupedLayers(ExampleData.Basemaps, groupedOverlays).addTo(map);

      /* Layer control listeners that allow for a single markerClusters layer */
      map.on("overlayadd", function(e) {
        if (e.layer === kelurahanLayer) {
          markerClusters.addLayer(Kelurahan);
          //console.log(gRtlh);
        }
        if (e.layer === kecamatanLayer) {
          kecLegend.addTo(this);
          markerClusters.addLayer(Kecamatan);
          //console.log(gRtlh);
        }
        if (e.layer === rtlhLayer) {
          markerClusters.addLayer(gRtlh).bindPopup(function (feature,layer){
            return feature.options.data.properties.map_popup_content;
          });
          //console.log(gRtlh);
        }
        if (e.layer === rtlhLayer2) {
          markerClusters.addLayer(gRtlh2).bindPopup(function (feature,layer){
            return feature.options.data.properties.map_popup_content;
          });
          //console.log(gRtlh2);
        }
        if (e.layer === kumuhLayer) {
          markerClusters.addLayer(kumuh);
          //console.log(gRtlh2);
        }
      });

      map.on("overlayremove", function(e) {
        if (e.layer === kelurahanLayer) {
          markerClusters.removeLayer(Kelurahan);
        }
        if (e.layer === kecamatanLayer) {
          this.removeControl(kecLegend);
          markerClusters.removeLayer(Kecamatan);
        }
        if (e.layer === rtlhLayer) {
          markerClusters.removeLayer(gRtlh);
        }
        if (e.layer === rtlhLayer2) {
          markerClusters.removeLayer(gRtlh2);
        }
        if (e.layer === kumuhLayer) {
          markerClusters.removeLayer(kumuh);
        }
      });

    });
    </script>
  </x-slot>
</x-app-layout>