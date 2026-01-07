@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <a href="{{ route('items.index') }}"
                class="btn btn-outline-secondary btn-sm mb-2 w-100">
                一覧へ戻る
            </a>

            <div class="card shadow-sm mb-3">
                <div class="card-body p-3">

                    {{-- 画像 --}}
                    @if ($item->image_path)
                    <div class="text-center mb-2">
                        <img src="{{ Storage::disk(config('filesystems.default'))->url($item->image_path) }}"
                            class="img-fluid rounded"
                            style="max-height: 120px;">
                    </div>
                    @endif

                    {{-- 情報 --}}
                    <div class="row mb-1">
                        <div class="col-4 text-muted small">商品名</div>
                        <div class="col-8">{{ $item->name }}</div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-4 text-muted small">分類</div>
                        <div class="col-8">{{ $item->type_label }}</div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-4 text-muted small">価格</div>
                        <div class="col-8">
                            {{ number_format($item->price) }} 円
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-4 text-muted small">在庫</div>
                        <div class="col-8">{{ $item->stock }}</div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-4 text-muted small">保管</div>
                        <div class="col-8">{{ $item->storage_label }}</div>
                    </div>

                    <div class="row">
                        <div class="col-4 text-muted small">備考</div>
                        <div class="col-8">
                            {{ $item->description ?? '―' }}
                        </div>
                    </div>

                </div>
            </div>

            {{-- レビュー --}}
            <div class="card shadow-sm">
                <div class="card-body p-3">

                    <div class="text-muted small mb-2 text-center">
                        レビュー
                    </div>

                    @forelse ($item->reviews as $review)
                    <div class="small border-bottom pb-1 mb-1">
                        ★ {{ $review->rating }}
                        （{{ $review->user->name ?? '匿名' }}）
                        <br>
                        {{ $review->review }}
                    </div>
                    @empty
                    <div class="text-muted small text-center">
                        まだありません
                    </div>
                    @endforelse

                </div>
            </div>

        </div>
    </div>

</div>
@endsection