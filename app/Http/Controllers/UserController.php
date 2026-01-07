<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
{
    // 未ログインはログイン画面へ
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    // 管理者以外は403
    if (!auth()->user()->isAdmin()) {
        abort(403, '権限がありません');
    }

    $users = User::all();
    return view('users.index', compact('users'));
}

    // 一覧
    //public function index()
    //{
    //    $users = User::all();
    //    return view('users.index', compact('users'));
   // }

    // 新規登録画面


    public function create()
    {
         //所属課（Userモデルの定数を使用）
        $groups = User::GROUPS;

         //役職
        $roles = [
            'admin'    => '管理者',
            'manager' => '上長',
            'employee' => '一般社員',
        ];

        return view('users.create', compact('groups', 'roles'));
    }   

    // 登録処理

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|integer',
            'group_id' => 'required|integer',
            'sales_office' => 'required',
            // ▼【提案】社員一覧・編集画面とバリデーションを統一する案
            // OKであればコメント解除して利用してください
            'age' => ['nullable', 'integer', 'min:0', 'max:120'],

            ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'age' => $request->age,
            'phone' => $request->phone,
            'group_id' => $request->group_id,
            'role' => $request->role,   // ← 数値
            'sales_office' => $request->sales_office,
        ]);

        auth()->login($user);

        return redirect()->route('home')
            ->with('success', '社員を登録しました');
    }

    // 編集画面
    public function edit(User $user)
    {
        $groups = [
            1 => '営業課',
            2 => '人事部',
            3 => '総務部',
            4 => '開発部',
        ];

        return view('users.edit', compact('user', 'groups'));
    }

    // 更新
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'group_id' => 'required|integer',
            'role' => 'required|integer',
            'sales_office' => 'required',
            'phone' => 'nullable',
            'age' => 'nullable|integer|min:0|max:120',
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only([
            'name',
            'email',
            'group_id',
            'role',
            'sales_office',
            'phone',
            'age',
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', '更新しました');
    }


    // 削除
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', '削除しました');
    }
}
