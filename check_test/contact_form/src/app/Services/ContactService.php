<?php

namespace App\Services;

use DB;
use App\Models\Contact;
use App\Models\Category;

class ContactService
{
    /**
     * お問い合わせ登録処理
     *
     * @param array $data
     * @return Contact
     */
    public function register($data)
    {
        return DB::transaction(function () use ($data) {
            return Contact::create($data);
        });
    }

    /**
     * カテゴリ名 取得
     *
     * @param string $categoryId
     * @return collection|null
     */
    public function getCategoryContent($categoryId)
    {
        return Category::find($categoryId);
    }

    /**
     * 性別名 取得
     *
     * @param int $genderId
     * @return string|null
     */
    public function getGenderLabel($genderId)
    {
        return Contact::GENDER[$genderId] ?? null;
    }

}
