@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Edit Products
                        <a href="{{ url('admin/products') }}" class="btn btn-primary text-white btn-sm float-end">
                            Back
                        </a>
                    </h3>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif


                    <form action="{{ url('admin/products/' . $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">
                                    Home
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="tab"
                                    data-bs-target="#seotag-tab-pane" type="button" role="tab"
                                    aria-controls="seotag-tab-pane" aria-selected="false">
                                    SEO Tags
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">
                                    Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab"
                                    data-bs-target="#image-tab-pane" type="button" role="tab"
                                    aria-controls="image-tab-pane" aria-selected="false">
                                    Product Image
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="colors-tab" data-bs-toggle="tab"
                                    data-bs-target="#colors-tab-pane" type="button" role="tab"
                                    aria-controls="colors-tab-pane" aria-selected="false">
                                    Product Colors
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control" id="">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">{Product Name</label>
                                    <input type="text" class="form-control" value="{{ $product->name }}" name="name"
                                        id="">
                                </div>

                                <div class="mb-3">
                                    <label for="">{Product Slug</label>
                                    <input type="text" class="form-control" value="{{ $product->slug }}" name="slug"
                                        id="">
                                </div>

                                <div class="mb-3">
                                    <label for="">Brand</label>
                                    <select name="brand" class="form-control" id="">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}"
                                                {{ $brand->name == $product->brand ? 'selected' : '' }}>
                                                {{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="">{Small Description (500 Words)</label>
                                    <textarea name="small_description" class="form-control" rows="4">{{ $product->small_description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="">{Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
                                </div>

                            </div>

                            <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel"
                                aria-labelledby="seotag-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="">{Meta Title</label>
                                    <input type="text" class="form-control" value="{{ $product->meta_title }}"
                                        name="meta_title" id="">
                                </div>

                                <div class="mb-3">
                                    <label for="">{Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="4">{{ $product->meta_description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="">{Meta Keyword</label>
                                    <textarea name="meta_keyword" class="form-control" rows="4">{{ $product->meta_keyword }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Original Price</label>
                                            <input type="text" class="form-control"
                                                value="{{ $product->original_price }}" name="original_price"
                                                id="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Selling Price</label>
                                            <input type="text" class="form-control"
                                                value="{{ $product->selling_price }}" name="selling_price"
                                                id="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Quantity</label>
                                            <input type="number" class="form-control" value="{{ $product->quantity }}"
                                                name="quantity" id="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Trending</label>
                                            <input type="checkbox" name="trending"
                                                {{ $product->trending == '1' ? 'checked' : '' }}
                                                style="width: 50px; height: 50px;" id="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Featured</label>
                                            <input type="checkbox" name="featured"
                                                {{ $product->featured == '1' ? 'checked' : '' }}
                                                style="width: 50px; height: 50px;" id="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="">Status</label>
                                            <input type="checkbox" name="status"
                                                {{ $product->status == '1' ? 'checked' : '' }}
                                                style="width: 50px; height: 50px;" name="status">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel"
                                aria-labelledby="image-tab" tabindex="0">

                                <div class="mb-3">
                                    <label for="">
                                        Upload Product Images
                                    </label>
                                    <input type="file" name="image[]" multiple class="form-control" name=""
                                        id="">
                                </div>
                                <div>
                                    @if ($product->productImages)
                                        <div class="row">
                                            @foreach ($product->productImages as $image)
                                                <div class="col-md-2">
                                                    <img src="{{ asset($image->image) }}"
                                                        style="width:80px; height:80px;" class="me-4 border"
                                                        alt="Img" alt="">
                                                    <a href="{{ url('admin/product-image/' . $image->id . '/delete') }}"
                                                        class="d-block">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5>No Images Found</h5>
                                    @endif


                                </div>

                            </div>
                            <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel"
                                aria-labelledby="colors-tab" tabindex="0">
                                <div class="mb-3">
                                    <h4>Add Product Colors</h4>
                                    <label for="">
                                        Select Color
                                    </label>
                                    <hr>
                                    <div class="row">
                                        @forelse ($colors as $coloritem)
                                            <div class="col-md-3">
                                                <div class="p-2 border mb-3">
                                                    Colors: <input type="checkbox" name="colors[{{ $coloritem->id }}]"
                                                        value="{{ $coloritem->id }}">
                                                    {{ $coloritem->name }}
                                                    <br>
                                                    Quantity: <input type="number"
                                                        name="colorquantity[{{ $coloritem->id }}]"
                                                        style="width:70px; border: 1px solid" />
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <h1>No Colors Found!</h1>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>

                                                    <th>Color Name</th>
                                                    <th>Quanity</th>
                                                    <th>Delete</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product->productColors as $prodColor)
                                                    <tr class="prod-color-tr">
                                                        <td>
                                                            @if ($prodColor->color)
                                                                {{ $prodColor->color->name }}
                                                            @else
                                                                No Color Found
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="input-group mb-3" style="width:150px;">
                                                                <input type="text" value="{{ $prodColor->quantity }}"
                                                                    class="productColorQuantity form-control form-control-sm">
                                                                <button type="button" value="{{ $prodColor->id }}"
                                                                    class="updateProductColorBtn btn btn-primary btn-small text-white">Update</button>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" value="{{ $prodColor->id }}"
                                                                class="deleteProductColorBtn btn btn-danger btn-small text-white">Delete</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.updateProductColorBtn', function() {
                var product_id = "{{ $product->id }}";
                var prod_color_id = $(this).val();
                // alert(prod_color_id);
                var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();

                if (qty <= 0) {
                    alert('Quantity is Required');
                    return false;
                }

                var data = {
                    'product_id': product_id,
                    'qty': qty

                };
                $.ajax({
                    type: "POST",
                    url: "/admin/product-color/" + prod_color_id,
                    data: data,
                    success: function(response) {
                        alert(response.message)

                    }
                });


            });

            $(document).on('click', '.deleteProductColorBtn', function() {
                var prod_color_id = $(this).val();
                var thisClick = $(this);
                $.ajax({
                    type: "GET",
                    url: "/admin/product-color/" + prod_color_id + "/delete",
                    success: function(response) {
                        thisClick.closest('.prod-color-tr').remove();
                        alert(response.message)
                    }
                });


            });


        });
    </script>
@endsection
