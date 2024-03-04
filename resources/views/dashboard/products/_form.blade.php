<div class="form-group">
    <x-form.input label="Product Name" name="name" :value="$product->name" />
</div>

<div class="form-group">
    <label for="">Category</label>
    <select name="category_id" class="form-control >
        <option value="">Primary Category</option>
        @foreach(App\Models\Category::all() as $category)
            <option
                value=" {{$category->id}}" @selected(old('category_id',$product->category_id)==$category->id)>{{$category->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <x-form.textarea name="description" :value="$product->description" class="form-control" label="Description" />
</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <div>
        <x-form.input type="file" name="image" accept="image/*" />
        @if($product->image)
        <img src="{{asset('storage/'.$product->image)}}" height="50">
        @endif
        @error('image')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div>

<div class="form-group">
    <x-form.radio name="status" :checked="$product->status" :options="['active'=>'Active','archived'=>'Archived','draft'=>'Draft']" label="Status" />
</div>

<div class="form-group">
    <x-form.input name="price" label="Price" :value="$product->price" />
</div>

<div class="form-group">
    <x-form.input name="compare_price" label="Compare Price" :value="$product->compare_price" />
</div>

<div class="form-group">
    <x-form.input name="tags" label="Tags" :value="$tags" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
</div>

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
        tagify = new Tagify(inputElm);
</script>
@endpush