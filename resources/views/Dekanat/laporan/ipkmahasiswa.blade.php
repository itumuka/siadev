@extends('layout')

@section('css')
    <style>
        th,
        td {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $title }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Pilih program studi untuk melihat laporan.</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <input type="hidden" name="kode_fak" id="kode_fak" value="{{ $session_kode_fakultas }}">
                    <div class="row" id="tampilan_prodi">

                    </div>
                </div>
                <!-- /.box-body -->
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

            function tampilan_prodi(id) {
                $.ajax({
                    type: 'GET',
                    data: {
                        kode_fakultas: id
                    },
                    url: "{{ config('setting.second_url') }}akademik/programstudi-fak",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            s = s +
                                '<div class="col-xl-3"><a href="{{ url('dekanat/laporan/detail-ipk-mhs') }}/' +
                                result[i].kode_program_studi +
                                '" class="box bg-primary-light"><div class="box-body"><i class="text-primary fa fa-address-book-o font-size-40"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i><div class="text-primary font-weight-600 font-size-18 mb-2 mt-5">Program Studi</div><div class="text-mute font-size-16">' +
                                result[i]
                                .nama_program_studi + '</div></div></a></div>'
                        }
                        // console.log(result);
                        $('#tampilan_prodi').html(s);
                    }
                })
            }
            var kd = $('#kode_fak').val();
            tampilan_prodi(kd);


        });
    </script>
@stop
