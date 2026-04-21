@props(['name', 'image', 'imagePreviewId', 'imageUploadId', 'imageLabelId'])
<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <div id="{{ $imagePreviewId }}" class="image-preview mb-3" @if($image)
    style="background-size:cover; background-image: url('{{ asset($image) }}')" @endif {{ $attributes->merge(['class' => 'ml-2',]) }}>
        <label for="{{ $imageUploadId }}" id="{{ $imageLabelId }}">Choose File</label>
        <input type="file" name="{{ $name }}" id="{{ $imageUploadId }}" />
    </div>
</div>