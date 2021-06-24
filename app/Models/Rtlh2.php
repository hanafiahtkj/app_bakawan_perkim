<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rtlh2 extends Model
{
    use HasFactory;

    protected $table = '__rtlh';

    protected $fillable = [
        'id_kecamatan2',
        'id_kelurahan2',
        'nama_lengkap',
        'jenis_kelamin',
        'nik',
        'alamat_lengkap',
        'jml_kk',
        'jenis_pekerjaan',
        'jml_penghasilan',
        'stts_tanah',
        'stts_rumah',
        'stts_rumah_lain', 
        'stts_tanah_lain',
        'pernah_dibantu',  
        'pondasi',        
        'kondisi_kolom',   
        'kondisi_konstruksi', 
        'jendela',         
        'ventilasi',       
        'stts_wc',         
        'sumber_air_minum',
        'jarak_air_tpa',   
        'sumber_listrik', 
        'panjang',         
        'lebar',           
        'jml_penghuni',    
        'material_atap',   
        'kondisi_atap',    
        'material_dinding',
        'kondisi_dinding', 
        'material_lantai', 
        'kondisi_lantai',  
        'koordinat_rumah', 
        'umur',           
        'pendidikan',      
        'kawasan_rumah',
    ];

    public $timestamps = false;
}
