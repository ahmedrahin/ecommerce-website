<!--begin:: Avatar -->
<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <a href="{{ route('admin-management.admin-list.show', $user->id) }}">
        @php
            $imagePath = $user->avatar ? $user->avatar : 'uploads/blank-image.svg'; 
            $imageUrl = asset($imagePath);
        @endphp
        @if($user->avatar)
        <div class="symbol-label">
            <img src="{{ $imageUrl }}" class="w-100 h-100" style="object-fit: cover;" />
        </div>
        @else
        <div
            class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $user->name) }}">
            {{ substr($user->name, 0, 1) }}
        </div>
        @endif
    </a>
</div>
<!--end::Avatar-->
<!--begin::User details-->
<div class="d-flex flex-column">
    <a href="{{ route('admin-management.admin-list.show', $user->id) }}" class="text-gray-800 text-hover-primary mb-1">
        {{ $user->name }}
    </a>
    <span>{{ $user->email }}</span>
</div>
<!--begin::User details-->