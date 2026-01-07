@extends('layouts.app')

@section('title', 'レビュー投稿')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">

        {{-- 戻るボタン --}}
        <div class="mb-3">
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                商品一覧へ戻る
            </a>
        </div>

        {{-- 商品情報 --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">{{ $item->name }}</h5>
            </div>

            <div class="card-body d-flex gap-4 align-items-start">
                @if ($item->image_path)
                <img src="{{ Storage::disk(config('filesystems.default'))->url($item->image_path) }}"
                    height="120"
                    class="rounded">
                @endif

                <div>
                    <p class="mb-2">
                        平均評価：
                        @if ($item->reviews->count() > 0)
                        <strong>
                            {{ number_format($item->reviews->avg('rating'), 2) }}
                        </strong>
                        （{{ $item->reviews->count() }}）
                        @else
                        未評価
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- レビュー投稿 --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">レビュー投稿</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('items.reviews.store', $item->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">評価</label>
                        <select name="rating" class="form-select">
                            <option value="" disabled selected>評価を選択してください</option>
                            @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">コメント</label>
                        <textarea name="review"
                            rows="4"
                            class="form-control"></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            投稿
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- レビュー一覧 --}}
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">レビュー一覧</h5>
            </div>

            <div class="card-body">
                @forelse ($reviews as $review)
                <div class="border-bottom pb-3 mb-3">
                    <div class="fw-bold mb-1">
                        ★ {{ $review->rating }}
                        <span class="text-muted">
                            （{{ $review->user->name ?? '匿名' }}）
                        </span>
                    </div>
                    <div>
                        {{ $review->review }}
                    </div>
                </div>
                @empty
                <p class="text-muted mb-0">
                    レビューはまだありません
                </p>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection