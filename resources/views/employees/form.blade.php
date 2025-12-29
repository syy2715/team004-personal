<div>
    <label>名前：</label>
    <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}">
</div>

<div>
    <label>所属課：</label>
    <input type="text" name="group" value="{{ old('group', $employee->group ?? '') }}">
</div>

<div>
    <label>メール：</label>
    <input type="text" name="email" value="{{ old('email', $employee->email ?? '') }}">
</div>

<div>
    <label>電話番号：</label>
    <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}">
</div>

<div>
    <label>パスワード（変更する時だけ）</label>
    <input type="password" name="password">
</div>
