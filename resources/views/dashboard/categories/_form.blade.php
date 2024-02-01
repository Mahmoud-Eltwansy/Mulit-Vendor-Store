<div class="form-group">
    <x-form.input label="Category Name" name="name" :value="$category->name"/>
</div>

<div class="form-group">
    <label for="">Category Parent</label>
    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
        <option value="">Primary Category</option>
        @foreach($parents as $parent)
            <option
                value="{{$parent->id}}" @selected(old('parent_id',$category->parent_id)==$parent->id)>{{$parent->name}}</option>
        @endforeach
    </select>
    @error('parent_id')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>

<div class="form-group">
    <x-form.textarea name="description" :value="$category->description" class="form-control" label="Description"/>
</div>

<div class="form-group">
    <x-form.label>Status</x-form.label>
    <div>
        <x-form.radio name="status" :checked="$category->status"
                      :options="['active'=>'Active', 'archived'=>'Archived']"/>
    </div>
</div>
@error('status')
<div class="text-danger">
    {{$message}}
</div>
@enderror
</div>

<div class="form-group">
    <x-form.label id="image">Image</x-form.label>
    <div>
        <x-form.input type="file" name="image" accept="image/*"/>
        @if($category->image)
            <img src="{{asset('storage/'.$category->image)}}" height="50">
        @endif
        @error('image')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
</div>
