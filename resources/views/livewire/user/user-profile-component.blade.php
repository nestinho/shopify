<div>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6"><b>Profile</b></div>
                            <div class="col-md-6">
                                <a href="{{route('user.editprofile')}}" class="btn btn-success btn-sm pull-right">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            @if($user->profile->image)
                                <img src="{{asset('assets/images/profiles')}}/{{$user->profile->image}}" width="100%" />
                            @else   
                                <img src="{{asset('assets/images/profiles/default.png')}}" width="100%" />
                            @endif
                        </div>
                        <div class="col-md-8">
                            <p><b>Name: </b>{{$user->name}}</p>
                            <p><b>Email: </b>{{$user->email}}</p>
                            <p><b>Phone: </b>{{$user->profile->mobile}}</p>
                            <hr>
                            <p><b>Line 1: </b>{{$user->profile->line1}}</p>
                            <p><b>Line 2: </b>{{$user->profile->line2}}</p>
                            <p><b>City: </b>{{$user->profile->city}}</p>
                            <p><b>Province: </b>{{$user->profile->province}}</p>
                            <p><b>Country: </b>{{$user->profile->country}}</p>
                            <p><b>Zipcode: </b>{{$user->profile->zipcode}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
