@push('head')
    <link
        href="/favicon.ico"
        id="favicon"
        rel="icon"
    >
@endpush

<div class="h2 d-flex align-items-center">
    <img src="/favicon.ico" title="Logo"/>
    <p class="my-0 m-2 {{ auth()->check() ? 'd-none d-xl-block' : '' }}">
        {{ config('app.name') }}
        <small class="align-top opacity">{{ config('app.env') }}</small>
    </p>
</div>
