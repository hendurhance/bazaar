<div class="row">
    <label class="col-md-3 form-label mb-4">Tags * :</label>
    <div class="col-md-9">
        <select class="form-control select2" name="tags[]" data-placeholder="Choose Tags" multiple>
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}" {{ collect(old('tags', $selectedTags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
            @endforeach
    </select>
        <span class="text-danger">{{ $errors->first('tags') }}</span>
    </div>
</div>