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
                <table border='0' style='width:100%; border-collapse:collapse;'>
                    <tr>
                        <td style='padding-right:15px; width:95px; vertical-align:middle; text-align:center;'>
                            <img src='{{ url('imageup45/logoumuka.png') }}' style='width:95px;'>
                        </td>
                        <td style='text-align:center; font-family:Arial, sans-serif; padding-left: 10px; line-height: 14px;'>
                            <div style="font-size:20px; font-weight:bold; color:#000; letter-spacing: 0.5px;">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
                            <div style="font-size:15px; font-weight:bold; color:#000; margin-top:3px; text-transform: uppercase;">FAKULTAS <span class="nama_fakultas_val{{ $row }}"></span></div>
                            <div style="font-size:13px; font-weight:bold; font-style:italic; color:#555; margin-top:1px;"><span class="nama_fakultas_en_val{{ $row }}"></span></div>
                            <div style="font-size:9px; color:#333; margin-top:3px; font-weight: normal;">Jalan Raya Solo-Tawangmangu KM 12 Papahan Tasikmadu Karanganyar</div>
                            <div style="font-size:9px; color:#333; margin-top:1px; font-weight: normal;">website : www.umuka.ac.id, email: umuka@umuka.ac.id</div>
                            <div style="font-size:9px; color:#333; margin-top:1px; font-weight: normal;">Telepon (0271)6498851, 4993819, Admin 08112801912 (57761)</div>
                        </td>
                    </tr>
                </table>
                <hr style="border: 0; border-top: 4px double #000; margin-top: 8px; margin-bottom: 12px;">
            </div>
        </div>
        <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $row }}">

        <div style='font-family:Arial, sans-serif; min-height:850px; margin-bottom: 20px;'>
            <div style='text-align:center;'>
                <div style='font-size:18px;font-weight:bold;text-transform:uppercase;font-family:Arial, sans-serif;'>TRANSKRIP AKADEMIK</div>
                <div style='font-size:13px;font-style:italic;margin-top:1px;color:#333;font-family:Arial, sans-serif;'>Academic Transcript</div>
                <div style='font-size:11px;margin-top:3px;font-weight:bold;'>Nomor (Number) : <span class="no_transkrip_val{{ $row }}"></span></div>
            </div>

            <div style='margin-top:15px; margin-left: 5px; margin-right: 5px;'>
                <table border='0' width='100%' style='font-size:11px;line-height:14px;border-collapse:collapse;'>
                    <tr>
                        <td style='width:220px;vertical-align:top;padding:3px 0;'>
                            <strong>Nama Mahasiswa</strong><br><span style="font-style:italic;font-size:9px;color:#555;">Full Name</span>
                        </td>
                        <td style='width:15px;vertical-align:middle;text-align:center;'>:</td>
                        <td style='vertical-align:middle;font-weight:bold;text-transform:uppercase;font-size:12px;'><span class="nama_mhs{{ $row }}"></span></td>
                    </tr>
                    <tr style="height:3px;"><td colspan="3"></td></tr>
                    <tr>
                        <td style='vertical-align:top;padding:3px 0;'>
                            <strong>Nomor Induk Mahasiswa</strong><br><span style="font-style:italic;font-size:9px;color:#555;">Student Number</span>
                        </td>
                        <td style='vertical-align:middle;text-align:center;'>:</td>
                        <td style='vertical-align:middle;font-weight:bold;font-size:12px;'><span class="nim{{ $row }}">{{ $row }}</span></td>
                    </tr>
                    <tr style="height:3px;"><td colspan="3"></td></tr>
                    <tr>
                        <td style='vertical-align:top;padding:3px 0;'>
                            <strong>Tempat dan Tanggal Lahir</strong><br><span style="font-style:italic;font-size:9px;color:#555;">Place and Date of Birth</span>
                        </td>
                        <td style='vertical-align:middle;text-align:center;'>:</td>
                        <td style='vertical-align:middle;'>
                            <span class="tempat_tgl_lahir_val{{ $row }}"></span>
                        </td>
                    </tr>
                    <tr style="height:3px;"><td colspan="3"></td></tr>
                    <tr>
                        <td style='vertical-align:top;padding:3px 0;'>
                            <strong>Program Pendidikan</strong><br><span style="font-style:italic;font-size:9px;color:#555;">Education Program</span>
                        </td>
                        <td style='vertical-align:middle;text-align:center;'>:</td>
                        <td style='vertical-align:middle;'><span class="jenjang_val{{ $row }}"></span> / <span class="jenjang_en_val{{ $row }}" style="font-style:italic;color:#555;"></span></td>
                    </tr>
                    <tr style="height:3px;"><td colspan="3"></td></tr>
                    <tr>
                        <td style='vertical-align:top;padding:3px 0;'>
                            <strong>Program Studi</strong><br><span style="font-style:italic;font-size:9px;color:#555;">Study Program</span>
                        </td>
                        <td style='vertical-align:middle;text-align:center;'>:</td>
                        <td style='vertical-align:middle;'><span class="program_studi{{ $row }}"></span> / <span class="program_studi_en_val{{ $row }}" style="font-style:italic;color:#555;"></span></td>
                    </tr>
                    <tr style="height:3px;"><td colspan="3"></td></tr>
                    <tr>
                        <td style='vertical-align:top;padding:3px 0;'>
                            <strong>Gelar Akademik</strong><br><span style="font-style:italic;font-size:9px;color:#555;">Academic Degree Awarded</span>
                        </td>
                        <td style='vertical-align:middle;text-align:center;'>:</td>
                        <td style='vertical-align:middle;font-weight:bold;'><span class="gelar_val{{ $row }}"></span> / <span class="gelar_en_val{{ $row }}" style="font-style:italic;font-weight:normal;color:#555;"></span></td>
                    </tr>
                    <tr style="height:3px;"><td colspan="3"></td></tr>
                    <tr>
                        <td style='vertical-align:top;padding:3px 0;'>
                            <strong>Tanggal Kelulusan</strong><br><span style="font-style:italic;font-size:9px;color:#555;">Date of Graduation</span>
                        </td>
                        <td style='vertical-align:middle;text-align:center;'>:</td>
                        <td style='vertical-align:middle;'><span class="tgl_lulus_val{{ $row }}"></span></td>
                    </tr>
                </table>
            </div>

            <div style='font-size:10px;padding-top:15px; margin-left: 5px; margin-right: 5px;'>
                <table border='0' width='100%' style='border-collapse:collapse;'>
                    <thead>
                        <tr style='font-size:9px;font-weight:bold;background-color:#f5f7fa;text-align:center;'>
                            <td style='width:40px;border:1px solid #000;padding:6px 4px;font-weight:bold;'>NO</td>
                            <td style='border:1px solid #000;padding:6px 4px;font-weight:bold;text-align:left;'>MATA KULIAH</td>
                            <td style='border:1px solid #000;padding:6px 4px;font-weight:bold;text-align:left;font-style:italic;'>COURSE</td>
                            <td style='width:80px;border:1px solid #000;padding:6px 4px;font-weight:bold;'>KREDIT<br><span style="font-size:8px;font-style:italic;font-weight:normal;color:#555;">Credit</span></td>
                            <td style='width:90px;border:1px solid #000;padding:6px 4px;font-weight:bold;'>NILAI ANGKA<br><span style="font-size:8px;font-style:italic;font-weight:normal;color:#555;">Score</span></td>
                            <td style='width:90px;border:1px solid #000;padding:6px 4px;font-weight:bold;'>NILAI HURUF<br><span style="font-size:8px;font-style:italic;font-weight:normal;color:#555;">Grade</span></td>
                        </tr>
                    </thead>
                    <tbody id="transkipnilai{{ $row }}">
                    </tbody>
                    <tfoot>
                        <tr style="font-weight:bold;background-color:#f5f7fa;">
                            <td colspan="3" style="border:1px solid #000;padding:6px;text-align:right;font-weight:bold;">Total / Jumlah</td>
                            <td style="border:1px solid #000;padding:6px;text-align:center;"><span class="totalsks_val{{ $row }}"></span></td>
                            <td style="border:1px solid #000;padding:6px;text-align:center;"><span class="totalbobot_val{{ $row }}"></span></td>
                            <td style="border:1px solid #000;padding:6px;text-align:center;">&nbsp;</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div style='font-size:11px;padding-top:20px;font-family:Arial, sans-serif; margin-left: 5px; margin-right: 5px;'>
                <table border='0' width='100%' style='line-height:15px;border-collapse:collapse;'>
                    <tr style='border-top:2px solid black;border-bottom:2px solid black;'>
                        <td style='width:50%;font-style:italic;color:#555;padding:8px 0;vertical-align:top;'>
                            Transkrip ini dibuat dengan sebenarnya.<br>
                            <span style="font-size:10px;font-weight:normal;color:#666;">All information on this transcript is true and accurate.</span>
                        </td>
                        <td style='width:50%;padding:8px 0 8px 20px;vertical-align:top;'>
                            <div style="font-weight:bold;font-size:11px;">
                                Jumlah Seluruh Kredit = <span class="totalsks_val{{ $row }}"></span> &nbsp;&nbsp;&nbsp;&nbsp; IPK : <span class="totalipk_val_id{{ $row }}"></span> (<span class="predikat_val{{ $row }}"></span>)
                            </div>
                            <div style="font-style:italic;font-size:10px;color:#555;margin-top:2px;">
                                Total number of credit attempted = <span class="totalsks_val{{ $row }}"></span> &nbsp;&nbsp;&nbsp;&nbsp; GPA (Grade Point Average) : <span class="totalipk_val_en{{ $row }}"></span> (<span class="predikat_en_val{{ $row }}"></span>)
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <div style='float:right;margin-top:20px;font-family:Arial, sans-serif;margin-right:15px;'>
                <table border='0' style='line-height:14px;font-size:11px;'>
                    <tr>
                        <td>Karanganyar, <span class="tgl_cetak_val{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;">Dekan,<br><span style="font-style:italic;font-size:10px;font-weight:normal;color:#555;">Dean,</span></td>
                    </tr>
                    <tr>
                        <td style='height:50px;'>&nbsp;</td>
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
                        details.gelar_en = 'Associate of Livestock Production';
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
                if (val >= 3.51) return { id: 'Dengan Pujian', en: 'Cum Laude' };
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

                    var no = 1;
                    var tampil = '';
                    var totalsks = 0;
                    var totalbobot = 0;
                    var totalipk = 0;
                    var nilaid = 0;
                    var nilaie = 0;

                    for (var i = 0; i < jml; i++) {
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
                        }
                        if (data[i].nilai_huruf_akhir == "D") {
                            nilaid = nilaid + 1;
                        } else if (data[i].nilai_huruf_akhir == "E") {
                            nilaie = nilaie + 1;
                        }
                        var courseEn = data[i].nama_matakuliah_inggris ? data[i].nama_matakuliah_inggris : '';
                        tampil = tampil + '<tr style="font-size:10px; height:20px;">' +
                            '<td style="text-align:center; border:1px solid #000; padding:4px;">' + no + '</td>' +
                            '<td style="padding-left:8px; border:1px solid #000; padding:4px;">' + data[i].nama_matakuliah + '</td>' +
                            '<td style="padding-left:8px; font-style:italic; color:#333; border:1px solid #000; padding:4px;">' + courseEn + '</td>' +
                            '<td style="text-align:center; border:1px solid #000; padding:4px;">' + data[i].sks_matakuliah + '</td>' +
                            '<td style="text-align:center; border:1px solid #000; padding:4px;">' + scoreText + '</td>' +
                            '<td style="text-align:center; font-weight:bold; border:1px solid #000; padding:4px;">' + nilai + '</td>' +
                            '</tr>';
                        no++;
                    }
                    totalipk = totalsks > 0 ? (totalbobot / totalsks) : 0;
                    
                    $('#transkipnilai{{ $row }}').html(tampil);

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
                            
                            var facIndo = result[0].nama_fakultas || 'Sains Dan Teknologi';
                            var facEng = 'FACULTY OF SCIENCE AND TECHNOLOGY';
                            var facIndoUpper = facIndo.toUpperCase();
                            if (facIndoUpper.indexOf('SAINS') !== -1) {
                                facEng = 'FACULTY OF SCIENCE AND TECHNOLOGY';
                            } else if (facIndoUpper.indexOf('KOMUNIKASI') !== -1) {
                                facEng = 'FACULTY OF COMMUNICATION AND BUSINESS';
                            } else if (facIndoUpper.indexOf('KESEHATAN') !== -1) {
                                facEng = 'FACULTY OF HEALTH AND EDUCATION';
                            }
                            
                            $('.nama_fakultas_val{{ $row }}').html(facIndo.toUpperCase());
                            $('.nama_fakultas_en_val{{ $row }}').html(facEng);
                            
                            $('.nama_mhs{{ $row }}').html(result[0].nama_mahasiswa);
                            $('.nim{{ $row }}').html(nim);
                            $('.program_studi{{ $row }}').html(result[0].nama_program_studi);
                            $('.program_studi_en_val{{ $row }}').html(prodi.nama_en);
                            
                            $('.jenjang_val{{ $row }}').html(prodi.jenjang_id);
                            $('.jenjang_en_val{{ $row }}').html(prodi.jenjang_en);
                            
                            $('.gelar_val{{ $row }}').html(prodi.gelar_id);
                            $('.gelar_en_val{{ $row }}').html(prodi.gelar_en);
                            
                            var birthDate = formatBilingualDate(result[0].tanggal_lahir);
                            $('.tempat_tgl_lahir_val{{ $row }}').html(result[0].tempat_lahir + ", " + birthDate.id + " / " + result[0].tempat_lahir + ", " + birthDate.en);
                            
                            var gradDate = formatBilingualDate(result[0].tanggal_lulus);
                            $('.tgl_lulus_val{{ $row }}').html(gradDate.id + " / " + gradDate.en);
                            
                            $('.totalsks_val{{ $row }}').html(totalsks);
                            $('.totalbobot_val{{ $row }}').html(totalbobot.toFixed(2).replace('.', ','));
                            
                            $('.totalipk_val_id{{ $row }}').html(totalipk.toFixed(2).replace('.', ','));
                            $('.totalipk_val_en{{ $row }}').html(totalipk.toFixed(2));
                            
                            var pred = getGpaPredicate(totalipk);
                            $('.predikat_val{{ $row }}').html(pred.id);
                            $('.predikat_en_val{{ $row }}').html(pred.en);
                            
                            $('.dekan_name_val{{ $row }}').html(result[0].namadekan || 'Ir. Puji Astuti, M.P.');
                            $('.dekan_nip_val{{ $row }}').html(result[0].nipdekan || '19610524 198803 2 001');
                            
                            var printDate = formatBilingualDate(tanggal + "-" + (bulan + 1) + "-" + tahun);
                            $('.tgl_cetak_val{{ $row }}').html(printDate.id);
                            
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
