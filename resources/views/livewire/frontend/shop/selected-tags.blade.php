<div>
    <ul class="tags">
        @forelse($selectedCategoryNames as $name)
            <li>
                <span>
                    {{ $name }}
                    <i class="iconsax" data-icon="add" wire:click="removeCategory('{{ $name }}')"></i>
                </span>
            </li>
        @empty
            
        @endforelse
    </ul>
</div>
