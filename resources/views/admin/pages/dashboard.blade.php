<x-admin-layout>
  
  <x-slot name="title">Dashboard</x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>User Admin</h4>
              </div>
              <div class="card-body">
                {{ $totalUsers['tot_admin'] }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>User TFL</h4>
              </div>
              <div class="card-body">
                {{ $totalUsers['tot_tfl'] }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>User Kelurahan</h4>
              </div>
              <div class="card-body">
                {{ $totalUsers['tot_general'] }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>User Konsultan</h4>
              </div>
              <div class="card-body">
                {{ $totalUsers['tot_konsult'] }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistik RTLH</h4>
              <!-- <div class="card-header-action">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary">Week</a>
                  <a href="#" class="btn">Month</a>
                </div>
              </div> -->
            </div>
            <div class="card-body">
              <canvas id="myChart" height="100"></canvas>
              <div class="statistic-details mt-sm-4">
                <div class="statistic-details-item">
                  <div class="detail-value">{{ $totalRtlh['tot_all'] }}</div>
                  <div class="detail-name">Total</div>
                </div>
                <div class="statistic-details-item">
                  <div class="detail-value">{{ $totalRtlh['tot_menunggu'] }}</div>
                  <div class="detail-name">Menunggu</div>
                </div>
                <!-- <div class="statistic-details-item">
                  <div class="detail-value">{{ $totalRtlh['tot_perbaikan'] }}</div>
                  <div class="detail-name">Pelu Perbaikan</div>
                </div> -->
                <div class="statistic-details-item">
                  <div class="detail-value">{{ $totalRtlh['tot_ditolak'] }}</div>
                  <div class="detail-name">Ditolak</div>
                </div>
                <div class="statistic-details-item">
                  <div class="detail-value">{{ $totalRtlh['tot_diterima'] }}</div>
                  <div class="detail-name">Diterima</div>
                </div>
                <div class="statistic-details-item">
                  <div class="detail-value">{{ $totalRtlh['tot_realisasi'] }}</div>
                  <div class="detail-name">Direalisasi</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Aktivitas Terakhir</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border" id="list-notification">
              </ul>
              <!-- <div class="text-center pt-1 pb-1">
                <a href="#" class="btn btn-primary btn-lg btn-round">
                  View All
                </a>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistik RTLH</h4>
              <!-- <div class="card-header-action">
                <div class="btn-group">
                  <a href="#" class="btn btn-primary">Week</a>
                  <a href="#" class="btn">Month</a>
                </div>
              </div> -->
            </div>
            <div class="card-body">
              
                <!-- <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label" for="input-name">Filter Kriteria</label>
                      <select class="form-control selectric" name="id_setup" id="id_setup">
                        <option value="">Pilih....</option>
                      </select>
                      <button type="button" id="button-filter" class="btn btn-primary pull-right "><i class="fa fa-filter"></i> Filter</button>
                    </div>
                  </div>
                </div> -->
                <div class="form-row mb-4">
                  <div class="col">
                    <select class="form-control selectric" name="id_setup" id="id_setup">
                      <!-- <option value="">Pilih....</option> -->
                      @foreach ($setups as $setup)
                        <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <button type="button" id="button-filter" class="btn btn-primary pull-right "><i class="fa fa-filter"></i> Filter Kriteria</button>
                  </div>
                </div>
              
              <div id="chart"><canvas id="myChart2" height="182"></canvas></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/chartjs/Chart.min.js') }}"></script>
    <script>

    function getAdminNotification() {
      $.ajax({
          type: "GET",
          url: "{{ route('notification') }}",
          data: {},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function(res, textStatus, jqXHR) {
            $('#list-notification').html('');
            $.each(res.data, function (key, value) {
              var html = 
                '<li class="media">'+
                  '<img class="mr-3 rounded-circle" width="50" src="{{ asset('img/notification.png') }}" alt="avatar">'+
                  '<div class="media-body">'+
                    
                    // '<div class="media-title">'+ value['title'] +'</div>'+
                    '<span class="text-small text-muted">'+ value['body'] +'</span>'+
                    '<div class="float-right text-primary">'+value['tgl_notif']+'</div>'+
                  '</div>'+
                '</li>';
                $('#list-notification').append(html);
            });
          },
          error: function(data, textStatus, jqXHR) {
            console.log(jqXHR + ' , Proses Dibatalkan!');
          },
      });
    }

    function getDataChart() {
      $.ajax({
          type: "GET",
          url: "{{ route('notification') }}",
          data: {},
          processData: false,
          contentType: false,
          dataType: "json",
          success: function(res, textStatus, jqXHR) {
            $('#list-notification').html('');
            $.each(res.data, function (key, value) {
              var html = 
                '<li class="media">'+
                  '<img class="mr-3 rounded-circle" width="50" src="{{ asset('img/notification.png') }}" alt="avatar">'+
                  '<div class="media-body">'+
                    
                    // '<div class="media-title">'+ value['title'] +'</div>'+
                    '<span class="text-small text-muted">'+ value['body'] +'</span>'+
                    '<div class="float-right text-primary">'+value['tgl_notif']+'</div>'+
                  '</div>'+
                '</li>';
                $('#list-notification').append(html);
            });
          },
          error: function(data, textStatus, jqXHR) {
            console.log(jqXHR + ' , Proses Dibatalkan!');
          },
      });
    }

    $(function() {

      var statistics_chart = document.getElementById("myChart").getContext('2d');

      var myChart = new Chart(statistics_chart, {
        type: 'line',
        data: {
          labels: @json($chart["label_all"]),
          datasets: [{
            label: 'Statistics',
            data: @json($chart["total"]),
            borderWidth: 5,
            borderColor: '#6777ef',
            backgroundColor: 'transparent',
            pointBackgroundColor: '#fff',
            pointBorderColor: '#6777ef',
            pointRadius: 4
          }]
        },
        options: {
          legend: {
            display: false
          },
          scales: {
            yAxes: [{
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                //stepSize: 5
              }
            }],
            xAxes: [{
              gridLines: {
                color: '#fbfbfb',
                lineWidth: 2
              }
            }]
          },
        }
      });

      getAdminNotification();

      $('#button-filter').on('click', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.addClass('btn-progress');
        var id_setup = $('#id_setup').val();
        $.ajax({
          url: "{{ route('admin.filter-chart-rtlh') }}",
          dataType: 'json',
          data: {id_setup:id_setup},
          beforeSend: function() {
            
          },
          complete: function() {
          
          },
          success: function(res) {
            
            var data = res.data;
            $("#myChart2").remove();
            $("#chart").append('<canvas id="myChart2" height="188"></canvas>');

            var statistics_chart = document.getElementById("myChart2").getContext('2d');
            var myChart2 = new Chart(statistics_chart, {
              type: 'bar',
              data: {
                labels: data["label_all"],
                datasets: [{
                  label: 'Statistics',
                  data: data["total"],
                  borderWidth: 5,
                  borderColor: '#6777ef',
                  backgroundColor: '#6777ef',
                  pointBackgroundColor: '#fff',
                  pointBorderColor: '#6777ef',
                  pointRadius: 4
                }]
              },
              options: {
                legend: {
                  display: false
                },
                scales: {
                  yAxes: [{
                    gridLines: {
                      display: false,
                      drawBorder: false,
                    },
                    ticks: {
                      //stepSize: 5
                    }
                  }],
                  xAxes: [{
                    gridLines: {
                      color: '#fbfbfb',
                      lineWidth: 2
                    }
                  }]
                },
              }
            });

            btn.removeClass('btn-progress');
          }
        });
      })

      $('#button-filter').trigger( "click" );
      
    });
    </script>
  </x-slot>
</x-app-layout>