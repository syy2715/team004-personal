@extends('layouts.app')

@section('title', '社員編集')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5 class="mb-0">社員編集</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">名前</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">年齢</label>
                            <input
                                type="number"
                                name="age"
                                class="form-control"
                                min="0"
                                max="120"
                                value="{{ old('age', $user->age) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">メールアドレス</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">電話番号</label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $user->phone) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">所属課</label>
                            <select name="group_id" class="form-select">
                                <option value="">選択してください</option>
                                @foreach(\App\Models\User::GROUPS as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('group_id', $user->group_id) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">役職</label>
                            <select name="role" class="form-select">
                                <option value="">選択してください</option>
                                @foreach(\App\Models\User::ROLES as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('role', $user->role) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">営業所</label>
                            <select name="sales_office" class="form-select">
                                <option value="">選択してください</option>
                                @foreach(\App\Models\User::SALES_OFFICES as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('sales_office', $user->sales_office) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                パスワード
                                <span class="text-muted small">（変更する場合のみ）</span>
                            </label>
                            <input
                                type="password"
                                name="password"
                                class="form-control">
                        </div>

                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('users.index') }}"
                                class="btn btn-outline-secondary w-50">
                                一覧へ戻る
                            </a>

                            <button type="submit"
                                class="btn btn-primary w-50">
                                更新
                            </button>
                        </div>
                    </form>

                    {{-- バリデーションエラー --}}
                    @if ($errors->any())
                    <div class="alert alert-danger mt-4 mb-0">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
