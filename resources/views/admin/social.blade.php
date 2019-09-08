@extends('admin')

@section('content')
<div class="container-fluid">
    <h4 class="page-title"><i class="fe-sliders"></i> &nbsp;Ustawienia</h4>
</div>
    <form method="POST" action="{{route('admin.settings.social.update')}}">
    @method('PUT')
        @csrf
        <div class="container-fluid">
            <div class="card">

                @include('admin.subsettings')

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success border-0">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <label for="social_fb" class="col-2 col-form-label control-label"><i class="fe-facebook"></i> &nbsp;Facebook</label>
                                <div class="col-10">
                                    <input value="{{ settings('social_fb') }}" class="form-control" name="social_fb" id="social_fb" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="social_yt" class="col-2 col-form-label control-label"><i class="fe-youtube"></i> &nbsp;Youtube</label>
                                <div class="col-10">
                                    <input value="{{ settings('social_yt') }}" class="form-control" name="social_yt" id="social_yt" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="social_insta" class="col-2 col-form-label control-label"><i class="fe-instagram"></i> &nbsp;Instagram</label>
                                <div class="col-10">
                                    <input value="{{ settings('social_insta') }}" class="form-control" name="social_insta" id="social_insta" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="social_tw" class="col-2 col-form-label control-label"><i class="fe-twitter"></i> &nbsp;Twitter</label>
                                <div class="col-10">
                                    <input value="{{ settings('social_tw') }}" class="form-control" name="social_tw" id="social_tw" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="social_lin" class="col-2 col-form-label control-label"><i class="fe-linkedin"></i> &nbsp;Linkedin</label>
                                <div class="col-10">
                                    <input value="{{ settings('social_lin') }}" class="form-control" name="social_lin" id="social_lin" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group form-group-submit row">
            <div class="col-12">
                <input name="submitUstawienia" id="submit" value="Zapisz" class="btn btn-primary" type="submit">
            </div>
        </div>
    </form>
@endsection
