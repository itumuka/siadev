@extends('layout')
@section('css')
    <style>
        table.dataTable th,
        table.dataTable td {
            padding: 3px 6px;
            font-size: 0.8em;
            /* e.g. change 8x to 4px here */
        }

        /* thead {
                background-color: #7C261B !important;
            } */

        /* Custom Calendar Styling */
        #calendar {
            border: none !important;
            font-family: 'Outfit', sans-serif;
        }

        .fc-view-container {
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .fc-head-container {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        .fc-head th {
            padding: 12px 0 !important;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border: none !important;
        }

        .fc-day-number {
            font-weight: 500;
            color: #64748b;
            padding: 8px !important;
        }

        .fc-today {
            background: rgba(2, 132, 199, 0.05) !important;
        }

        .fc-event {
            border: none !important;
            border-radius: 8px !important;
            padding: 4px 8px !important;
            font-weight: 500 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04) !important;
            font-size: 0.85rem !important;
        }

        .fc-state-default {
            background-color: #ffffff !important;
            background-image: none !important;
            border: 1px solid #e2e8f0 !important;
            color: #475569 !important;
            box-shadow: none !important;
            text-shadow: none !important;
            border-radius: 10px !important;
            padding: 6px 12px !important;
            height: auto !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .fc-state-default:hover {
            background-color: #f8fafc !important;
            color: #1e293b !important;
            border-color: #cbd5e1 !important;
        }

        .fc-state-active {
            background-color: #0284c7 !important;
            color: #ffffff !important;
            border-color: #0284c7 !important;
        }

        .fc-header-toolbar {
            margin-bottom: 20px !important;
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .fc-center h2 {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
        }

        @media (max-width: 767px) {
            .fc-header-toolbar {
                flex-direction: column !important;
                gap: 10px !important;
            }
            .fc-center h2 {
                font-size: 1.1rem !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row" id="here">
                <div class="col-xl-8 col-12">
                    <input class="form-control" type="hidden" value="{{ $session_tahun }}" name="session_tahun"
                        id="session_tahun">
                    <input class="form-control" type="hidden" value="{{ $session_semester }}" name="session_semester"
                        id="session_semester">
                    <div class="box bg-primary-light">
                        <div class="box-body d-flex px-0">
                            <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md"
                                style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                                <form id="form_tahunakademik" method="GET">
                                    <div class="row">
                                        <div class="col-12 col-xl-6">
                                            <h2>Selamat Datang,</h2>

                                            <p class="text-dark my-10 font-size-16"><strong
                                                    class="text-warning">{{ $session_nama }}</strong>
                                            </p>

                                            <!-- Awal Notifikasi Lengkapi Profil -->
                                            <div id="notif-lengkapi-profil" style="display: none;">
                                                <div class="alert alert-warning d-flex justify-content-between align-items-center py-2 px-3">
                                                  <small class="mb-0">Profil belum lengkap.</small>
                                                  <a href="{{ url('/mahasiswa/profil') }}" class="btn btn-danger btn-xs">Lengkapi</a>
                                                </div>
                                            </div>
                                            <!-- Akhir Notifikasi Lengkapi Profil -->

                                            {{-- @if (Session::get('tipe') == 'Pegawai') 
                                                <p class="text-dark my-10 font-size-16">
                                                    Sesuaikan <strong class="text-warning">Tahun Akademik</strong> pilihanmu!
                                                </p>
                                                <p class="mb-2 text-dark my-10 font-size-16">
                                                    <select class="form-control selecttahunakademik" style="width: 100%;" name="tahunakademik" id="tahunakademik"></select>
                                                </p>
                                                <p>
                                                    <button type="submit" class="btn btn-sm btn-rounded btn-primary btn-outline"><i class="ti-reload"></i> Pilih
                                                    </button>
                                                </p>
                                            @endif --}}


                                        </div>
                                        <div class="col-12 col-xl-6"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box bg-transparent no-shadow mb-0">
                        <div class="box-header no-border">
                            <h4 class="box-title">Kalender Akademik</h4>
                            <div class="box-controls pull-right d-md-flex d-none">
                                <a href="#" id="nama_tahun_akademik">{{ $session_nama_tahunakademik }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-body py-0" id="calendar">

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">

                    <h4 class="box-title">Keterangan</h4>
                    <div class="box">
                        <div class="box-body bg-warning-light">
                            <div class="box no-shadow mb-0">
                                <div class="box-body px-0 py-0 pt-0" id="tabel_kalenderakademik">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Modal Detail Event Kalender -->
            <div class="modal fade" id="modal-detail-event" tabindex="-1" role="dialog" aria-labelledby="modalDetailEventLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                        <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 20px;">
                            <h5 class="modal-title font-weight-600" id="modalDetailEventLabel" style="color: #1e293b;"><i class="fa fa-info-circle text-primary mr-2"></i> Detail Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 24px;">
                            <div class="d-flex align-items-start">
                                <div id="event-badge-color" style="width: 16px; height: 16px; border-radius: 50%; margin-right: 15px; margin-top: 5px; flex-shrink: 0; background-color: #0284c7;"></div>
                                <div>
                                    <h4 class="font-weight-600 mb-5" id="event-detail-title" style="color: #1e293b; line-height: 1.4; font-size: 1.15rem;">-</h4>
                                    <p class="text-muted mb-0 font-size-14" id="event-detail-time">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: none; padding: 20px;">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius: 10px; padding: 8px 16px;">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {

            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var tipe = "{{ Session::get('tipe') }}";
            var session_tahun = $('#session_tahun').val();
            var session_semester = $('#session_semester').val();

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
                        // console.log(result);
                        $('#tabel_kalenderakademik').html(s);
                    }
                })
            }
            home_kalenderakademik();



            // function make_session_depan(a) {
            //     $.ajax({
            //         url:"{{ route('make_session') }}",
            //         method:"GET",
            //         data:a,
            //         dataType:"json",
            //         success: function(result) {
            //             location.reload();
            //         }
            //     })
            // }

            // $('#form_tahunakademik').on('submit', function(event){
            //       event.preventDefault();
            //       var form_data = $(this).serialize();
            //       $.ajax({
            //           url:"{{ config('setting.second_url') }}akademik/change-session-tahunakademik",
            //           method:"GET",
            //           data:form_data,
            //           dataType:"json",
            //           beforeSend: function() {
            //             $("#btsubmit").prop('disabled', true);
            //           },
            //           success:function(data)
            //           {
            //               if(data.error){
            //                 showToastr('error', 'Error!', data.error);  
            //                   $("#btsubmit").prop('disabled', false);                                         
            //               }
            //               else if(data.success){ 
            //                 showToastr('success', 'Success!', data.success);   
            //                 $("#btsubmit").prop('disabled', false);
            //                 make_session_depan(form_data);

            //             }                                   
            //           }              
            //       })                     
            //   });

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
                    var s = '';
                    var jml = result.length;

                    for (i = 0; i < jml; i++) {
                        // s = s +
                        //     '{title:' +
                        //     result[i].nama_kegiatan +
                        //     ',start' +
                        //     result[i].tanggal_mulai +
                        //     ',end' +
                        //     result[i].tanggal_selesai + ',backgroundColor' + result[i].background +
                        //     '},'
                        if (result[i].kode_kegiatan_akademik == '22' && tipe == 'Mahasiswa') {
                            // kosongan koyo bakso
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
                        this.$calendar = $('#calendar');
                        this.$calendarObj = null;
                    };

                    CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                        var title = calEvent.title;
                        var color = calEvent.backgroundColor || '#0284c7';
                        
                        var startDate = moment(calEvent.start);
                        var timeStr = startDate.format('DD MMMM YYYY');
                        
                        if (calEvent.end) {
                            var endDate = moment(calEvent.end);
                            if (calEvent.allDay) {
                                endDate.subtract(1, 'days');
                            }
                            if (!startDate.isSame(endDate, 'day')) {
                                timeStr += ' s/d ' + endDate.format('DD MMMM YYYY');
                            }
                        }
                        
                        $('#event-detail-title').text(title);
                        $('#event-detail-time').text(timeStr);
                        $('#event-badge-color').css('background-color', color);
                        
                        $('#modal-detail-event').modal('show');
                    };

                    CalendarApp.prototype.init = function() {
                        var defaultEvents = clg;
                        var $this = this;
                        $this.$calendarObj = $this.$calendar.fullCalendar({
                            defaultView: 'month',
                            handleWindowResize: true,
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month'
                            },
                            events: defaultEvents,
                            editable: false,
                            droppable: false,
                            eventLimit: true,
                            selectable: false,
                            eventClick: function(calEvent, jsEvent, view) {
                                $this.onEventClick(calEvent, jsEvent, view);
                            }
                        });
                    };

                    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp;
                    $.CalendarApp.init();


                }
            })




        });

    @if (Session::get('tipe') == 'Mahasiswa')
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var cek_profil_lengkap = true;

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
                        cek_profil_lengkap = false;
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
                        cek_profil_lengkap = false;
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
                        cek_profil_lengkap = false;
                        $('#notif-lengkapi-profil').fadeIn();
                    }
                }
            });
        });
    @endif
    </script>


@stop
