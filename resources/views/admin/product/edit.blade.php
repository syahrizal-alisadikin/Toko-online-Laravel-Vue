@extends('layouts.app', ['title' => 'Edit Produk'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-bag"></i> EDIT PRODUK</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>GAMBAR</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>NAMA PRODUK</label>
                            <input type="text" name="title" value="{{ old('title', $product->title) }}"
                                placeholder="Masukkan Nama Produk"
                                class="form-control @error('title') is-invalid @enderror">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>KATEGORI</label>
                                    <select name="fk_category_id" class="form-control">
                                        <option value="">-- PILIH KATEGORI --</option>
                                        @foreach ($categories as $category)
                                            @if($product->fk_category_id == $category->id)
                                                <option value="{{ $category->id  }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id  }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('fk_category_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BERAT (gram)</label>
                                    <input type="number" name="weight"
                                        class="form-control @error('weight') is-invalid @enderror"
                                        value="{{ old('weight', $product->weight) }}" placeholder="Berat Produk (gram)">

                                    @error('weight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>DESKRIPSI</label>
                            <textarea class="form-control content @error('content') is-invalid @enderror" name="content"
                                rows="6"
                                placeholder="Deskripsi Produk">{{ old('content', $product->content) }}</textarea>

                            @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>HARGA</label>
                                    <input type="number" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $product->price) }}" placeholder="Harga Produk">

                                    @error('price')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DISKON (%)</label>
                                    <input type="number" name="discount"
                                        class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount', $product->discount) }}"
                                        placeholder="Diskon Produk (%)">

                                    @error('discount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.8.2/tinymce.min.js"></script>
<script>
    var editor_config = {
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);
</script>
@endsection