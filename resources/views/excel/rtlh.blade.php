<style>
table, th, td {
  border: 1px solid black;
}
</style>

<table>
    <thead>
    <tr>
        <th>NIK / No.KTP</th>
        <th>Nama Lengkap</th>
        <th>Kecamatan</th>
        <th>Kelurahan</th>
        <th>Kode Wilayah</th>
        <th>Alamat Lengkap</th>
        <th>Tanggal </th>
        <th>Jenis Kelamin</th>
        <th>Jenis Pekerjaan</th>
        <th>Pndidikan Terakhir</th>
        <th>Jumlah Penghasilan</th>
        <th>Pernah Mendapat Bantuan Perumahan / Sejenis</th>
        <th>Jika Pernah dapat bantuan, dari</th>
        <th>Jumlah KK dalam rumah</th>
        <th>Jumlah Penghuni</th>
        <th>Luas Rumah (Panjang x Lebar) M2</th>
        <th>Status Kepemilikan tanah</th>
        <th>Status Kepemilikan rumah</th>
        <th>Aset tanah di tempat lain</th>
        <th>Aset rumah di tempat lain</th>
        <th>Bukti Kepemilikan</th>
        <th>Koordinat Rumah</th>
        <th>Pondasi</th>
        <th>Kondisi Kolom</th>
        <th>Kondisi Konstruksi Atap</th>
        <th>Jendela / Lubang Cahaya</th>
        <th>Ventilasi</th>
        <th>Kepemilikan Kamar Mandi dan WC</th>
        <th>Jarak Sumber Air Minum ke TPA Tinja</th>
        <th>Jenis Kloset</th>
        <th>Jenis TPA</th>
        <th>Sumbe Air Minum</th>
        <th>Sumber Listrik</th>
        <th>Luas Rumah (Panjang x Lebar)</th>
        <th>Material Atap</th>
        <th>Kondisi Atap</th>
        <th>Material Dinding Terluas</th>
        <th>Kondisi Dinding</th>
        <th>Material Lantai Terluas</th>
        <th>Kondisi Lantai</th>
        <th>Kondisi Plafon</th>
        <th>Kondisi Balok</th>
        <th>Kondisi Sloof</th>
        <th>Kawasan Rumah</th>
        <th>Status Verifikasi</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($rtlh as $key => $value)
            <tr>
                <td>{{ $value->nik }}</td>
                <td>{{ $value->nama_lengkap }}</td>
                <td>{{ $value->kecamatan }}</td>
                <td>{{ $value->kelurahan }}</td>
                <td>{{ $value->kode_wilayah }}</td>
                <td>{{ $value->alamat_lengkap }}</td>
                <td>{{ $value->tgl_lahir }}</td>
                <td>{{ $value->jenis_kelamin }}</td>
                <td>{{ $value->jenis_pekerjaan }}</td>
                <td>{{ $value->pendidikan}}</td>
                <td>{{ $value->jml_penghasilan }}</td>
                <td>{{ ($value->pernah_dibantu == 1) ? 'Ya' : 'Tidak' }}</td>
                <td>{{ $value->bantuan_dari }}</td>
                <td>{{ $value->jml_kk }}</td>
                <td>{{ $value->jml_penghuni }}</td>
                <td>{{ $value->panjang }} x {{ $value->lebar }}</td>
                <td>{{ $value->stts_tanah }}</td>
                <td>{{ $value->stts_rumah }}</td>
                <td>{{ $value->stts_tanah_lain }}</td>
                <td>{{ $value->stts_rumah_lain }}</td>
                <th>{{ $value->bukti_kepemilikan }}</th>
                <td>{{ $value->koordinat_rumah }}</td>
                <td>{{ $value->pondasi }}</td>
                <td>{{ $value->kondisi_kolom }}</td>
                <td>{{ $value->kondisi_konstruksi }}</td>
                <td>{{ $value->jendela }}</td>
                <td>{{ $value->ventilasi }}</td>
                <td>{{ $value->stts_wc }}</td>
                <td>{{ $value->jarak_air_tpa }}</td>
                <td>{{ $value->jenis_kloset }}</td>
                <td>{{ $value->jenis_tpa }}</td>
                <td>{{ $value->sumber_air_minum }}</td>
                <td>{{ $value->sumber_listrik }}</td>
                <td>{{ $value->panjang }} x {{ $value->lebar }}</td>
                <td>{{ $value->material_atap }}</td>
                <td>{{ $value->kondisi_atap }}</td>
                <td>{{ $value->material_dinding }}</td>
                <td>{{ $value->kondisi_dinding }}</td>
                <td>{{ $value->material_lantai }}</td>
                <td>{{ $value->kondisi_lantai }}</td>
                <td>{{ $value->kondisi_plafon }}</td>
                <td>{{ $value->kondisi_balok }}</td>
                <td>{{ $value->kondisi_sloof }}</td>
                <td>{{ $value->kawasan_rumah }}</td>
                <td>{{ ($value->ket_verif == '') ? 'Menunggu' : $value->ket_verif }}</td>
            </tr>
        @endforeach
    </tbody>
</table>