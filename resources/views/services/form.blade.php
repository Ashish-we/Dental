<div class="form-group">
    <label>Title *</label>
    <input type="text" name="title" class="form-control" value="{{old('title',$item->title)}}" required>

    <span class="text-danger">
        @error('title')
        {{$message}}
        @enderror

    </span>
</div>

<div class="form-group">
    <label>Service Type *</label>

    <select class="custom-select" name="category_id" id="dentist" required>


        <option value="">Select Service Type </option>

        @foreach ($service_type as $service)
        <option value="{{ $service->id }}" @selected(old('category_id', $item->category_id) == $service->id)>{{ $service->title }}</option>
        @endforeach
    </select>

    <span class="text-danger">
        @error('category_id')
        {{ $message }}
        @enderror

    </span>

</div>

<div class="form-group">
    <label>Treatment Type</label>
    <input type="text" name="treatment_type" class="form-control" value="{{old('treatment_type',$item->treatment_type)}}">

    <span class="text-danger">
        @error('treatment_type')
        {{$message}}
        @enderror

    </span>
</div>

<div class="form-group">
    <label>Price (NRS) *</label>
    <input type="text" name="price" class="form-control" value="{{old('price',$item->price)}}" required>

    <span class="text-danger">
        @error('price')
        {{$message}}
        @enderror

    </span>
</div>