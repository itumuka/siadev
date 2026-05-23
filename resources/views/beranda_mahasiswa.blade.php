@extends('layout')
@section('css')
    <style>
        table.dataTable th,
        table.dataTable td {
            padding: 3px 6px;
            font-size: 0.8em;
        }

        /* Card Styles */
        .card-stat {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }
        
        .card-stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .icon-ipk {
            background-color: rgba(234, 179, 8, 0.1);
            color: #ca8a04;
        }
        
        .icon-sks {
            background-color: rgba(14, 165, 233, 0.1);
            color: #0284c7;
        }
        
        .icon-mk {
            background-color: rgba(16, 185, 129, 0.1);
            color: #059669;
        }
        
        .icon-semester {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
        }
        
        .card-stat-info {
            flex-grow: 1;
        }
        
        .card-stat-info h5 {
            font-size: 0.88rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-stat-info h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        
        .card-stat-progress {
            margin-top: 10px;
            height: 6px;
            border-radius: 3px;
            background-color: #f1f5f9;
            overflow: hidden;
        }
        
        .card-stat-progress-bar {
            height: 100%;
            border-radius: 3px;
            transition: width 1s ease-in-out;
        }
        
        /* Chart Card */
        .card-chart {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .card-chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .card-chart-header h4 {
            font-size: 1.15rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .card-chart-header p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0;
        }
        
        /* Shimmer loading */
        .shimmer {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: loading-shimmer 1.5s infinite;
        }
        
        @keyframes loading-shimmer {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row" id="here">
                <div class="col-12">
                    <input class="form-control" type="hidden" value="{{ $session_tahun }}" name="session_tahun"
                        id="session_tahun">
                    <input class="form-control" type="hidden" value="{{ $session_semester }}" name="session_semester"
                        id="session_semester">
                    
                    <!-- Welcome Box -->
                    <div class="box bg-primary-light mb-24">
                        <div class="box-body d-flex px-0">
                            <div class="flex-grow-1 p-30 bg-img dask-bg bg-none-md"
                                style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                                <div class="row">
                                    <div class="col-12 col-xl-8">
                                        <h2 class="font-weight-600">Selamat Datang di Portal Mahasiswa</h2>
                                        <p class="text-dark my-10 font-size-18"><strong
                                                class="text-warning">{{ $session_nama }}</strong> (NIM: {{ Session::get('username') }})
                                        </p>

                                        <!-- Awal Notifikasi Lengkapi Profil -->
                                        <div id="notif-lengkapi-profil" style="display: none; max-width: 450px;">
                                            <div class="alert alert-warning d-flex justify-content-between align-items-center py-2 px-3 mt-3 mb-0" style="border-radius: 12px;">
                                              <small class="mb-0 text-dark"><i class="fa fa-info-circle mr-1"></i> Data profil Anda belum lengkap.</small>
                                              <a href="{{ url('/mahasiswa/profil') }}" class="btn btn-danger btn-xs ml-3" style="border-radius: 8px;">Lengkapi</a>
                                            </div>
                                        </div>
                                        <!-- Akhir Notifikasi Lengkapi Profil -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards Row -->
                    <div class="row mb-10">
                        <!-- IPK Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-ipk">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>IPK Kumulatif</h5>
                                    <h3 id="stat-ipk"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SKS Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-sks">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>SKS Diperoleh</h5>
                                    <h3 id="stat-sks"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                    <div class="card-stat-progress">
                                        <div class="card-stat-progress-bar bg-sky" id="sks-progress" style="width: 0%"></div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" id="sks-percentage">Target: 144 SKS</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- MK Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-mk">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>MK Diselesaikan</h5>
                                    <h3 id="stat-mk"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Semester Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-semester">
                                    <i class="fa fa-calendar-check-o"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Semester Aktif</h5>
                                    <h3 id="stat-semester"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <!-- IP Semester Progression Line Chart -->
                        <div class="col-xl-8 col-12">
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <div>
                                        <h4>Tren IP Semester (IPS)</h4>
                                        <p class="text-muted">Perkembangan pencapaian Indeks Prestasi Anda setiap semester</p>
                                    </div>
                                </div>
                                <div id="ips-chart" style="min-height: 350px;">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 350px;">
                                        <div class="text-center text-muted">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p class="mt-2">Memuat grafik perkembangan...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Grade Distribution Donut Chart -->
                        <div class="col-xl-4 col-12">
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <div>
                                        <h4>Distribusi Nilai Huruf</h4>
                                        <p class="text-muted">Persentase perolehan nilai mata kuliah</p>
                                    </div>
                                </div>
                                <div id="grades-chart" style="min-height: 350px;">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 350px;">
                                        <div class="text-center text-muted">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p class="mt-2">Memuat grafik distribusi...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Original Calendar Section -->
                    <div class="row">
                        <div class="col-xl-8 col-12">
                            <div class="box bg-transparent no-shadow mb-0">
                                <div class="box-header no-border px-0">
                                    <h4 class="box-title">Kalender Akademik</h4>
                                    <div class="box-controls pull-right d-md-flex d-none">
                                        <a href="#" id="nama_tahun_akademik">{{ $session_nama_tahunakademik }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-body py-0" id="calendar"></div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <h4 class="box-title">Keterangan Kalender</h4>
                            <div class="box">
                                <div class="box-body bg-warning-light">
                                    <div class="box no-shadow mb-0 bg-transparent">
                                        <div class="box-body px-0 py-0 pt-0" id="tabel_kalenderakademik"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <!-- Load ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script type="text/javascript">
        // Global functions for ApexCharts
        function drawIpsChart(labels, seriesData) {
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#0284c7'],
                dataLabels: {
                    enabled: true,
                    background: {
                        borderWidth: 0,
                        foreColor: '#ffffff',
                        padding: 4,
                        borderRadius: 6,
                    },
                    style: {
                        fontSize: '11px',
                        colors: ['#0284c7']
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                series: [{
                    name: 'IP Semester',
                    data: seriesData
                }],
                xaxis: {
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 4.0,
                    tickAmount: 4,
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        },
                        formatter: function(val) {
                            return val.toFixed(2);
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                tooltip: {
                    theme: 'light',
                    x: {
                        show: true
                    }
                }
            };

            $('#ips-chart').empty();
            var chart = new ApexCharts(document.querySelector("#ips-chart"), options);
            chart.render();
        }

        function drawGradesChart(labels, seriesData) {
            let finalLabels = [];
            let finalSeries = [];
            
            for (let i = 0; i < labels.length; i++) {
                if (seriesData[i] > 0) {
                    finalLabels.push(labels[i]);
                    finalSeries.push(seriesData[i]);
                }
            }
            
            if (finalSeries.length === 0) {
                $('#grades-chart').html('<div class="d-flex align-items-center justify-content-center" style="height:350px;"><p class="text-muted">Tidak ada data nilai</p></div>');
                return;
            }

            var options = {
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: finalLabels,
                series: finalSeries,
                colors: ['#10b981', '#0ea5e9', '#f59e0b', '#ef4444', '#64748b'],
                legend: {
                    position: 'bottom',
                    fontSize: '12px',
                    labels: {
                        colors: '#64748b'
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toFixed(0) + "%"
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total MK',
                                    color: '#64748b',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Mata Kuliah";
                        }
                    }
                }
            };

            $('#grades-chart').empty();
            var chart = new ApexCharts(document.querySelector("#grades-chart"), options);
            chart.render();
        }
        
        function renderEmptyState() {
            $('#stat-ipk').text('0.00');
            $('#stat-sks').text('0 SKS');
            $('#stat-mk').text('0');
            $('#stat-semester').text('-');
            $('#sks-progress').css('width', '0%');
            $('#ips-chart').html('<div class="d-flex align-items-center justify-content-center" style="height: 350px;"><p class="text-muted">Belum ada riwayat nilai semester.</p></div>');
            $('#grades-chart').html('<div class="d-flex align-items-center justify-content-center" style="height: 350px;"><p class="text-muted">Belum ada riwayat nilai.</p></div>');
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var tipe = "{{ Session::get('tipe') }}";
            var session_tahun = $('#session_tahun').val();
            var session_semester = $('#session_semester').val();

            // Fetch and Calculate Academic Stats & Charts
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}mahasiswa/transkrip-nilai",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: userlogin,
                },
                success: function(transcriptData) {
                    if (!transcriptData || transcriptData.length === 0) {
                        renderEmptyState();
                        return;
                    }
                    
                    let totalSks = 0;
                    let totalSksMutu = 0;
                    let coursesCompleted = 0;
                    let semestersSet = new Set();
                    let gradesCount = { 'A': 0, 'B': 0, 'C': 0, 'D': 0, 'E': 0 };
                    let semData = {}; // smt_matakuliah -> { sks: X, sksMutu: Y }
                    
                    transcriptData.forEach(function(row) {
                        let sks = parseFloat(row.sks_matakuliah) || 0;
                        let sVal = row.smt_matakuliah;
                        let grade = (row.nilai || '').toUpperCase().trim();
                        let mutu = parseFloat(row.mutu) || 0;
                        let sksMutu = parseFloat(row.kum_sksmutu) || 0;
                        
                        totalSks += sks;
                        totalSksMutu += sksMutu;
                        coursesCompleted++;
                        
                        if (sVal) {
                            semestersSet.add(sVal);
                            if (!semData[sVal]) {
                                semData[sVal] = { sks: 0, sksMutu: 0 };
                            }
                            semData[sVal].sks += sks;
                            semData[sVal].sksMutu += sksMutu;
                        }
                        
                        // Parse grade prefix (A, B, C, D, E)
                        let baseGrade = grade.length > 0 ? grade.charAt(0) : 'E';
                        if (baseGrade === 'F') baseGrade = 'E'; // Group F with E
                        if (gradesCount.hasOwnProperty(baseGrade)) {
                            gradesCount[baseGrade]++;
                        } else {
                            gradesCount['E']++;
                        }
                    });
                    
                    let gpa = totalSks > 0 ? (totalSksMutu / totalSks) : 0.00;
                    
                    // Render Cards
                    $('#stat-ipk').text(gpa.toFixed(2));
                    $('#stat-sks').text(totalSks + ' SKS');
                    $('#stat-mk').text(coursesCompleted);
                    
                    let sksPercentage = Math.min((totalSks / 144) * 100, 100);
                    $('#sks-progress').css('width', sksPercentage + '%');
                    $('#sks-percentage').text('Target: 144 SKS (' + sksPercentage.toFixed(1) + '% Tercapai)');
                    
                    let activeSemesterNum = semestersSet.size > 0 ? Math.max(...Array.from(semestersSet).map(Number)) : '-';
                    $('#stat-semester').text('Smt ' + activeSemesterNum);
                    
                    // Line chart data preparation
                    let sortedSemesters = Array.from(semestersSet).map(Number).sort((a, b) => a - b);
                    let ipsList = [];
                    let semesterLabels = [];
                    
                    sortedSemesters.forEach(function(sem) {
                        let data = semData[sem];
                        let semIps = data.sks > 0 ? (data.sksMutu / data.sks) : 0.00;
                        ipsList.push(parseFloat(semIps.toFixed(2)));
                        semesterLabels.push('Semester ' + sem);
                    });
                    
                    drawIpsChart(semesterLabels, ipsList);
                    drawGradesChart(Object.keys(gradesCount), Object.values(gradesCount));
                },
                error: function() {
                    renderEmptyState();
                }
            });

            // Academic Calendar Loader
            function home_kalenderakademik() {
                $.ajax({
                    type: 'GET',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: session_tahun,
                        semester: session_semester
                    },
                    url: "{{ config('setting.second_url') }}akademik/home-kalenderakademik",
                    success: function(result) {
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            if (result[i].kode_kegiatan_akademik == '22' && tipe == 'Mahasiswa') {
                                s = s + "";
                            } else {
                                s = s +
                                    '<div class="table-responsive"><table class="table table-sm no-border mb-0"><tbody><tr><td><div class="h-20 w-20 l-h-20 rounded text-center" style="background-color:' +
                                    result[i].background +
                                    '"><p class="mb-0 font-size-15 font-weight-200"></p></div></td><td class="float-left font-size-15 font-weight-500">' +
                                    result[i].nama_kegiatan +
                                    '<br><p class="text-warning">(' +
                                    result[i].tanggal_mulailook + ' s/d ' + result[i]
                                    .tanggal_akhirlook +
                                    ')</p></td></tr></tbody></table></div>';
                            }
                        }
                        $('#tabel_kalenderakademik').html(s);
                    }
                })
            }
            home_kalenderakademik();

            // Calendar events loader
            var clg = [];
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    tahun: session_tahun,
                    semester: session_semester
                },
                url: "{{ config('setting.second_url') }}akademik/home-kalenderakademikbase",
                success: function(result) {
                    var jml = result.length;
                    for (i = 0; i < jml; i++) {
                        if (result[i].kode_kegiatan_akademik == '22' && tipe == 'Mahasiswa') {
                            // skip
                        } else {
                            clg.push({
                                title: result[i].nama_kegiatan,
                                start: result[i].tanggal_mulai,
                                end: result[i].tanggal_akhir,
                                backgroundColor: result[i].background
                            });
                        }
                    }
                    var CalendarApp = function() {
                        this.$body = $("body")
                        this.$calendar = $('#calendar'),
                            this.$event = ('#external-events div.external-event'),
                            this.$categoryForm = $('#add-new-events form'),
                            this.$extEvents = $('#external-events'),
                            this.$modal = $('#my-event'),
                            this.$saveCategoryBtn = $('.save-category'),
                            this.$calendarObj = null
                    };

                    CalendarApp.prototype.onDrop = function(eventObj, date) {
                        var $this = this;
                        var originalEventObject = eventObj.data('eventObject');
                        var $categoryClass = eventObj.attr('data-class');
                        var copiedEventObject = $.extend({}, originalEventObject);
                        copiedEventObject.start = date;
                        if ($categoryClass)
                            copiedEventObject['className'] = [$categoryClass];
                        $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
                        if ($('#drop-remove').is(':checked')) {
                            eventObj.remove();
                        }
                    };

                    CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                        var $this = this;
                        var form = $("<form></form>");
                        form.append("<label>Change event name</label>");
                        form.append(
                            "<div class='input-group'><input class='form-control' type=text value='" +
                            calEvent.title +
                            "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>"
                        );
                        $this.$modal.modal({ backdrop: 'static' });
                        $this.$modal.find('.delete-event').show().end().find('.save-event').hide()
                            .end().find('.modal-body').empty().prepend(form).end().find('.delete-event').unbind('click')
                            .click(function() {
                                $this.$calendarObj.fullCalendar('removeEvents', function(ev) {
                                    return (ev._id == calEvent._id);
                                });
                                $this.$modal.modal('hide');
                            });
                        $this.$modal.find('form').on('submit', function() {
                            calEvent.title = form.find("input[type=text]").val();
                            $this.$calendarObj.fullCalendar('updateEvent', calEvent);
                            $this.$modal.modal('hide');
                            return false;
                        });
                    };

                    CalendarApp.prototype.onSelect = function(start, end, allDay) {
                        var $this = this;
                        $this.$modal.modal({ backdrop: 'static' });
                        var form = $("<form></form>");
                        form.append("<div class='row'></div>");
                        form.find(".row")
                            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>")
                            .append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>")
                            .find("select[name='category']")
                            .append("<option value='bg-danger'>Danger</option>")
                            .append("<option value='bg-success'>Success</option>")
                            .append("<option value='bg-purple'>Purple</option>")
                            .append("<option value='bg-primary'>Primary</option>")
                            .append("<option value='bg-pink'>Pink</option>")
                            .append("<option value='bg-info'>Info</option>")
                            .append("<option value='bg-warning'>Warning</option></div></div>");
                        $this.$modal.find('.delete-event').hide().end().find('.save-event').show()
                            .end().find('.modal-body').empty().prepend(form).end().find('.save-event').unbind('click').click(function() {
                                form.submit();
                            });
                        $this.$modal.find('form').on('submit', function() {
                            var title = form.find("input[name='title']").val();
                            var categoryClass = form.find("select[name='category'] option:checked").val();
                            if (title !== null && title.length != 0) {
                                $this.$calendarObj.fullCalendar('renderEvent', {
                                    title: title,
                                    start: start,
                                    end: end,
                                    allDay: false,
                                    className: categoryClass
                                }, true);
                                $this.$modal.modal('hide');
                            } else {
                                alert('You have to give a title to your event');
                            }
                            return false;
                        });
                        $this.$calendarObj.fullCalendar('unselect');
                    };

                    CalendarApp.prototype.enableDrag = function() {
                        $(this.$event).each(function() {
                            var eventObject = { title: $.trim($(this).text()) };
                            $(this).data('eventObject', eventObject);
                            $(this).draggable({ zIndex: 999999, revert: true, revertDuration: 0 });
                        });
                    };

                    CalendarApp.prototype.init = function() {
                        this.enableDrag();
                        var defaultEvents = clg;
                        var $this = this;
                        $this.$calendarObj = $this.$calendar.fullCalendar({
                            slotDuration: '00:15:00',
                            minTime: '08:00:00',
                            maxTime: '19:00:00',
                            defaultView: 'month',
                            handleWindowResize: true,
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            events: defaultEvents,
                            editable: true,
                            droppable: true,
                            eventLimit: true,
                            selectable: true,
                            drop: function(date) { $this.onDrop($(this), date); },
                            select: function(start, end, allDay) { $this.onSelect(start, end, allDay); },
                            eventClick: function(calEvent, jsEvent, view) { $this.onEventClick(calEvent, jsEvent, view); }
                        });
                    };

                    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp;
                    $.CalendarApp.init();
                }
            });
        });

        // Profile completion checking
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            // 1. Cek Profil Personal & Pendidikan
            $.ajax({
                type: 'POST',
                url: "{{ config('setting.second_url') }}mahasiswa/profil-personal",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: userlogin
                },
                success: function(result) {
                    if (!result.nik_mhs || !result.tempat_lahir || !result.alamat_asal || !result.pendidikan_terakhir) {
                        $('#notif-lengkapi-profil').fadeIn();
                    }
                }
            });

            // 2. Cek Profil Ayah
            $.ajax({
                type: 'POST',
                url: "{{ config('setting.second_url') }}mahasiswa/profil-ayah",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: { nim: userlogin },
                success: function(result) {
                    if (!result.nama || !result.nik_ayah) {
                        $('#notif-lengkapi-profil').fadeIn();
                    }
                }
            });

            // 3. Cek Profil Ibu
            $.ajax({
                type: 'POST',
                url: "{{ config('setting.second_url') }}mahasiswa/profil-ibu",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: { nim: userlogin },
                success: function(result) {
                    if (!result.nama || !result.nik_ibu) {
                        $('#notif-lengkapi-profil').fadeIn();
                    }
                }
            });
        });
    </script>
@stop
