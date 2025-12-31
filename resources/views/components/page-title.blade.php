{{-- 共通ページタイトルコンポーネント --}}
<h1 {{ $attributes->merge(['class' => 'page-title']) }}>
    {{ $slot }}
</h1>

