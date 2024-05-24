@extends('layouts.app')

@section('title', 'Create Item')

@section('content')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
            /* Adjust the height as needed */
        }
    </style>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container card">
        <div class="card-body">
            <h3>Create New Item</h3>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body px-5">
            <form id="form" action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="name" class="form-label">Item Name</label>
                            <input type="text" class="form-control input-field" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Insert item name..."
                                style="border: 1px solid #515050;" required>
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-control" id="category_id" width='300px'>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->category }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="condition" class="form-label">Condition</label>
                            <select name="condition" class="form-control" id="condition" width='300px'>
                                <option value="New">New</option>
                                <option value="Second">Second</option>
                            </select>
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" step="3" class="form-control input-field" id="price"
                                name="price" value="{{ old('price') }}" placeholder="Insert item price..."
                                autocomplete="off" style="border: 1px solid #515050;" required>
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control input-field" id="stock" name="stock"
                                value="{{ old('stock') }}" placeholder="Insert item stock..." autocomplete="off"
                                style="border: 1px solid #515050;" required>
                        </div>

                        <div class="mb-3 col-md-3 col-sm-3">
                            <label for="status" class="form-label">Status</label>
                            <label class="form-check form-switch">
                                <input class="form-check-input" name="status" type="checkbox" checked
                                    style="border: 1px solid #515050">
                                <span class="form-check-label">Aktif</span>
                            </label>
                        </div>
                    </div>

                    <div class="col">
                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="image" class="form-label">Image 1</label>
                            <input type="file" class="form-control" name="image" id="image" required>
                            <img id="preview" class="mt-2" width="300" height="180" alt=""
                                style="border: 1px solid #515050; border-radius: 3px">
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="imageSec" class="form-label">Image 2 (Optional)</label>
                            <input type="file" class="form-control" name="imageSec" id="imageSec">
                            <img id="previewSec" class="mt-2" width="300" height="180" alt=""
                                style="border: 1px solid #515050; border-radius: 3px">
                        </div>

                        <div style="width: 300px" class="mb-4 col-md-12 col-sm-12">
                            <label for="imageThird" class="form-label">Image 3 (Optional)</label>
                            <input type="file" class="form-control" name="imageThird" id="imageThird">
                            <img id="previewThird" class="mt-2" width="300" height="180" alt=""
                                style="border: 1px solid #515050; border-radius: 3px">
                        </div>
                    </div>
                    <hr class="my-4" />

                    <div>
                        <label class="fw-semibold mb-2" for="description">Description</label>
                        <textarea name="description" id="description" value="{{ old('description') }}"></textarea>
                    </div>

                    <div class="mt-4 mb-4">
                        <a type="button" class="btn btn-outline-secondary me-2" style="width: 80px"
                            href="{{ route('items.index') }}">Back</a>
                        <button style="width: 80px" class="btn btn-primary" type="submit">Save</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#category_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });

            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });

            $('#condition').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                minimumResultsForSearch: -1,
            });

            var price = new AutoNumeric('#price', {
                allowDecimalPadding: false,
                currencySymbol: "Rp. "
            })

            $('#form').submit(function(e) {
                //var numericInput = AutoNumeric.getAutoNumericElement('#price');
                var plainValue = price.getNumber();
                document.querySelector('#price').value = plainValue;
            });

            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#imageSec').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewSec').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('#imageThird').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewThird').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

        });
    </script>
@endsection
