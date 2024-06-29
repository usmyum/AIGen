@if ($item['show_condition'])
    @php
        $href = $item['route_slug'] ? route($item['route'], $item['route_slug']) : route($item['route']);
        $is_active = $href === url()->current() || activeRoute(...$item['active_condition'] ?: []);
    @endphp

    <x-navbar.item>
        <x-navbar.link
            class:letter-icon="{{ $item['letter_icon_bg'] }}"
            class="{{ data_get($item, 'class') }}"
            label="{{ __($item['label']) }}"
            href="{{ $item['route'] }}"
            slug="{{ $item['route_slug'] }}"
            icon="{{ $item['icon'] }}"
            active-condition="{{ $is_active }}"
            letter-icon="{{ (int) $item['letter_icon'] }}"
            onclick="{{ data_get($item, 'onclick') ?? '' }}"
            badge="{{ data_get($item, 'badge') ?? '' }}"
        />
    </x-navbar.item>
@endif
