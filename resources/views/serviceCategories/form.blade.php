<div class="form-group">
    <label>Title *</label>
    <input type="text" name="title" class="form-control" value="{{old('title',$item->title)}}" required>

    <span class="text-danger">
        @error('title')
        {{$message}}
        @enderror

    </span>
</div>

