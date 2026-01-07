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
