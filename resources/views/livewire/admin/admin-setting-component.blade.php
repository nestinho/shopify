<div>
    <div class="container" style="padding: 30px 0;">
    <style>
        nav svg{
            height:20px;
        }

        nav .hidden{
            display: block !important;
        }
    </style>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                            Settings
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-sm pull-right">Dashboard</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('setting_success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('setting_success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" wire:submit.prevent="saveSettings">
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-4">
                                    <input type="email" placeholder="Email" class="form-control input-md" wire:model="email"/>
                                    @error('email') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Phone </label>
                                <div class="col-md-4">
                                    <input type="tel" placeholder="Phone 1" class="form-control input-md" wire:model="phone"/>
                                    @error('phone1') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Toll Free</label>
                                <div class="col-md-4">
                                    <input type="tel" placeholder="Phone 2" class="form-control input-md" wire:model="phone2"/>
                                    @error('phone2') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Address</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Address" class="form-control input-md" wire:model="address"/>
                                    @error('address') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Map</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Map URL" class="form-control input-md" wire:model="map"/>
                                    @error('map') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Twitter</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Twitter URL" class="form-control input-md" wire:model="twitter"/>
                                    @error('twitter') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Facebook</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Facebook URL" class="form-control input-md" wire:model="facebook"/>
                                    @error('facebook') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Pinterest</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Pinterest URL" class="form-control input-md" wire:model="pinterest"/>
                                    @error('pinterest') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Instagram</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Instagram URL" class="form-control input-md" wire:model="instagram"/>
                                    @error('instagram') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label">Youtube</label>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Youtube URL" class="form-control input-md" wire:model="youtube"/>
                                    @error('youtube') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email" class="col-md-4 control-label"></label>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
