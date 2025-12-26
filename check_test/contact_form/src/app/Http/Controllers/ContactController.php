<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param $contact_service
     */
    public function __construct(
        protected ContactService $contact_service
    ) {}

    /**
     * お問い合わせフォーム入力画面
     *
     * @param
     * @return Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();

        return view('index', [
            'categories' => $categories,
            'genders' => Contact::GENDER,
        ]);
    }

    /**
     * お問い合わせフォーム確認画面
     *
     * @param ContactRequest $request
     * @return Illuminate\View\View
     */
    public function confirm(ContactRequest $request)
    {
        $request->session()->put('contact_data', $request->validated());
        $category = Category::find($request->category_id);

        return view('confirm', [
            'category' => $category->content,
            'genders' => Contact::GENDER,
            'data' => $request->validated(),
        ]);
    }

    /**
     * お問い合わせ登録処理
     *
     * @param Request $request
     * @return Illuminate\View\View
     */
    public function store(Request $request)
    {
        Contact::create($request->session()->get('contact_data'));
        $request->session()->forget('contact_data');

        return redirect(route('thanks'));
    }

    /**
     * お問い合わせフォーム完了画面
     *
     * @param
     * @return Illuminate\View\View
     */
    public function thanks()
    {
        return view('thanks');
    }
}
