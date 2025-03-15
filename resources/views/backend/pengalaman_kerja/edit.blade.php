@extends('backend.layouts.template')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="icon_document_alt"></i> Edit Pengalaman Kerja</h3>
                <ol class="breadcrumb">
                    <li><i class="fa fa-home"></i><a href="{{ url('dashboard') }}">Home</a></li>
                    <li><i class="icon_document_alt"></i> Riwayat Hidup</li>
                    <li><i class="fa fa-files-o"></i> Pengalaman Kerja</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit Pengalaman Kerja
                    </header>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pengalaman_kerja.update', $pengalaman_kerja->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pekerjaan</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pengalaman_kerja->nama }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $pengalaman_kerja->jabatan }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" class="form-control" id="tahun_masuk" name="tahun_masuk" value="{{ $pengalaman_kerja->tahun_masuk }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_keluar" class="form-label">Tahun Selesai</label>
                                <input type="number" class="form-control" id="tahun_keluar" name="tahun_keluar" value="{{ $pengalaman_kerja->tahun_keluar }}" required>
                            </div>

                            <!-- Tombol Save (Biru) dan Cancel (Abu-abu) -->
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('pengalaman_kerja.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
@endsection
