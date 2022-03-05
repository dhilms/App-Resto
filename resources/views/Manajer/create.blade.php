@extends('Dashboard.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Menu</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('Manajer.index') }}"> Back</a>
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

    <form action="{{ route('Manajer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Menu</strong>
                    <input type="text" name="nama_menu" class="form-control" placeholder="Enter New Menu...">
                </div>
                <div class="form-group">
                    <strong>Harga</strong>
                    <input type="number" name="harga" class="form-control" placeholder="Enter New Username...">
                </div>
                <div class="form-group">
                    <strong for="Description">Description</strong>
                    <textarea class="form-control rounded-0" name="deskripsi" id="exampleFormControlTextarea2" rows="3"></textarea>
                  </div>
                <div class="form-group">
                    <strong>Tersedia</strong>
                    <input type="number" name="ketersediaan" class="form-control" placeholder="Available...">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
