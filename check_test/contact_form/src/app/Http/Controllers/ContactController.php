<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use App\Models\Contact;
use App\Models\Category;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

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
        if (!$category || !$gender) {
            $errorMessages = array_merge(
                $category ? [] : ['category_id' => 'カテゴリが見つかりませんでした。'],
                $gender ? [] : ['gender' => '性別が見つかりませんでした。'],
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

        try {
            $this->contact_service->register($data);
            $request->session()->forget('contact_data');

            return redirect()->route('thanks');

        } catch (QueryException $e) {
            Log::critical('DB登録エラー', ['error' => $e->getMessage()]);
            return $this->errorRedirect('データベースエラーが発生しました');

        } catch (Exception $e) {
            Log::critical('予期しないエラーが発生しました', ['error' => $e]);
            return $this->errorRedirect('予期しないエラーが発生しました');
        }
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

    /**
     * エラー時のリダイレクト処理
     *
     * @param string $message
     * @return
     */
    private function errorRedirect($message)
    {
        return redirect()->route('index')->with('error', $message);
    }
}
