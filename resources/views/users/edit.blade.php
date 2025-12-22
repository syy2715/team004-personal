@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <h1 class="text-center mb-4">社員情報編集</h1>

            <div class="card shadow-sm edit-card">
                <div class="card-body p-4">

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- 名前 --}}
                        <div class="mb-4">
                            <label class="form-label">名前</label>
                            <input type="text"
                                    name="name"
                                    class="form-control form-control-lg"
                                    value="{{ old('name', $user->name) }}">
                        </div>

                        {{-- 所属課 --}}
                        <div class="mb-4">
                            <label class="form-label">所属課</label>
                            <select name="group_id" class="form-select form-select-lg">
                                <option value="">選択してください</option>
                                <option value="1" {{ old('group_id', $user->group_id) == 1 ? 'selected' : '' }}>営業課</option>
                                <option value="2" {{ old('group_id', $user->group_id) == 2 ? 'selected' : '' }}>人事課</option>
                                <option value="3" {{ old('group_id', $user->group_id) == 3 ? 'selected' : '' }}>開発課</option>
                                <option value="4" {{ old('group_id', $user->group_id) == 4 ? 'selected' : '' }}>経理課</option>
                            </select>
                        </div>

                        {{-- メール --}}
                        <div class="mb-4">
                            <label class="form-label">メール</label>
                            <input type="email"
                                    name="email"
                                    class="form-control form-control-lg"
                                    value="{{ old('email', $user->email) }}">
                        </div>

                        {{-- 電話番号 --}}
                        <div class="mb-4">
                            <label class="form-label">電話番号</label>
                            <input type="text"
                                    name="phone"
                                    class="form-control form-control-lg"
                                    value="{{ old('phone', $user->phone) }}">
                        </div>

                        {{-- パスワード --}}
                        <div class="mb-4">
                            <label class="form-label">パスワード（変更時のみ）</label>
                            <input type="password"
                                    name="password"
                                    class="form-control form-control-lg">
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-lg">
                                一覧に戻る
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                更新
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
