<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropzone PDF Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
</head>
<body>
    <h2>Dropzone PDF Upload in Laravel</h2>

    <form action="{{ route('pdf_store') }}" class="dropzone" id="pdf-upload" enctype="multipart/form-data">
        @csrf
    </form>

    <button type="button" id="button" class="btn btn-primary">Upload</button>

    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#pdf-upload', {
            maxFilesize: 1, // Maksimum ukuran file (MB)
            acceptedFiles: ".pdf", // Hanya menerima file PDF
            addRemoveLinks: true, // Tombol hapus file
            autoProcessQueue: false, // Tidak langsung mengupload file
            init: function () {
                var myDropzone = this;

                // AKSI KETIKA BUTTON UPLOAD DI KLIK
                $("#button").click(function (e) {
                    e.preventDefault();
                    myDropzone.processQueue();
                });

                this.on('sending', function (file, xhr, formData) {
                    // Tambahkan semua input form ke formData Dropzone yang akan dikirim via POST
                    var data = $('#pdf-upload').serializeArray();
                    $.each(data, function (key, el) {
                        formData.append(el.name, el.value);
                    });
                });
            }
        });
    </script>
</body>
</html>
