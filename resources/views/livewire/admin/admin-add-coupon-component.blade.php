<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Add New Coupon
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.coupons')}}" class="btn btn-success pull-right">View All Coupons</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('message')}}
                        </div>    
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="storeCoupon">
                             <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Coupon Code</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" name="code" wire:model="code"  placeholder="Coupon Type" />
                                    @error('code') 
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Coupon Type</label>
                                <div class="col-md-4">
                                    <select name="" id="" class="form-control" wire:model="type">
                                        <option value="">Select</option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percent">Percent</option>
                                    </select>
                                    @error('type') 
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Coupon Value</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" name="value" wire:model="value" placeholder="Coupon Value" />
                                    @error('value') 
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Cart Value</label>
                                <div class="col-md-4">
                                    <input class="form-control input-md" type="text" name="cart_value" wire:model="cart_value" placeholder="Cart Value" />
                                    @error('cart_value') 
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label">Expiry Date</label>
                                <div class="col-md-4" wire:ignore>
                                    <input class="form-control input-md" type="date" id="expiry-date" name="expiry_date" wire:model="expiry_date" placeholder="Expiry Date" />
                                    @error('expiry_date') 
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category_name" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $(function(){
            $('#expiry-date').datetimepicker({
                format: 'Y-MM-DD'
            })
            .on('dp.change', finction(ev){
                var data = $('#expiry-date').val();
                @this.set('expiry_date',data);
            });
        })
    </script>

@endpush
