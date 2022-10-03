<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen_producto extends Model
{
    // Disable the model timestamps
    public $timestamps = false;

    // configura la tabla y la llave primaria, por defectos es el mismo nombre del modelo (minúscula y S al final )y el id.
    protected $table = 'imagen_producto';
    protected $primaryKey = 'imag_prod_codigo';

    // campos modificables
    protected $fillable = [
        'prod_codigo_producto', 'imag_base64'
    ];

    // campos no visibles
    protected $hidden = [
        'pro_url_amigable',
    ];
}
