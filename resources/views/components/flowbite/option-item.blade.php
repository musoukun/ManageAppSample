@props([
    'primaryKey' => '',
    'setPrimaryKey' => '',
    'route' => '',
    'svg' => '',
])
<div>
    <a href="{{ route($route, [$primaryKey => $setPrimaryKey]) }}"
        class="flex items-center pt-1 pb-1 pl-3 pr-3 hover:bg-gray-100">
        @svg( $svg , 'w-6 h-6')
        <span>{{ $slot }}</span>
    </a>
</div>
