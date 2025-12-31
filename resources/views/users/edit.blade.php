@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h1 class="page-title mb-4">社員情報編集</h1>

    <x-app-card>

        <form action="{{ route('users.update', $user->id) }}"
            method="POST"
            class="form-compact">

            @csrf
            @method('PUT')

            <div class="app-table-wrapper">

                <table class="table mb-0 align-middle">
                    <tbody>

                        <tr>
                            <th class="text-start ps-4">名前</th>
                            <td>
                                <input type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <th class="text-start ps-4">年齢</th>
                            <td>
                                <input type="number"
                                    name="age"
                                    value="{{ old('age', $user->age) }}"
                                    class="form-control"
                                    min="0"
                                    step="1"
                                    inputmode="numeric">
                            </td>
                        </tr>

                        <tr>
                            <th class="text-start ps-4">所属課</th>
                            <td>
                                <input type="text"
                                    name="group_name"
                                    value="{{ old('group_name', $user->group_name) }}"
                                    class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <th class="text-start ps-4">役職</th>
                            <td>
                                <select name="role" class="form-select">
                                    @foreach (\App\Models\User::ROLES as $key => $label)
                                        <option value="{{ $key }}"
                                            @selected(old('role', $user->role) == $key)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-start ps-4">営業所</th>
                            <td>
                                <select name="sales_office" class="form-select">
                                    @foreach (\App\Models\User::SALES_OFFICES as $key => $label)
                                        <option value="{{ $key }}"
                                            @selected(old('sales_office', $user->sales_office) == $key)>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-start ps-4">メール</th>
                            <td>
                                <input type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <th class="text-start ps-4">電話番号</th>
                            <td>
                                <input type="text"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}"
                                    class="form-control">
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    戻る
                </a>
                <button type="submit" class="btn btn-primary">
                    更新
                </button>
            </div>

        </form>

    </x-app-card>

</div>
@endsection
