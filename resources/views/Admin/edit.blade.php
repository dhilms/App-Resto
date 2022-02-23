@extends('Dashboard.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="/user"> Back</a>
            </div>
        </div>
    </div>
    <br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/user/update" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama</strong>
                    <input type="text" name="name" class="form-control" placeholder="Enter New Name..." >
                </div>
                    <strong>Username</strong>
                    <input type="text" name="username" class="form-control" placeholder="Enter New Username...">

                    <strong>Password</strong>
                    <input type="password" name="password" class="form-control" placeholder="Enter New Password...">

                    <strong>Role</strong>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" id="inlineRadio1" value="admin">
                        <label class="form-check-label" for="inlineRadio1">Admin</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" id="inlineRadio1" value="manajer">
                        <label class="form-check-label" for="inlineRadio2">Manager</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" id="inlineRadio1" value="kasir">
                        <label class="form-check-label" for="inlineRadio3">Kasir</label>
                      </div>


            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
