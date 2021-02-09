@extends('layouts.cus_app')

@section('content')
    <div class="wrapper-page">
        <div class="home-img-section">
            <div class="img-1">
                <div class="sec-1">
                    <div class="home-content">
                        <h1>EEG with ML</h1>
                        <div class="small">
                            <h6>using machine learning to emulate 3D game</h6>
                            <a href="{{ route('visualize') }}" class="btn btn-sm btn-primary rounded">View Visualize</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="img-2">
                <div class="sec-2">
                    <div class="home-content">
                        <h1>Brain Activity</h1>
                        <div class="small">
                            <h6>using machine learning to emulate 3D game</h6>
                            <a href="{{ route('game') }}" class="btn btn-sm btn-primary rounded">View Emulation</a>
                        </div>
                    </div>
                </div>
            </div>
            @if(can('browse_users'))
                <div class="img-3">
                    <div class="sec-3">
                        <div class="home-content">
                            <h1>users</h1>
                            <h1>{{ collect($users)->count() }}</h1>
                            <div class="small-1">
                                <h6>You have {{ collect($users)->count() }} users in your database. Click on button below to view all users.</h6>
                                <a href="{{ route('admin.users') }}" class="btn btn-sm btn-primary rounded">View All Users</a>
                            <div class="small">
                        </div>
                    </div>
                </div>
            @else
                 <script type="application/javascript">
                     document.getElementsByClassName('home-img-section')[0].style.gridTemplateColumns = "50% 50%"
                     document.getElementsByClassName('img-2')[0].style.minHeight = '60vh'
                     document.getElementsByClassName('sec-2')[0].style.minHeight = '60vh'
                 </script>
            @endif
        </div>
@endsection
