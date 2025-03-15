<!DOCTYPE html>
<html>
<head>
    <title>Upload File Dengan Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center my-5">Upload File Dengan Laravel</h2>
        <div class="col-lg-8 mx-auto my-5">

            {{-- Pesan Jika Ada Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br/>
                    @endforeach
                </div>
            @endif

            {{-- Pesan Jika Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close text-decoration-none" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pesan Jika Error --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close text-decoration-none" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('upload.resize') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="file"><b>File Gambar</b></label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="keterangan"><b>Keterangan</b></label>
                    <textarea class="form-control" name="keterangan" id="keterangan" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</body>
</html>
