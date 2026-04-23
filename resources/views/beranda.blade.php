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
                        this.$body = $("body")
                        this.$calendar = $('#calendar'),
                            this.$event = ('#external-events div.external-event'),
                            this.$categoryForm = $('#add-new-events form'),
                            this.$extEvents = $('#external-events'),
                            this.$modal = $('#my-event'),
                            this.$saveCategoryBtn = $('.save-category'),
                            this.$calendarObj = null
                    };


                    /* on drop */
                    CalendarApp.prototype.onDrop = function(eventObj, date) {
                            var $this = this;
                            // retrieve the dropped element's stored Event Object
                            var originalEventObject = eventObj.data('eventObject');
                            var $categoryClass = eventObj.attr('data-class');
                            // we need to copy it, so that multiple events don't have a reference to the same object
                            var copiedEventObject = $.extend({}, originalEventObject);
                            // assign it the date that was reported
                            copiedEventObject.start = date;
                            if ($categoryClass)
                                copiedEventObject['className'] = [$categoryClass];
                            // render the event on the calendar
                            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
                            // is the "remove after drop" checkbox checked?
                            if ($('#drop-remove').is(':checked')) {
                                // if so, remove the element from the "Draggable Events" list
                                eventObj.remove();
                            }
                        },
                        /* on click on event */
                        CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                            var $this = this;
                            var form = $("<form></form>");
                            form.append("<label>Change event name</label>");
                            form.append(
                                "<div class='input-group'><input class='form-control' type=text value='" +
                                calEvent
                                .title +
                                "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>"
                            );
                            $this.$modal.modal({
                                backdrop: 'static'
                            });
                            $this.$modal.find('.delete-event').show().end().find('.save-event').hide()
                                .end().find(
                                    '.modal-body')
                                .empty().prepend(form).end().find('.delete-event').unbind('click')
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
                        },
                        /* on select */
                        CalendarApp.prototype.onSelect = function(start, end, allDay) {
                            var $this = this;
                            $this.$modal.modal({
                                backdrop: 'static'
                            });
                            var form = $("<form></form>");
                            form.append("<div class='row'></div>");
                            form.find(".row")
                                .append(
                                    "<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>"
                                )
                                .append(
                                    "<div class='col-md-6'><div class='form-group'><label class='control-label'>Category</label><select class='form-control' name='category'></select></div></div>"
                                )
                                .find("select[name='category']")
                                .append("<option value='bg-danger'>Danger</option>")
                                .append("<option value='bg-success'>Success</option>")
                                .append("<option value='bg-purple'>Purple</option>")
                                .append("<option value='bg-primary'>Primary</option>")
                                .append("<option value='bg-pink'>Pink</option>")
                                .append("<option value='bg-info'>Info</option>")
                                .append("<option value='bg-warning'>Warning</option></div></div>");
                            $this.$modal.find('.delete-event').hide().end().find('.save-event').show()
                                .end().find(
                                    '.modal-body')
                                .empty().prepend(form).end().find('.save-event').unbind('click').click(
                                    function() {
                                        form.submit();
                                    });
                            $this.$modal.find('form').on('submit', function() {
                                var title = form.find("input[name='title']").val();
                                var beginning = form.find("input[name='beginning']").val();
                                var ending = form.find("input[name='ending']").val();
                                var categoryClass = form.find(
                                    "select[name='category'] option:checked").val();
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
                        },
                        CalendarApp.prototype.enableDrag = function() {
                            //init events
                            $(this.$event).each(function() {
                                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                                // it doesn't need to have a start or end
                                var eventObject = {
                                    title: $.trim($(this)
                                        .text()
                                    ) // use the element's text as the event title
                                };
                                // store the Event Object in the DOM element so we can get to it later
                                $(this).data('eventObject', eventObject);
                                // make the event draggable using jQuery UI
                                $(this).draggable({
                                    zIndex: 999999,
                                    revert: true, // will cause the event to go back to its
                                    revertDuration: 0 //  original position after the drag
                                });
                            });
                        }
                    /* Initializing */
                    CalendarApp.prototype.init = function() {
                            this.enableDrag();
                            /*  Initialize the calendar  */
                            var date = new Date();
                            var d = date.getDate();
                            var m = date.getMonth();
                            var y = date.getFullYear();
                            var form = '';
                            var today = new Date($.now());

                            var defaultEvents = clg;

                            // {
                            //     title: 'This is your birthday',
                            //     start: '2022-03-08',
                            //     end: '2022-03-15',
                            //     // style: '#0786e9',
                            //     backgroundColor: "#0786e9",
                            // },

                            var $this = this;
                            $this.$calendarObj = $this.$calendar.fullCalendar({
                                slotDuration: '00:15:00',
                                /* If we want to split day time each 15minutes */
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
                                droppable: true, // this allows things to be dropped onto the calendar !!!
                                eventLimit: true, // allow "more" link when too many events
                                selectable: true,
                                drop: function(date) {
                                    $this.onDrop($(this), date);
                                },
                                select: function(start, end, allDay) {
                                    $this.onSelect(start, end, allDay);
                                },
                                eventClick: function(calEvent, jsEvent, view) {
                                    $this.onEventClick(calEvent, jsEvent, view);
                                }

                            });

                            //on new event
                            this.$saveCategoryBtn.on('click', function() {
                                var categoryName = $this.$categoryForm.find(
                                    "input[name='category-name']").val();
                                var categoryColor = $this.$categoryForm.find(
                                    "select[name='category-color']").val();
                                if (categoryName !== null && categoryName.length != 0) {
                                    $this.$extEvents.append(
                                        '<div class="m-15 external-event bg-' +
                                        categoryColor +
                                        '" data-class="bg-' + categoryColor +
                                        '" style="position: relative;"><i class="fa fa-hand-o-right"></i>' +
                                        categoryName + '</div>')
                                    $this.enableDrag();
                                }

                            });
                        },

                        //init CalendarApp
                        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
                    $.CalendarApp.init()


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
