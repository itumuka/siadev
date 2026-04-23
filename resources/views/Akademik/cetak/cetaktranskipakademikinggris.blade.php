<html>

<body>
    <input class="form-control" type="text" name="nim" id="nim" value="{{ $nim }}">
    <input class="form-control" type="text" name="tahun" id="tahun" value="{{ $tahun }}">
    <input class="form-control" type="text" name="semester" id="semester" value="{{ $semester }}">
    <div class='row'>
        <div class='col-xs-12'>
            <table border='0' rules='all0' style='width:100%;'>
                <tr>
                    {{-- <td style='padding-right:10px;width:80px;'><img src='{{ url('imageup45/logo_up.png') }}'
                            style='width:80px;'></td> --}}
                    <td style='padding-right:10px;width:130px;'></td>
                    <td style='font-size:20px;padding-left:5px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
                        KARANGANYAR
                        <div id='nama_fakultas' style='font-size:20px;margin-top:-5px;'></div>
                        <div style='font-size:10px;border-bottom:1px solid black;padding-bottom:3px;margin-top:-3px;'>
                            Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa
                            Tengah 57722</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div style='font-family:Courier New;height:945px;'>
        <div style='margin-top:10px;text-align:center;'>
            <span style='font-size:20px;font-weight:bold;'>ACADEMIC TRANSCRIPT</span>
        </div>
        <div style='margin-top:-7px;text-align:center;'>
            <span style='font-size:14px;font-weight:bold;'>Number : $no_transkrip</span>
        </div>

        <div style='margin-top:20px;'>
            <table border='0' rules='all0' width='100%' style='font-size:10px;line-height:10px'>
                <tr>
                    <td style='width:100px;'>Name</td>
                    <td style='width:10px;'>:</td>
                    <td>$nama_mhs</td>
                    <td style='width:135px;'>Date Of Reg/Graduation</td>
                    <td style='width:10px;'>:</td>
                    <td>$tanggal_diterima_f/$tgl_lulus</td>
                </tr>
                <tr>
                    <td>Student Number</td>
                    <td>:</td>
                    <td>$nim</td>
                    <td>Education Program</td>
                    <td>:</td>
                    <td>Undergraduate/S1</td>
                </tr>
                <tr>
                    <td>Place Of Birth</td>
                    <td>:</td>
                    <td>$tempat</td>
                    <td>Status</td>
                    <td style='width:10px;'>:</td>
                    <td>$status_akreditasi</td>
                </tr>
                <tr>
                    <td>Date Of Birth </td>
                    <td>:</td>
                    <td>$tanggal_f</td>
                    <td>Number Of SK BAN PT</td>
                    <td>:</td>
                    <td style='width:180px;'>$no_sk</td>
                </tr>
                <tr>
                    <td>Program Of Study</td>
                    <td>:</td>
                    <td>$nama_prodi</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div style='margin-top:5px;'>
            <table border='0' rules='all0' width='100%' valign='top'>
                <tr>
                    <td colspan='2' style='border-top:2px solid black;'></td>
                </tr>
                <tr>


                    <td style='width:50%;' valign='top'>
                        <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                            <tr style='font-size:10px;'>
                                <td style='width:25px;padding-bottom:4px;padding-top:5px;'>No</td>
                                <td style='padding-bottom:4px;padding-top:5px;'>Course Name</td>
                                <td style='padding-bottom:4px;padding-top:5px;padding-left:3px;padding-right:3px;'>SCU
                                </td>
                                <td style='padding-bottom:4px;padding-top:5px;padding-left:3px;padding-right:3px;'>Grade
                                </td>
                                <td style='padding-bottom:5px;'>Weight</td>
                            </tr>
                            <tr>
                                <td colspan='5' style='border-top:1px solid black;padding-bottom:4px;'></td>
                            </tr>
</body>

</html>
<script>
    window.print();
</script>
