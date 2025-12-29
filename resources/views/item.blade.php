@extends('layouts.app')

@section('title', '商品登録')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">商品登録</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="image_path" class="form-label">商品画像</label>
                            <input type="file" class="form-control" name="image_path" id="image_path">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">商品名</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">分類</label>
                            <select name="type" id="type" class="form-select">
                                <option value="">選択してください</option>
                                @foreach ($type as $key => $label)
                                <option value="{{ $key }}">
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="price" class="form-label">価格</label>
                            <input type="text" class="form-control" name="price" id="price">
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">在庫数</label>
                            <input type="text" class="form-control" name="stock" id="stock">
                        </div>

                        <div class="mb-3">
                            <label for="storage" class="form-label">保管場所</label>
                            <select name="storage" id="storage" class="form-select">
                                <option value="">選択してください</option>
                                @foreach ($storage as $key => $label)
                                <option value="{{ $key }}">
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">備考</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                                一覧へ戻る
                            </a>

                            <button type="submit" class="btn btn-success">
                                登録
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection