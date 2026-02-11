@extends('layouts.app')

@section('title', '商品一覧')

@php
function sortLink($label, $column, $sort, $direction) {
$newDirection = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
$arrow = $sort === $column ? ($direction === 'asc' ? '▲' : '▼') : '';
$url = route('items.index', [
'sort' => $column,
'direction' => $newDirection,
]);
return "<a href='{$url}'>{$label} {$arrow}</a>";
}
@endphp

@section('content')

<h2 class="mb-3">商品一覧</h2>

{{-- 成功メッセージ --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<a class="btn btn-primary mb-3" href="{{ route('items.create') }}">
    新規商品登録
</a>

<table class="table table-bordered table-hover align-middle">
    <thead class="table-light">
        <tr>
            <th>{!! sortLink('ID', 'id', $sort, $direction) !!}</th>
            <th>商品画像</th>
            <th>{!! sortLink('商品名', 'name', $sort, $direction) !!}</th>
            <th>{!! sortLink('価格', 'price', $sort, $direction) !!}</th>
            <th>{!! sortLink('分類', 'type', $sort, $direction) !!}</th>
            <th>{!! sortLink('保管場所', 'storage', $sort, $direction) !!}</th>
            <th>{!! sortLink('在庫数', 'stock', $sort, $direction) !!}</th>
            <th>{!! sortLink('評価', 'reviews_avg_rating', $sort, $direction) !!}</th>
            <th>備考</th>
            <th>操作</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($items as $item)
        <tr>
            <td>{{ $item->id }}</td>

            <td>

                @if (!empty($item->image_path))
                <img
                    src="{{ $item->image_path }}"
                    height="40">
                @else
                <span class="text-muted small">画像なし</span>
                @endif
            </td>

            <td>
                <a href="{{ route('items.show', $item->id) }}">
                    {{ $item->name }}
                </a>
            </td>

            <td>{{ number_format($item->price) }}</td>

            <td>{{ $item->type_label }}</td>

            <td>{{ $item->storage_label }}</td>

            <td>{{ $item->stock }}</td>

            <td>
                @if ($item->reviews_count > 0)
                {{ number_format($item->reviews_avg_rating, 2) }}
                ({{ $item->reviews_count }})
                @else
                未評価
                @endif
            </td>

            <td>{{ $item->description }}</td>

            <td class="text-nowrap">
                <a class="btn btn-sm btn-primary"
                    href="{{ route('items.edit', $item->id) }}">
                    編集
                </a>

                <a class="btn btn-sm btn-info text-white"
                    href="{{ route('items.reviews.index', $item->id) }}">
                    レビュー
                </a>

                <form action="{{ route('items.destroy', $item->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn btn-sm btn-danger">
                        削除
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center text-muted">
                商品が登録されていません
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- ページネーション --}}
<div class="d-flex justify-content-center">
    {{ $items->links() }}
</div>

@endsection