@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header font-weight-bold">Inventario</div>

                    <div class="card-body">
                        @if(session('message-success') || session('message-error'))
                            <div class="alert alert-{{ session('message-success') ? 'success' : 'error' }} alert-dismissible fade show" role="alert">
                                {{ session('message-success') ? session('message-success') : session('message-error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12 mb-4">
                                <a href="#" class="btn btn-primary product-create" data-toggle="modal" data-target="#modal-create-product">Nuevo producto</a>
                            </div>
                        </div>

                        <div class="table-wrapper">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <th class="text-center align-middle" width="10%">ID</th>
                                    <th class="text-center align-middle">Producto</th>
                                    <th class="text-center align-middle" width="10%">Precio</th>
                                    <th class="text-center align-middle" width="150px"></th>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td class="text-right">@money($product->price)</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-warning product-edit" data-product="{{ json_encode($product) }}" title="Actualizar producto" data-toggle="modal" data-target="#modal-create-product">
                                                    <i class="fas fa-edit fa-lg" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('product_delete', ['productId' => $product->id]) }}" class="btn btn-danger" title="Eliminar producto">
                                                    <i class="far fa-trash-alt fa-lg" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No existen productos registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @if($products->hasPages())
                                <div class="d-flex justify-content-end mt-5">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components._modal_create_product')

@endsection
