<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    const FORM_KEYS = [
        'category_id' => '',
        'last_name' => '',
        'first_name' => '',
        'gender' => '',
        'email' => '',
        'tel1' => '',
        'tel2' => '',
        'tel3' => '',
        'address' => '',
        'building' => '',
        'detail' => '',
    ];

    const GENDER = [
        1 => '男性',
        2 => '女性',
        3 => 'その他',
    ];
}
