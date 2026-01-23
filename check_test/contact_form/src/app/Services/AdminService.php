<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Category;

class AdminService
{
    /**
     * 検索
     *
     * @param Request $request
     * @return Contact
     */
    public function search($request)
    {
        return Contact::query()
            ->filter($request->validated())
            ->orderBy('created_at', 'desc')
            ->select('id', 'last_name', 'first_name', 'gender', 'email', 'category_id')
            ->paginate(7)
            ->appends($request->query());
    }

    /**
     * カテゴリ名 取得
     *
     * @param string $categoryId
     * @return Category|null
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
