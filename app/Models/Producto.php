<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Disable the model timestamps
    public $timestamps = false;

    // configura la tabla y la llave primaria, por defectos es el mismo nombre del modelo (minúscula y S al final )y el id.
    protected $table = 'producto';
    protected $primaryKey = 'prod_codigo';

    // campos modificables
    protected $fillable = [
        'pro_nombre', 'prod_referencia', 'prod_descripcion'
    ];

    // campos no visibles
    protected $hidden = [
        'pro_url_amigable',
    ];
}
