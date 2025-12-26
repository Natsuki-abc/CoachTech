<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Category;

class ContactService
{
    /**
     * お問い合わせ登録処理
     *
     * @param array $data
     * @return bool
     */
    public function register(array $data)
    {
        Contact::create($data);

        return true;
    }

    /**
     * カテゴリ名 取得
     *
     * @param uuid $categoryId
     * @return bool
     */
    public function getCategoryContent(string $categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) {
            return ['category_id' => 'カテゴリが見つかりませんでした。'];
        }

        return $category;
    }

    /**
     * 性別名 取得
     *
     * @param int $genderId
     * @return bool
     */
    public function getGenderLabel(int $genderId)
    {
        $gender = Contact::GENDER[$genderId] ?? '';
        if (!$gender) {
            return ['gender' => '性別が見つかりませんでした。'];
        }

        return $gender;
    }

}
