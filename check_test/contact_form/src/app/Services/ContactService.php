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
     * @param uuid $category_id
     * @return bool
     */
    public function getCategoryContent(string $category_id)
    {
        $category = Category::find($category_id);
        if (!$category) {
            return ['category_id' => 'カテゴリが見つかりませんでした。'];
        }

        return $category;
    }

    /**
     * 性別名 取得
     *
     * @param int $gender_id
     * @return bool
     */
    public function getGenderLabel(int $gender_id)
    {
        $gender = Contact::GENDER[$gender_id] ?? '';
        if (!$gender) {
            return ['gender' => '性別が見つかりませんでした。'];
        }

        return $gender;
    }

}
