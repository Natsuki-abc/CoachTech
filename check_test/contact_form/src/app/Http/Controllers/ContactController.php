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
    public function index(Request $request)
    {
        $categories = Category::orderBy('created_at')->pluck('content', 'id');

        $data = Contact::FORM_KEYS;
        if ($request->session()->has('contact_data')) {
            $data = $request->session()->get('contact_data');
        }

        return view('index', [
            'categories' => $categories,
            'genders' => Contact::GENDER,
            'data' => $data,
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

        $category = $this->contact_service->getCategoryContent($request->category_id);
        $gender = $this->contact_service->getGenderLabel($request->gender);
        if (is_array($category) || is_array($gender)) {
            $errorMessages = array_merge(
                is_array($category) ? $category : [],
                is_array($gender) ? $gender : []
            );
            return redirect()->back()->withErrors($errorMessages);
        }

        return view('confirm', [
            'category' => $category->content,
            'gender' => $gender,
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
        $data = $request->session()->get('contact_data');
        if (!$data) {
            return redirect(route('index'));
        }

        $result = $this->contact_service->register($data);
        $request->session()->forget('contact_data');

        return redirect()->route('thanks');
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
