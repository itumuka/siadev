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
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li> --}}
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
                    <h6 class="box-subtitle">Import Data PMB</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Data di bawah ini secara realtime ditampilkan dari aplikasi Penerimaan
                                Mahasiswa Baru (PMB). Admin hanya dapat melakukan klik untuk melakukan import ke dalam Smart
                                System. Untuk membatalkan import/hapus dengan masuk ke menu Daftar Calon Mahasiswa Baru.</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="box-header no-border">
                        <div class="col-xl-4 col-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title">Pie Chart</h4>
                                </div>
                                <div class="box-body">
                                    <div id="pie-chart"></div>
                                </div>
                            </div>
                        </div>
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
        $(function() {
            "use strict";
            var o = c3.generate({
                bindto: "#pie-chart",
                color: {
                    pattern: ['#38649f', '#389f99', '#ee1044']
                },
                data: {
                    columns: [
                        ['data1', 30],
                        ['data2', 130],
                        ['data3', 10]
                    ],
                    type: "pie",
                    onclick: function(o, n) {
                        console.log("onclick", o, n)
                    },
                    onmouseover: function(o, n) {
                        console.log("onmouseover", o, n)
                    },
                    onmouseout: function(o, n) {
                        console.log("onmouseout", o, n)
                    }
                }
            });
            setTimeout(function() {
                o.load({
                    columns: [
                        ["setosa_x", 3.5, 3.0, 3.2, 3.1, 3.6, 3.9, 3.4, 3.4, 2.9, 3.1, 3.7, 3.4,
                            3.0, 3.0, 4.0, 4.4, 3.9, 3.5, 3.8, 3.8, 3.4, 3.7, 3.6, 3.3, 3.4,
                            3.0, 3.4, 3.5, 3.4, 3.2, 3.1, 3.4, 4.1, 4.2, 3.1, 3.2, 3.5, 3.6,
                            3.0, 3.4, 3.5, 2.3, 3.2, 3.5, 3.8, 3.0, 3.8, 3.2, 3.7, 3.3
                        ],
                        ["versicolor_x", 3.2, 3.2, 3.1, 2.3, 2.8, 2.8, 3.3, 2.4, 2.9, 2.7, 2.0,
                            3.0, 2.2, 2.9, 2.9, 3.1, 3.0, 2.7, 2.2, 2.5, 3.2, 2.8, 2.5, 2.8,
                            2.9, 3.0, 2.8, 3.0, 2.9, 2.6, 2.4, 2.4, 2.7, 2.7, 3.0, 3.4, 3.1,
                            2.3, 3.0, 2.5, 2.6, 3.0, 2.6, 2.3, 2.7, 3.0, 2.9, 2.9, 2.5, 2.8
                        ],
                        ["setosa", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2,
                            0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2,
                            0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1,
                            0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2
                        ]
                    ]
                })
            }, 1500), setTimeout(function() {
                o.unload({
                    ids: "data1"
                }), o.unload({
                    ids: "data2"
                }), o.unload({
                    ids: "data3"
                })
            }, 2500)

        });
    </script>
@stop
