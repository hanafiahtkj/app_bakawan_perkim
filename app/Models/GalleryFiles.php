<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryFiles extends Model
{
    use HasFactory;

    protected $table = 'gallery_files';

    protected $fillable = [
        'id_directory',
        'path',
        'file_name'
    ];
}
