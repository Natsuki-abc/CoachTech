<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminSearchRequest;
use App\Services\AdminService;
use App\Models\Contact;
use App\Models\Category;
use Exception;

class AdminController extends Controller
{
    /**
     * コンストラクタ
     *
     * @param $admin_service
     */
    public function __construct(
        protected AdminService $admin_service
    ) {}

    /**
     * 管理画面(検索)
     *
     * @param AdminSearchRequest $request
     * @return Illuminate\View\View
     */
    public function index(AdminSearchRequest $request)
    {
        if ($request->validated()) {
            $contacts = $this->admin_service->search($request);
        } else {
            $contacts = Contact::orderBy('created_at', 'desc')->select('id', 'last_name', 'first_name', 'gender', 'email', 'category_id')->paginate(7);
        }

        $categories = Category::orderBy('created_at')->pluck('content', 'id');

        return view('admin.index', [
            'contacts' => $contacts,
            'categories' => $categories,
            'genders' => Contact::GENDER,
        ]);
    }

    /**
     * 詳細
     *
     * @param string $id
     * @return jsonResponse
     */
    public function detail($id)
    {
        try {
            $contact = Contract::findOrFail($id);

            // HTMLをレンダリングして返す
            $html = view('admin.partials._detail_modal', compact('contact'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'データの取得に失敗しました。',
            ], 404);
        }
    }
}
