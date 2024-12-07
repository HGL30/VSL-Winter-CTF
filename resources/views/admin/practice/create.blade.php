@extends('admin.admin')

@section('content-admin')
<h5 style="font-weight: bold; font-size: 32px; margin-top: 30px; margin-left: 20px;">Create Lab</h5>
<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <form action="{{ route('admin.practice.store')}}" enctype="multipart/form-data" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name" style="font-weight: bold;">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="difficulty" style="font-weight: bold;">Difficulty:</label>
                    <input type="text" name="difficulty" id="difficulty" class="form-control" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="description" style="font-weight: bold;">Description:</label>
                    <input type="text" name="description" id="description" class="form-control" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="type" style="font-weight: bold;">Type:</label>
                    <select name="type" id="type" class="form-control" style="width: 500px;">
                        <option value="forensics">Forensics</option>
                        <option value="web">Web Exploitation</option>
                        <option value="reverse">Reverse Engineering</option>
                        <option value="crypto">Cryptography</option>
                        <option value="osint">OSINT</option>
                        <option value="pwn">PWN</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file" style="font-weight: bold;">File:</label>
                    <input type="file" name="file" id="file" class="form-control" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="link" style="font-weight: bold;">Link:</label>
                    <input type="link" name="link" id="link" class="form-control" style="width: 500px;">
                </div>
                <div class="form-group">
                    <label for="flag" style="font-weight: bold;">Flag:</label>
                    <input type="text" name="flag" id="flag" class="form-control" style="width: 500px;">
                </div>
                <div class="form-group" style="margin-top: 10px;">
                    <input class="btn btn-info btn-sm" type="submit" value="Create Lab">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection