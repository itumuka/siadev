<html>
@php
    $pecah = explode('-', $nim);
@endphp

@php $top=count($pecah); @endphp

<body>
    <input class="form-control" type="hidden" name="nimjamak" id="nimjamak" value="{{ $nim }}">
    <input type="hidden" name="lutane" id="lutane" value="0">
    <input type="hidden" name="topane" id="topane" value="{{ $top }}">
    <input class="form-control" type="hidden" name="patokan" id="patokan" value="{{ $pecah[$top - 1] }}">
    @foreach ($pecah as $row)
        <input class="form-control" type="hidden" name="nim" id="nim{{ $row }}"
            value="{{ $row }}">
        <div class='row'>
            <div class='col-xs-12'>
                <table border='0' rules='all0' style='width:100%;'>
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
        <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $row }}">

        <div style='font-family:Arial, sans-serif;height:850px;'>
            <div style='margin-top:15px;text-align:center;'>
                <div style='font-size:18px;font-weight:bold;text-transform:uppercase;'>TRANSKRIP AKADEMIK</div>
                <div style='font-size:13px;font-style:italic;margin-top:1px;color:#333;'>Academic Transcript</div>
                <div style='font-size:11px;margin-top:3px;font-weight:bold;'>Nomor (Number) : <span class="no_transkrip_val{{ $row }}"></span></div>
            </div>

            <div style='margin-top:15px;'>
                <table border='0' width='100%' style='font-size:11px;line-height:14px;border-collapse:collapse;'>
                    <tr>
                        <td style='width:180px;vertical-align:top;'>
                            Nama Mahasiswa<br><span style="font-style:italic;font-size:9px;color:#555;">Full Name</span>
                        </td>
                        <td style='width:10px;vertical-align:top;'>:</td>
                        <td style='vertical-align:top;font-weight:bold;'><span class="nama_mhs{{ $row }}"></span></td>
                        
                        <td style='width:180px;vertical-align:top;padding-left:20px;'>
                            Program Pendidikan<br><span style="font-style:italic;font-size:9px;color:#555;">Education Program</span>
                        </td>
                        <td style='width:10px;vertical-align:top;'>:</td>
                        <td style='vertical-align:top;'><span class="jenjang_val{{ $row }}"></span><br><span class="jenjang_en_val{{ $row }}" style="font-style:italic;font-size:10px;color:#555;"></span></td>
                    </tr>
                    <tr style="height:6px;"><td colspan="6"></td></tr>
                    <tr>
                        <td style='vertical-align:top;'>
                            Nomor Induk Mahasiswa<br><span style="font-style:italic;font-size:9px;color:#555;">Student Number</span>
                        </td>
                        <td style='vertical-align:top;'>:</td>
                        <td style='vertical-align:top;font-weight:bold;'><span class="nim{{ $row }}">{{ $row }}</span></td>
                        
                        <td style='vertical-align:top;padding-left:20px;'>
                            Program Studi<br><span style="font-style:italic;font-size:9px;color:#555;">Study Program</span>
                        </td>
                        <td style='vertical-align:top;'>:</td>
                        <td style='vertical-align:top;'><span class="program_studi{{ $row }}"></span><br><span class="program_studi_en_val{{ $row }}" style="font-style:italic;font-size:10px;color:#555;"></span></td>
                    </tr>
                    <tr style="height:6px;"><td colspan="6"></td></tr>
                    <tr>
                        <td style='vertical-align:top;'>
                            Tempat dan Tanggal Lahir<br><span style="font-style:italic;font-size:9px;color:#555;">Place and Date of Birth</span>
                        </td>
                        <td style='vertical-align:top;'>:</td>
                        <td style='vertical-align:top;'><span class="tempat_tgl_lahir_val{{ $row }}"></span><br><span class="tempat_tgl_lahir_en_val{{ $row }}" style="font-style:italic;font-size:10px;color:#555;"></span></td>
                        
                        <td style='vertical-align:top;padding-left:20px;'>
                            Gelar Akademik<br><span style="font-style:italic;font-size:9px;color:#555;">Academic Degree Awarded</span>
                        </td>
                        <td style='vertical-align:top;'>:</td>
                        <td style='vertical-align:top;font-weight:bold;'><span class="gelar_val{{ $row }}"></span><br><span class="gelar_en_val{{ $row }}" style="font-style:italic;font-size:10px;color:#555;font-weight:normal;"></span></td>
                    </tr>
                    <tr style="height:6px;"><td colspan="6"></td></tr>
                    <tr>
                        <td style='vertical-align:top;'>
                            &nbsp;
                        </td>
                        <td style='vertical-align:top;'>&nbsp;</td>
                        <td style='vertical-align:top;'>&nbsp;</td>
                        
                        <td style='vertical-align:top;padding-left:20px;'>
                            Tanggal Kelulusan<br><span style="font-style:italic;font-size:9px;color:#555;">Date of Graduation</span>
                        </td>
                        <td style='vertical-align:top;'>:</td>
                        <td style='vertical-align:top;'><span class="tgl_lulus_val{{ $row }}"></span><br><span class="tgl_lulus_en_val{{ $row }}" style="font-style:italic;font-size:10px;color:#555;"></span></td>
                    </tr>
                </table>
            </div>

            <div style='font-size:9px;padding-top:10px;'>
                <table border='0' width='100%' style='border-collapse:collapse;'>
                    <tr>
                        <td style='width:50%;padding-right:8px;vertical-align:top;'>
                            <table border='0' width='100%' style='line-height:12px;border-collapse:collapse;'>
                                <thead>
                                    <tr style='font-size:8px;font-weight:bold;background-color:#f5f7fa;text-align:center;'>
                                        <td style='width:25px;border:1px solid #000;padding:5px 2px;'>NO</td>
                                        <td style='width:125px;border:1px solid #000;padding:5px 2px;'>MATA KULIAH<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">COURSE</span></td>
                                        <td style='width:125px;border:1px solid #000;padding:5px 2px;'>COURSE<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">(Translation)</span></td>
                                        <td style='width:30px;border:1px solid #000;padding:5px 2px;'>KREDIT<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">Credit</span></td>
                                        <td style='width:35px;border:1px solid #000;padding:5px 2px;'>NILAI ANGKA<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">Score</span></td>
                                        <td style='width:35px;border:1px solid #000;padding:5px 2px;'>NILAI HURUF<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">Grade</span></td>
                                    </tr>
                                </thead>
                                <tbody id="transkipnilai{{ $row }}">
                                </tbody>
                            </table>
                        </td>
                        <td style='width:50%;padding-left:8px;vertical-align:top;'>
                            <table border='0' width='100%' style='line-height:12px;border-collapse:collapse;'>
                                <thead>
                                    <tr style='font-size:8px;font-weight:bold;background-color:#f5f7fa;text-align:center;'>
                                        <td style='width:25px;border:1px solid #000;padding:5px 2px;'>NO</td>
                                        <td style='width:125px;border:1px solid #000;padding:5px 2px;'>MATA KULIAH<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">COURSE</span></td>
                                        <td style='width:125px;border:1px solid #000;padding:5px 2px;'>COURSE<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">(Translation)</span></td>
                                        <td style='width:30px;border:1px solid #000;padding:5px 2px;'>KREDIT<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">Credit</span></td>
                                        <td style='width:35px;border:1px solid #000;padding:5px 2px;'>NILAI ANGKA<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">Score</span></td>
                                        <td style='width:35px;border:1px solid #000;padding:5px 2px;'>NILAI HURUF<br><span style="font-size:7px;font-style:italic;font-weight:normal;color:#555;">Grade</span></td>
                                    </tr>
                                </thead>
                                <tbody id="transkipnilai1{{ $row }}">
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <div style='font-size:11px;padding-top:15px;font-family:Arial, sans-serif;'>
                <table border='0' width='100%' style='line-height:14px;border-collapse:collapse;'>
                    <tr style='border-top:2px solid black;border-bottom:2px solid black;'>
                        <td style='width:50%;font-style:italic;color:#555;padding:8px 0;vertical-align:top;'>
                            Transkrip ini dibuat dengan sebenarnya.<br>
                            <span style="font-size:10px;font-weight:normal;color:#666;">All information on this transcript is true and accurate.</span>
                        </td>
                        <td style='width:50%;padding:8px 0 8px 20px;vertical-align:top;'>
                            <div style="font-weight:bold;font-size:11px;">
                                Jumlah Seluruh Kredit = <span class="totalsks_val{{ $row }}"></span> &nbsp;&nbsp;&nbsp;&nbsp; IPK : <span class="totalipk_val{{ $row }}"></span> (<span class="predikat_val{{ $row }}"></span>)
                            </div>
                            <div style="font-style:italic;font-size:10px;color:#555;margin-top:2px;">
                                Total number of credit attempted = <span class="totalsks_val{{ $row }}"></span> &nbsp;&nbsp;&nbsp;&nbsp; GPA (Grade Point Average) : <span class="totalipk_val{{ $row }}"></span> (<span class="predikat_en_val{{ $row }}"></span>)
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div style='float:right;margin-top:15px;font-family:Arial, sans-serif;'>
                <table border='0' style='line-height:14px;font-size:11px;'>
                    <tr>
                        <td>Karanganyar, <span class="tgl_cetak_val{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Dekan,<br><span style="font-style:italic;font-size:10px;font-weight:normal;color:#555;">Dean,</span></td>
                    </tr>
                    <tr>
                        <td style='height:45px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;text-decoration:underline;"><span class="dekan_name_val{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>NIP. <span class="dekan_nip_val{{ $row }}"></span></td>
                    </tr>
                </table>
            </div>
            <div style='page-break-after:always'></div>
        </div>
    @endforeach
</body>

</html>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>

@foreach ($pecah as $row)
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

            // Prodi Bilingual Mapping
            function getProdiDetails(kode_prodi, nama_indo) {
                var details = {
                    nama_en: nama_indo,
                    jenjang_id: 'Sarjana',
                    jenjang_en: "Bachelor's Degree",
                    gelar_id: 'S.Kom.',
                    gelar_en: 'Bachelor of Computer Science'
                };

                switch(kode_prodi) {
                    case 'IK04':
                        details.nama_en = 'Communication Science';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.I.Kom.';
                        details.gelar_en = 'Bachelor of Communication Science';
                        break;
                    case 'PT10':
                        details.nama_en = 'Livestock Production';
                        details.jenjang_id = 'Diploma Tiga';
                        details.jenjang_en = "Associate's Degree";
                        details.gelar_id = 'A.Md.Pt.';
                        details.gelar_en = 'Associate of Livestock';
                        break;
                    case 'TK01':
                        details.nama_en = 'Computer Engineering';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.T.';
                        details.gelar_en = 'Bachelor of Engineering';
                        break;
                    case 'FT06':
                        details.nama_en = 'Physiotherapy';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.Ft.';
                        details.gelar_en = 'Bachelor of Physiotherapy';
                        break;
                    case 'IF02':
                        details.nama_en = 'Informatics';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.Kom.';
                        details.gelar_en = 'Bachelor of Computer Science';
                        break;
                    case 'PH07':
                        details.nama_en = 'Hospitality';
                        details.jenjang_id = 'Diploma Tiga';
                        details.jenjang_en = "Associate's Degree";
                        details.gelar_id = 'A.Md.Par.';
                        details.gelar_en = 'Associate of Hospitality';
                        break;
                    case 'BD03':
                        details.nama_en = 'Digital Business';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.B.D.';
                        details.gelar_en = 'Bachelor of Digital Business';
                        break;
                    case 'AK05':
                        details.nama_en = 'Accounting';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.Ak.';
                        details.gelar_en = 'Bachelor of Accounting';
                        break;
                    case 'PN11':
                        details.nama_en = 'Animal Husbandry';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.Pt.';
                        details.gelar_en = 'Bachelor of Animal Science';
                        break;
                    case 'BW08':
                        details.nama_en = 'Tourism Development';
                        details.jenjang_id = 'Diploma Tiga';
                        details.jenjang_en = "Associate's Degree";
                        details.gelar_id = 'A.Md.Par.';
                        details.gelar_en = 'Associate of Tourism';
                        break;
                    case 'APH12':
                        details.nama_en = 'Acupuncture and Herbal Medicine';
                        details.jenjang_id = 'Sarjana Terapan';
                        details.jenjang_en = "Bachelor of Applied Science";
                        details.gelar_id = 'S.Tr.Kes.';
                        details.gelar_en = 'Bachelor of Applied Health';
                        break;
                    case 'PKO14':
                        details.nama_en = 'Physical Education, Health and Recreation';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.Pd.';
                        details.gelar_en = 'Bachelor of Education';
                        break;
                    case 'PBA15':
                        details.nama_en = 'Arabic Language Education';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.Pd.';
                        details.gelar_en = 'Bachelor of Education';
                        break;
                    case 'HB13':
                        details.nama_en = 'Business Law';
                        details.jenjang_id = 'Sarjana';
                        details.jenjang_en = "Bachelor's Degree";
                        details.gelar_id = 'S.H.';
                        details.gelar_en = 'Bachelor of Laws';
                        break;
                    case 'KA16':
                        details.nama_en = 'Anesthesiology Nursing';
                        details.jenjang_id = 'Sarjana Terapan';
                        details.jenjang_en = "Bachelor of Applied Science";
                        details.gelar_id = 'S.Tr.Kep.';
                        details.gelar_en = 'Bachelor of Applied Nursing';
                        break;
                    case 'TRP17':
                        details.nama_en = 'Radiology Technology and Imaging';
                        details.jenjang_id = 'Sarjana Terapan';
                        details.jenjang_en = "Bachelor of Applied Science";
                        details.gelar_id = 'S.Tr.Kes.';
                        details.gelar_en = 'Bachelor of Applied Science in Radiology';
                        break;
                    case 'KEB18':
                        details.nama_en = 'Midwifery';
                        details.jenjang_id = 'Diploma Tiga';
                        details.jenjang_en = "Associate's Degree";
                        details.gelar_id = 'A.Md.Keb.';
                        details.gelar_en = 'Associate of Midwifery';
                        break;
                }
                return details;
            }

            // Date Conversion
            function formatBilingualDate(dateStr) {
                if (!dateStr) return { id: '-', en: '-' };
                var parts = dateStr.split('-');
                var day, month, year;
                if (parts[0].length === 4) {
                    year = parseInt(parts[0], 10);
                    month = parseInt(parts[1], 10) - 1;
                    day = parseInt(parts[2], 10);
                } else {
                    day = parseInt(parts[0], 10);
                    month = parseInt(parts[1], 10) - 1;
                    year = parseInt(parts[2], 10);
                }
                var date = new Date(year, month, day);
                if (isNaN(date.getTime())) return { id: dateStr, en: dateStr };
                var idMonths = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                var enMonths = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var idStr = day + " " + idMonths[month] + " " + year;
                var suffix = "th";
                if (day === 1 || day === 21 || day === 31) suffix = "st";
                else if (day === 2 || day === 22) suffix = "nd";
                else if (day === 3 || day === 23) suffix = "rd";
                var enStr = enMonths[month] + " " + day + suffix + ", " + year;
                return { id: idStr, en: enStr };
            }

            // GPA Predicate
            function getGpaPredicate(gpa) {
                var val = parseFloat(gpa);
                if (isNaN(val)) return { id: '-', en: '-' };
                if (val >= 3.51) return { id: 'Dengan Pujian (Cum Laude)', en: 'Cum Laude' };
                else if (val >= 3.00) return { id: 'Sangat Memuaskan', en: 'Very Satisfactory' };
                else if (val >= 2.76) return { id: 'Memuaskan', en: 'Satisfactory' };
                else return { id: 'Cukup', en: 'Sufficient' };
            }


            var nim = $('#nim{{ $row }}').val();

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/cetaktranskipnilaikurikulum",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                },
                success: function(data) {
                    var jml = data.length;

                    var cek = jml % 2;
                    var hasil = jml / 2;
                    var limit_1 = hasil;
                    var limit_2 = hasil;
                    var limit_1_f = 0;
                    var limit_2_f = 0;
                    if (cek == 0) {
                        limit_1_f = limit_1;
                    } else {
                        limit_1_f = Math.ceil(limit_1);
                    }

                    var no = 1;
                    var tampil = '';
                    var tampil2 = '';
                    var totalsks = 0;
                    var totalbobot = 0;
                    var totalipk = 0;
                    var nilaid = 0;
                    var nilaie = 0;

                    for (var i = 0; i < limit_1_f; i++) {
                        var nilai = "";
                        if (data[i].nilai_huruf_akhir == null) {
                            nilai = "-";
                        } else {
                            nilai = data[i].nilai_huruf_akhir;
                            var scoreVal = parseFloat(data[i].mutu);
                            var scoreText = isNaN(scoreVal) ? '-' : scoreVal.toFixed(2);
                            var bobot = data[i].sks_matakuliah * data[i].mutu;
                            totalsks += data[i].sks_matakuliah;
                            totalbobot += bobot;
                            totalipk = totalbobot / totalsks;
                        }
                        if (data[i].nilai_huruf_akhir == "D") {
                            nilaid = nilaid + 1;
                        } else if (data[i].nilai_huruf_akhir == "E") {
                            nilaie = nilaie + 1;
                        }
                        var courseEn = data[i].nama_matakuliah_inggris ? data[i].nama_matakuliah_inggris : '';
                        tampil = tampil + '<tr style="font-size:9px; height:18px;">' +
                            '<td style="text-align:center; border:1px solid #000; padding:2px 4px;">' + no + '</td>' +
                            '<td style="padding-left:5px; border:1px solid #000; padding:2px 4px;">' + data[i].nama_matakuliah + '</td>' +
                            '<td style="padding-left:5px; font-style:italic; color:#555; border:1px solid #000; padding:2px 4px;">' + courseEn + '</td>' +
                            '<td style="text-align:center; border:1px solid #000; padding:2px 4px;">' + data[i].sks_matakuliah + '</td>' +
                            '<td style="text-align:center; border:1px solid #000; padding:2px 4px;">' + scoreText + '</td>' +
                            '<td style="text-align:center; font-weight:bold; border:1px solid #000; padding:2px 4px;">' + nilai + '</td>' +
                            '</tr>';
                        no++;
                    }
                    for (var i = limit_1_f; i < jml; i++) {
                        var nilai = "";
                        if (data[i].nilai_huruf_akhir == null) {
                            nilai = "-";
                        } else {
                            nilai = data[i].nilai_huruf_akhir;
                            var scoreVal = parseFloat(data[i].mutu);
                            var scoreText = isNaN(scoreVal) ? '-' : scoreVal.toFixed(2);
                            var bobot = data[i].sks_matakuliah * data[i].mutu;
                            totalsks += data[i].sks_matakuliah;
                            totalbobot += bobot;
                            totalipk = totalbobot / totalsks;
                        }
                        if (data[i].nilai_huruf_akhir == "D") {
                            nilaid = nilaid + 1;
                        } else if (data[i].nilai_huruf_akhir == "E") {
                            nilaie = nilaie + 1;
                        }
                        var courseEn = data[i].nama_matakuliah_inggris ? data[i].nama_matakuliah_inggris : '';
                        tampil2 = tampil2 + '<tr style="font-size:9px; height:18px;">' +
                            '<td style="text-align:center; border:1px solid #000; padding:2px 4px;">' + no + '</td>' +
                            '<td style="padding-left:5px; border:1px solid #000; padding:2px 4px;">' + data[i].nama_matakuliah + '</td>' +
                            '<td style="padding-left:5px; font-style:italic; color:#555; border:1px solid #000; padding:2px 4px;">' + courseEn + '</td>' +
                            '<td style="text-align:center; border:1px solid #000; padding:2px 4px;">' + data[i].sks_matakuliah + '</td>' +
                            '<td style="text-align:center; border:1px solid #000; padding:2px 4px;">' + scoreText + '</td>' +
                            '<td style="text-align:center; font-weight:bold; border:1px solid #000; padding:2px 4px;">' + nilai + '</td>' +
                            '</tr>';
                        no++;
                    }
                    
                    $('#transkipnilai{{ $row }}').html(tampil);
                    $('#transkipnilai1{{ $row }}').html(tampil2);

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{ config('setting.second_url') }}akademik/get-transkipnilai",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim
                        },
                        success: function(result) {
                            console.log(result);
                            
                            var prodi = getProdiDetails(result[0].kode_program_studi, result[0].nama_program_studi);
                            
                            $('.nama_mhs{{ $row }}').html(result[0].nama_mahasiswa);
                            $('.nim{{ $row }}').html(nim);
                            $('.program_studi{{ $row }}').html(result[0].nama_program_studi);
                            $('.program_studi_en_val{{ $row }}').html(prodi.nama_en);
                            
                            $('.jenjang_val{{ $row }}').html(prodi.jenjang_id);
                            $('.jenjang_en_val{{ $row }}').html(prodi.jenjang_en);
                            
                            $('.gelar_val{{ $row }}').html(prodi.gelar_id);
                            $('.gelar_en_val{{ $row }}').html(prodi.gelar_en);
                            
                            var birthDate = formatBilingualDate(result[0].tanggal_lahir);
                            $('.tempat_tgl_lahir_val{{ $row }}').html(result[0].tempat_lahir + ", " + birthDate.id);
                            $('.tempat_tgl_lahir_en_val{{ $row }}').html(result[0].tempat_lahir + ", " + birthDate.en);
                            
                            var gradDate = formatBilingualDate(result[0].tanggal_lulus);
                            $('.tgl_lulus_val{{ $row }}').html(gradDate.id);
                            $('.tgl_lulus_en_val{{ $row }}').html(gradDate.en);
                            
                            $('.totalsks_val{{ $row }}').html(totalsks);
                            $('.totalipk_val{{ $row }}').html(totalipk.toFixed(2));
                            
                            var pred = getGpaPredicate(totalipk);
                            $('.predikat_val{{ $row }}').html(pred.id);
                            $('.predikat_en_val{{ $row }}').html(pred.en);
                            
                            $('.dekan_name_val{{ $row }}').html(result[0].namadekan || 'Ir. Puji Astuti, M.P.');
                            $('.dekan_nip_val{{ $row }}').html(result[0].nipdekan || '19610524 198803 2 001');
                            
                            var printDate = formatBilingualDate(tanggal + "-" + (bulan + 1) + "-" + tahun);
                            $('.tgl_cetak_val{{ $row }}').html(printDate.id + " / " + printDate.en);
                            
                            var noTrans = result[0].no_transkrip ? result[0].no_transkrip : '-';
                            $('.no_transkrip_val{{ $row }}').html(noTrans);

                            var ambil = $('#lutane').val();
                            var hasil = parseInt(ambil) + 1;
                            $('#lutane').val(hasil);
                            if (hasil == $('#topane').val()) {
                                window.print();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endforeach

