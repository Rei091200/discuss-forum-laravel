@extends ('layouts.app')

@section('content')
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h3 class="panel-title">Edit Profil</h3>
        <form action="/user/{{ $user->id }}/update" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Nama</label>
              <input value="{{ $user->name }}" type="text" class="form-control" name="name" placeholder="Ketik nama anda disini">
            </div>
            <div class="form-group">
              <label>Telepon</label>
              <input value="{{ $user->phone }}" type="text" class="form-control" name="phone" placeholder="Ketik nomor telepon anda disini">
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="avatar" id="avatar">
              <label class="custom-file-label" for="avatar">Choose avatar</label>
            </div>
            <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.querySelector('.custom-file-input').addEventListener('change',function(e){
      var fileName = document.getElementById("myInput").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = fileName
    })
  </script>
@stop