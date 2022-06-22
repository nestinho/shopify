<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Category
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.categories')}}" class="btn btn-success pull-right">View All Categories</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>    
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="updateCategory">
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Category Name</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" name="name" wire:model="name" wire:keyup="generateslug" placeholder="Category Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Category Slug</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" name="slug" wire:model="slug" placeholder="Category Slug" />
                                </div>
                            </div>
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
