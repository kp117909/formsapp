
@extends('layout')

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                     class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted  ">{{__("Administrator login Panel")}}</p>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="form-outline mb-4">
                        <input type="email" name = "email" id="email" class="form-control form-control-lg" />
                        <label class="form-label" for="email">{{__("Email")}}</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" name = "password" id="password" class="form-control form-control-lg" />
                        <label class="form-label" for="password">{{__("Password")}}</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{__("Sign in")}}</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
