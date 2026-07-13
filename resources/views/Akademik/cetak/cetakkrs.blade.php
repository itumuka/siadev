<html>
<head>
    <style>
        #qrdowal_container img, #qrdowal_container canvas,
        #qrkaprodi_container img, #qrkaprodi_container canvas {
            width: 60px;
            height: 60px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $nim }}">
    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $tahun }}">
    <input class="form-control" type="hidden" name="semester" id="semester" value="{{ $semester }}">

    <div style='padding-bottom:100px;'>
        {{-- <div style='margin-top:10px;font-size:13px;'>UNIVERSITAS MUHAMMADIYAH
                            KARANGANYAR</div>
        <div style='margin-top:-2px;font-size:13px;'>FAKULTAS $nama_fakultas</div> --}}

        <div class='row'>
            <div class='col-xs-12'>
                <table style='width:100%;font-family:Courier New;'>
                    <tr>
                        <td style='padding-right:10px;width:80px;'><img src='{{ url('imageup45/logoumuka.png') }}'
                                style='width:80px;'></td>
                        <td style='font-size:20px;padding-left:5px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
                            KARANGANYAR
                            <div id='nama_fakultas' style='font-size:20px;margin-top:-5px;'></div>
                            <div
                                style='font-size:10px;border-bottom:1px solid black;padding-bottom:3px;margin-top:-3px;'>
                                Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa
                                Tengah 57722</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style='font-family:Courier New;'>
            <div style='margin-top:10px;text-align:center;'>
                <span style='font-size:20px;'>KARTU RENCANA STUDI</span>
            </div>
            {{-- <div style='text-align:center;font-size:12px;margin-top:-5px;'> {{ $session_nama_tahunakademik }}</div> --}}
            <div style='margin-top:20px;'>
                <table border='0' rules='all0' width='100%' style='line-height:14px;font-size:11px;'>
                    <tr>
                        <td style='width:50px;'>Fakultas</td>
                        <td style='width:10px;'>:</td>
                        <td style='width:120px;'><span class="nama_fakultas"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td style='width:50px;'>NAMA</td>
                        <td style='width:10px;'>:</td>
                        <td style='width:120px;'><span class="namamhs_"></span></td>
                        <td rowspan='4' style='border:1px solid black;height:110px;width:60px;text-align:center;'>
                            Pas
                            Foto<br>3 x 4</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td>:</td>
                        <td><span class="namaprodi_"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>NIM</td>
                        <td>:</td>
                        <td><span class="nim_"></span></td>
                    </tr>
                    <tr>
                        <td>Jenjang</td>
                        <td>:</td>
                        <td><span class="stratanya"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>Tahun Akademik</td>
                        <td>:</td>
                        <td><span>{{ substr($session_nama_tahunakademik, 8, 40) }}</span></td>
                    </tr>
                    <tr>
                        <td>&emsp;</td>
                        <td>&emsp;</td>
                        <td>&emsp;</td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>Pembimbing Akademik</td>
                        <td>:</td>
                        <td><span class="nama_dosen_wali"></span></td>
                    </tr>
                </table>
            </div>

            <div style='margin-top:5px;font-size:11px;'>
                <table border='0' rules='all0' width='100%'
                    style="font-size:11px;border:1px solid black;border-collapse:collapse;">
                    <thead>
                        {{-- <tr>
                            <td colspan='8' style='border-top:2px solid black;'></td>
                        </tr> --}}
                        <tr>
                            <td rowspan='2'
                                style='width:20px;padding-left:5px;padding-top:2px;padding-bottom:2px;text-align:center;border:1px solid black;'>
                                <b>NO</b>
                            </td>
                            <td rowspan='2' style='width:50px;padding-left:5px;border:1px solid black;'><b>Kode</b>
                            </td>
                            <td rowspan='2'
                                style='width:150px;padding-left:5px;text-align:center;border:1px solid black;'>
                                <b>Matakuliah</b>
                            </td>
                            <td rowspan='2' style='width:20px;text-align:center;border:1px solid black;'>
                                <b>Semester</b>
                            </td>
                            <td colspan='2' style='width:10px;text-align:center;border:1px solid black;'>
                                <b>SKS
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td style='width:10px;text-align:center;border:1px solid black;'><b>Teori</b></td>
                            <td style='width:10px;text-align:center;border:1px solid black;'><b>Praktikum</b></td>
                        </tr>

                    </thead>
                    <tbody id="krs">
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan='4'
                                style='text-align:right;padding-right:4px;font-size:11px;text-align:center;border:1px solid black;'>
                                Jumlah SKS
                            </td>
                            <td
                                style='width:30px;text-align:center;font-size:11px;text-align:center;border:1px solid black;'>
                                <span class="totalsksteori"></span>
                            </td>
                            <td
                                style='width:30px;text-align:center;font-size:11px;text-align:center;border:1px solid black;'>
                                <span class="totalsksprak"></span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan='4'
                                style='text-align:right;padding-right:4px;font-size:11px;text-align:center;border:1px solid black;'>
                                <b>Total
                                    SKS</b>
                            </td>
                            <td colspan="2"
                                style='width:30px;text-align:center;font-size:11px;text-align:center;font-weight: bold;border:1px solid black;'>
                                <span class="totalsks"></span>
                            </td>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <div style='margin-top:30px;font-size:11px;'>

                <table border='0' rules='all0' width='100%' style="font-size:12px;">
                    <!--<tr style='font-size:12px;'>-->
                    <!--    <td style='width:100px;'>Direncanakan........... SKS</td>-->
                    <!--    <td colspan="2" style='width:100px;text-align:right;'>Kredit yang dicapai :</td>-->
                    <!--    <td style='text-align:center;'>_______</td>-->
                    <!--</tr>-->
                    <!--<tr style='font-size:12px;'>-->
                    <!--    <td style='width:100px;'>&emsp;</td>-->
                    <!--    <td colspan="2" style='width:100px;text-align:right;'>Prestasi yang dicapai :</td>-->
                    <!--    <td style='text-align:center;'>_______</td>-->
                    <!--</tr>-->
                    <tr style='font-size:12px;'>
                        <td style='width:100px;'>&emsp;</td>
                        <td style='width:100px;'>&emsp;</td>
                        <td style='width:100px;text-align:right;'>
                            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                        </td>
                        <td style='text-align:center;'>&emsp;</td>
                    </tr>
                    <tr style='font-size:12px;'>
                        <td colspan="2" style='width:50%;text-align:center;'>Mengetahui</td>
                        <td colspan="2" style='width:50%;text-align:center;'>Karanganyar, <span
                                id="tanggalwaktu"></span></td>
                    </tr>
                    <tr style='font-size:12px;'>
                        <td style='width:150px;text-align:center;'>Pembimbing Akademik</td>
                        <td style='width:150px;text-align:center;'>Ketua Program Studi</td>
                        <td colspan="2" style='width:200px;text-align:center;'>Mahasiswa</td>
                    </tr>
                    <tr>
                        <td style='width:50%;text-align:center;height:70px;'>
                            <div id="qrdowal_container" style="width: 60px; height: 60px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                <img id="img_qrdowal" style="width: 60px; height: 60px; display: none;" />
                            </div>
                            <small><b>valid_id : <span id="text_qrdowal">-</span></b></small>
                        </td>
                        <td style='width:50%;text-align:center;height:70px;'>
                            <div id="qrkaprodi_container" style="width: 60px; height: 60px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
                                <img id="img_qrkaprodi" style="width: 60px; height: 60px; display: none;" />
                            </div>
                            <small><b>valid_id : <span id="text_qrkaprodi">-</span></b></small>
                        </td>
                        <td colspan="2" style='width:50%;text-align:center;height:70px;'></td>
                    </tr>
                    <tr>
                        <td style='width:50%;text-align:center;font-size:12px;'>( <span
                                class="nama_dosen_wali"></span>
                            )</td>
                        <td style='width:50%;text-align:center;font-size:12px;'>( <span class="namakaprodi"></span>
                            )</td>
                        <td colspan="2" style='width:50%;text-align:center;font-size:12px;'>(<span
                                class="namamhs_"></span>)</td>
                    </tr>
                </table>

            </div>
            <div style='margin-top:30px;font-size:11px;'>
                <table border='0' rules='all0' width='100%'
                    style="font-size:11px;border:1px solid black;border-collapse:collapse;">
                    <thead>
                        <tr>
                            <td rowspan='2'
                                style='width:20px;padding-left:5px;padding-top:2px;padding-bottom:2px;text-align:center;border:1px solid black;'>
                                <b>NO</b>
                            </td>
                            <td rowspan='2'
                                style='width:20px;padding-left:5px;border:1px solid black;text-align:center;'>
                                <b>Kode</b>
                            </td>
                            <td rowspan='2'
                                style='width:100px;padding-left:5px;text-align:center;font-weight: bold;border:1px solid black;'>
                                <b>Nama Dosen</b>
                            </td>
                            <td colspan="16"
                                style='padding-left:5px;text-align:center;font-weight: bold;border:1px solid black;'>
                                Paraf
                                Dosen</td>

                        </tr>
                        <tr>
                            @php
                                for ($i = 1; $i < 17; $i++) {
                                    echo '<td style="font-weight: bold;border:1px solid black;text-align:center;width:13px;">' . $i . '</td>';
                                }
                            @endphp
                        </tr>
                        {{-- <tr>
                            <td colspan='8' style='border-top:1px solid black;'></td>
                        </tr> --}}
                    </thead>
                    <tbody id="krsbawah">
                    </tbody>
                    <tfoot>

                    </tfoot>

                </table>
            </div>
        </div>
    </div>
    <!-- Hidden container to generate QR codes silently before printing -->
    <div id="qrcode_generators" style="display: none;">
        <div id="gen_qrdowal"></div>
        <div id="gen_qrkaprodi"></div>
    </div>
</body>

</html>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('js/qrcode.js') }}"></script>
<script>
    $(document).ready(function() {
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var tw = new Date();
        if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
        else(a = tw.getTime());
        tw.setTime(a);
        var tahun = tw.getFullYear();
        var bulan = tw.getMonth();
        var tanggal = tw.getDate();
        var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "Nopember", "Desember");
        document.getElementById("tanggalwaktu").innerHTML = tanggal + " " + bulanarray[bulan] + " " + tahun;

        var nim = $('#nim').val();
        var tahun = $('#tahun').val();
        var semester = $('#semester').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}akademik/get-mhs",
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data: {
                nim: nim
            },
            success: function(result) {
                console.log(result);
                $('.nim_').html(result.nim);
                $('.namaprodi_').html(result.nama_program_studi);
                $('.namamhs_').html(result.nama_mahasiswa);
                if (result.kode_jenjang_pendidikan == "2") {
                    $('.stratanya').html("Sarjana");
                } else if(result.kode_jenjang_pendidikan == "5") {
                    $('.stratanya').html("Diploma 4");
                } else {
                    $('.stratanya').html("Diploma 3");
                }
                
                // Generate Kaprodi QR Code
                if (result.valididprodi) {
                    $('#text_qrkaprodi').html(result.valididprodi);
                    let qrKaprodiText = `VALID ID: ${result.valididprodi}\n` +
                                        `Pengesahan Kaprodi\n` +
                                        `Mhs: ${(result.nama_mahasiswa || '').substring(0, 35)} (${result.nim || ''})\n` +
                                        `Prodi: ${(result.nama_program_studi || '').substring(0, 35)}\n` +
                                        `Kaprodi: ${(result.namaprodi || '').substring(0, 35)}`;

                    new QRCode(document.getElementById("gen_qrkaprodi"), {
                        text: qrKaprodiText,
                        width: 120,
                        height: 120,
                        correctLevel: QRCode.CorrectLevel.M
                    });
                } else {
                    $('#text_qrkaprodi').html('-');
                }

                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: "{{ config('setting.second_url') }}mahasiswa/cekhereg",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        nim: nim,
                        tahun: tahun,
                        semester: semester,
                    },
                    success: function(resulthereg) {
                        console.log(resulthereg);
                        
                        // Generate Dosen Wali QR Code
                        if (resulthereg.valid_id) {
                            $('#text_qrdowal').html(resulthereg.valid_id);
                            let qrDowalText = `VALID ID: ${resulthereg.valid_id}\n` +
                                               `Persetujuan Dosen Wali\n` +
                                               `Mhs: ${(result.nama_mahasiswa || '').substring(0, 35)} (${result.nim || ''})\n` +
                                               `Dosen Wali: ${(result.dosen_wali || '').substring(0, 35)}`;

                            new QRCode(document.getElementById("gen_qrdowal"), {
                                text: qrDowalText,
                                width: 120,
                                height: 120,
                                correctLevel: QRCode.CorrectLevel.M
                            });
                        } else {
                            $('#text_qrdowal').html('-');
                        }
                        
                        get_data_krs(result, resulthereg);
                    }
                });

                $('.nama_fakultas').html('FAKULTAS ' + result.nama_fakultas.toUpperCase());
                $('.namakaprodi').html(result.namaprodi.toUpperCase());
                $('.nama_dosen_wali').html((result.dosen_wali == null || result.dosen_wali == '') ?
                    '......................' : result.dosen_wali.toUpperCase());
            }
        });


        function get_data_krs(result, resulthereg) {
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/cetak-krs",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim,
                    tahun: tahun,
                    semester: semester
                },
                success: function(data) {
                    var jml = data.length;

                    var no = 1;
                    var nobawah = 1;
                    var tampil = '';
                    var tampilbawah = '';
                    var totalsks = 0;
                    var totalsksteori = 0;
                    var totalsksprak = 0;
                    for (var i = 0; i < jml; i++) {
                        tampil = tampil +
                            '<tr style="font-size:12px;"><td style="text-align:center;border:1px solid black;">' +
                            no + '</td><td style="padding-left:5px;border:1px solid black;">' +
                            data[i].kode_matakuliah +
                            '</td><td style="padding-left:5px;border:1px solid black;">' + data[i]
                            .nama_matakuliah +
                            '</td><td style="text-align:center;border:1px solid black;">' + data[i]
                            .smt_matakuliah +
                            '</td><td style="text-align:center;border:1px solid black;">' + data[i]
                            .sks_teori +
                            '</td><td style="text-align:center;border:1px solid black;">' + data[i]
                            .sks_praktikum +
                            '</td></tr>';
                        no++;
                        totalsks += parseFloat(data[i].sks_matakuliah);
                        totalsksteori += parseFloat(data[i].sks_teori);
                        totalsksprak += parseFloat(data[i].sks_praktikum);
                    }
                    for (var i = 0; i < jml; i++) {
                        var stringnya = "";
                        for (var j = 0; j < 16; j++) {
                            stringnya = stringnya + "<td style='border:1px solid black;'></td>";
                        }
                        tampilbawah = tampilbawah +
                            '<tr style="font-size:12px;"><td style="text-align:center;border:1px solid black;">' +
                            nobawah + '</td><td style="padding-left:5px;border:1px solid black;">' +
                            data[i]
                            .kode_matakuliah +
                            '</td><td style="padding-left:5px;border:1px solid black;">' + data[i]
                            .nama_dosen +
                            ' ' + stringnya + '</tr>';
                        nobawah++;
                    }
                    $('#krs').html(tampil);
                    $('#krsbawah').html(tampilbawah);

                    $('.totalsks').html(totalsks);
                    $('.totalsksprak').html(totalsksprak);
                    $('.totalsksteori').html(totalsksteori);
                    console.log(tampil);
                    
                    // Copy generated QR Code image sources to print preview and print
                    setTimeout(function() {
                        if (resulthereg && resulthereg.valid_id) {
                            const qrImg = document.querySelector('#gen_qrdowal img');
                            if (qrImg && qrImg.src) {
                                $('#img_qrdowal').attr('src', qrImg.src).show();
                            }
                        }
                        if (result && result.valididprodi) {
                            const qrImg = document.querySelector('#gen_qrkaprodi img');
                            if (qrImg && qrImg.src) {
                                $('#img_qrkaprodi').attr('src', qrImg.src).show();
                            }
                        }
                        window.print();
                    }, 500);
                }
            });
        }
    });
</script>