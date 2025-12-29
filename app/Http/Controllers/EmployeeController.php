<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * 一覧表示
     */
    public function index()
    {
        // 全社員データを取得
        $employees = Employee::all();

        // 一覧画面へ渡す
        return view('employees.index', compact('employees'));
    }

    /**
     * 編集画面表示
     */
    public function edit($id)
    {
        // 該当IDの社員データを取得（なければ404）
        $employee = Employee::findOrFail($id);

        // 編集画面へ渡す
        return view('employees.edit', compact('employee'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        // 入力チェック
        $request->validate([
            'name' => 'required',
            'group' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'password' => 'nullable|min:6',
        ]);

        // 編集対象の社員データ取得
        $employee = Employee::findOrFail($id);

        // フォーム入力を配列で取得
        $data = $request->all();

        // パスワードが入力されていた場合のみ更新
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        // DB 更新
        $employee->update($data);

        // 一覧画面へリダイレクト
        return redirect()->route('employees.index')
                        ->with('success', '更新しました');
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();

        return redirect()->route('employees.index')
                        ->with('success', '削除しました');
    }

/**
 * 社員登録画面表示
 */
public function create()
{
    return view('employees.create');
}

/**
 * 社員登録処理
 */

public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
        'age'      => 'nullable|integer|min:0|max:120',
        'email' => 'required|email|unique:users',
        'phone' => 'nullable',
        'role' => 'required|integer',
        'sales_office' => 'required',
        'password' => 'required|min:6',
    ]);

    User::create([
        'name' => $request->name,
        'age'      => $request->age,
        'email' => $request->email,
        'phone' => $request->phone,
        'role' => $request->role,
        'sales_office' => $request->sales_office,
        'password' => Hash::make($request->password),        
    ]);

        return redirect()->back()->with('success', '社員を登録しました');
 
    }


}
