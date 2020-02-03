@extends('front.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Oops ! Ce site n'est pas encore compatible avec les mobiles ou les tablettes...</p>
                <img class="no-mobile-image"
                     src="{{ asset('images/no-mobile.png') }}"
                     alt="no mobile">
            </div>
        </div>
    </div>
@endsection
