<x-app-layout>
    <livewire:show-atelier :slug="$training->slug" />
<x-comments-section :training="$training" :comments="$comments" />
</x-app-layout>
