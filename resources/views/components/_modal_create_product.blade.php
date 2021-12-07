<div id="modal-create-product" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fas fa-times-circle fa-lg"></i>
				</button>
            </div>
            <div class="modal-body pt-0 pb-0">
                <div class="row">
                    <div class="col-12 pt-5 pb-3">
                        <div class="modal-title text-center mb-4">
                            <h2 class="font-weight-bold">Nuevo producto</h2>
                        </div>
                        <div class="alert alert-warning col-12 mb-3">
                            <span class="font-weight-bold">Instrucciones:</span> Por favor complete los siguientes campos para el producto.
                        </div>
                        <div class="row">
                            <div class="offset-1 col-10">
                                <form id="product-create-form" action="{{ route('product_create_post') }}" method="POST" autocomplete="new-password">
                                    @csrf
                                    <input type="hidden" name="productId" id="productId">
                                    <div class="row">
                                        <div class="form-group col-12 col-sm-8 mt-3 mb-4">
                                            <label for="name" class="col-form-label font-weight-bold">Producto</label>
                                            <input id="name" type="text" class="form-control is-disabled @error('name') is-invalid @enderror" name="name" value="{{ @old('name') }}" autocomplete="new-password">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 col-sm-4 mt-3 mb-4">
                                            <label for="price" class="col-form-label font-weight-bold">Precio</label>
                                            <input id="price" type="text" class="form-control is-disabled @error('price') is-invalid @enderror" name="price" value="{{ @old('price') }}" autocomplete="new-password" placeholder="MXN" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-12 mt-3 text-center" id="btns-wrapper">
                                        <button type="submit" class="btn btn-success">
                                            Guardar
                                            <i class="fa fa-arrow-right ml-2"></i>
                                        </button>
                                        <button class="btn btn-secondary ml-0 ml-sm-4" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div id="transaction-error" class="alert alert-danger font-weight-bold col-12 mt-3 d-none" role="alert">
                                        Error al procesar el formulario, vuelva a intentar más tarde.
                                    </div>
                                    <div id="spinner-wrapper" class="col-12 text-center d-none">
                                        <i class="fas fa-spinner fa-spin fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/components/_modal_create_product.js') }}"></script>
@endpush