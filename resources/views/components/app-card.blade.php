{{-- 共通カードコンポーネント --}}
<div {{ $attributes->merge(['class' => 'app-card']) }}>
    {{ $slot }}
</div>
