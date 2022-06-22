<div>
    <style>
        nav svg{
            height: 20px;
        }

        nav .hidden{
            display: block !important;
        }

        .sub-category-list{
            list-style: none;
        }
    </style>

    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                All Attributes
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.add_attribute')}}" class="btn btn-success pull-right">Add New Attribute</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        @if(Session::has('delete_success_message'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('delete_success_message')}}
                            </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#.</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product_attributes as $product_attribute)
                                <tr>
                                    <td>{{$product_attribute->id}}</td>
                                    <td>{{$product_attribute->name}}</td>
                                    <td>{{$product_attribute->created_at}}</td>
                                    <td>
                                        <a href="{{route('admin.edit_attribute',['attribute_id'=>$product_attribute->id])}}"><i class="fa fa-edit fa-2x"></i></a>
                                        <a href="#" onclick="return confirm('Are you sure you want to delete this attribute?') || event.StopImmediatePropagation()" wire:click.prevent="deleteAttribute({{$product_attribute->id}})" style="margin-left: 10px;"><i class="fa fa-trash fa-2x text-danger"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$product_attributes->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
