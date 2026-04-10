@props(['name', 'image'])
<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <div class="mb-3" @if($image) style="background-size:cover; background-image: url('{{ asset($image) }}')" @endif {{ $attributes->merge(['id' => 'image-preview', 'class' => 'ml-2',]) }}>
        <label for="image-upload" id="image-label">Choose File</label>
        <input type="file" name="{{ $name }}" id="image-upload" />
    </div>
</div>