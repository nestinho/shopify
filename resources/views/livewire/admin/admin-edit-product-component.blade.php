<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Product
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.products')}}" class="btn btn-success pull-right">View All Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>
                        @endif
                        <form class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateProduct">
                            <div class="form-group">
                                <label for="product_name" class="col-md-4 control-label">Product Name</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" wire:model="name" wire:keyup="generateSlug" placeholder="Product Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_slug" class="col-md-4 control-label">Product Slug</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" wire:model="slug" placeholder="Product Slug" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="short_description" class="col-md-4 control-label">Short Description</label>
                                <div class="col-md-4">
                                   <textarea class="form-control" placeholder="Short description" wire:model="short_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-md-4 control-label">Description</label>
                                <div class="col-md-4">
                                   <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="regular_price" class="col-md-4 control-label">Regular Price</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="number" name="regular_price" wire:model="regular_price" placeholder="Regular Price" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sale_price" class="col-md-4 control-label">Sale Price</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="number" name="sale_price" wire:model="sale_price" placeholder="Sale Price" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SKU" class="col-md-4 control-label">SKU</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" name="SKU" wire:model="SKU" placeholder="SKU" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="instock_status" class="col-md-4 control-label">In Stock Status</label>
                                <div class="col-md-4">
                                    <select class="form-control">
                                        <option value="instock">In Stock</option>
                                        <option value="outofstock">Out of Stock</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="instock_status" class="col-md-4 control-label">Featured</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="number" name="quantity" wire:model="quantity" placeholder="Quantity" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Product Image</label>
                                <div class="col-md-4">
                                    <input class="input-file" type="file" wire:model="newimage"/><br/>
                                    @if($newimage)
                                        <img src="{{ $newimage->temporaryUrl() }}" width="120" />
                                    @else
                                        <img src="{{asset('assets/images/products')}}/{{$image}}" width="120" />
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Product Gallery</label>
                                <div class="col-md-4">
                                    <input class="input-file" type="file" wire:model="newimages" multiple/><br/>
                                    @if($newimages)
                                        @foreach($newimages as $newimage)
                                            @if($newimage)
                                                <img src="{{ $newimage->temporaryUrl() }}" width="120" />
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach($images as $image)
                                            @if($image)
                                                <img src="{{asset('assets/images/products')}}/{{$image}}" width="120" />
                                            @endif
                                        @endforeach     
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="instock_status" class="col-md-4 control-label">Category</label>
                                <div class="col-md-4">
                                    <select class="form-control" wire:model="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="product_attribute" class="col-md-4 control-label">Product Attributes</label>
                                <div class="col-md-3">
                                    <select class="form-control" wire:model="attr">
                                        <option value="">-- Select Attribute --</option>
                                        @foreach($product_attributes as $product_attribute)
                                        <option value="{{$product_attribute->id}}">{{$product_attribute->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary btn-sm" wire:click.prevent="add">Add</button>
                                </div>
                            </div>
                            @foreach($inputs as $key => $value)
                                <div class="form-group">
                                    <label for="" class="col-md-4 control-label">{{ $product_attributes->where('id',$attribute_arr[$key])->first()->name }}</label>
                                    <div class="col-md-3">
                                        <input class="form-control input-md" placeholder="{{ $product_attributes->where('id',$attribute_arr[$key])->first()->name }}" type="text"  wire:model="attribute_values.{{ $value }}" />
                                    </div>
                                    <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})"><i class="fa fa-times"></i></button>
                                </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
