<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 管理画面 検索
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function scopeFilter(Builder $q, array $f)
    {
        return $q
            ->nameOrEmail($f['text'] ?? null)
            ->genderIs($f['gender'] ?? null)
            ->categoryIs($f['category_id'] ?? null)
            ->contactedOn($f['created_at'] ?? null);
    }

    public function scopeNameOrEmail(Builder $q, ?string $value)
    {
        if (!$value) return $q;

        return $q->where(function (Builder $qq) use ($value) {
            $like = $this->getLiked($value);
            $qq->where('last_name', 'like', $like)
                ->orWhere('first_name', 'like', $like)
                ->orWhere('email', 'like', $like);
        });
    }

    public function scopeNameSearch(Builder $q, ?string $name)
    {
        if (!$name) return $q;

        return $q->where(function (Builder $qq) use ($name) {
            $like = $this->getLiked($name);
            $qq->where('last_name', 'like', $like)
                ->orWhere('first_name', 'like', $like);
        });
    }

    public function scopeEmailSearch(Builder $q, ?string $email)
    {
        if (!$email) return $q;
        return $q->where('email', 'like', $this->getLiked($email));
    }

    public function scopeGenderIs(Builder $q, ?string $gender)
    {
        if (!$gender) return $q;
        return $q->where('gender', $gender);
    }

    public function scopeCategoryIs(Builder $q, ?string $category)
    {
        if (!$category) return $q;
        return $q->where('category_id', $category);
    }

    public function scopeContactedOn(Builder $q, ?string $date)
    {
        if (!$date) return $q;
        return $q->whereDate('created_at', $date);
    }

    /**
     * エスケープ処理
     * @param string $value
     * @return string
     */
    private function getLiked($value)
    {
        return '%' . addcslashes($value, '%_\\') . '%';
    }
}
