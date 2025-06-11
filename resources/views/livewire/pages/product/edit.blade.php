@section('title', 'Editing Data Product')
<div>
    <div>
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            @livewire('components.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @include('includes.content-header')

                <!-- Main content -->
                <section class="content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Data Product</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body pt-4">
                            <form wire:submit.prevent="submit">
                                <div class="form-group">
                                    <label for="name_product">Name Product</label>
                                    <input type="text" class="form-control @error('master_product.name_product') is-invalid @enderror" id="name_product" placeholder="Enter Name master_product" wire:model.defer="master_product.name_product">
                                    @error('master_product.name_product')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="unit_inggridient">Unit Product</label>
                                    <div wire:ignore>
                                        <select id="unit_product" class="select2bs4 form-control" name="unit_product" wire:model="unit_product" required>
                                            <option value="">Select your option</option>
                                            <option value="cup">cup</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price_product">Price Product</label>
                                    <input type="number" class="form-control @error('master_product.price_product') is-invalid @enderror" id="price_product" placeholder="Enter Name master_product" wire:model.defer="master_product.price_product">
                                    @error('master_product.price_product')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-large btn-success submit">Update</button>
                                    <a href="{{ route('master_product.index') }}" class="btn btn-large btn-secondary">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Inggridient</h3>
                        </div>
                        <div class="card-body pt-4">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <div wire:ignore>
                                            <select id="keyInggridient" class="select2bs4 form-control" name="keyInggridient" wire:model.defer="keyInggridient" required>
                                                <option value="">Select your option</option>
                                                @foreach ($this->listsForInggridient['inggridients'] as $value)
                                                    <option value="{{ $value['id_inggridient'] }}">
                                                        {{ $value['name_inggridient'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <input type="number" class="form-control @error('usage_amount') is-invalid @enderror" id="usage_amount" placeholder="Enter Usage Amount" wire:model.defer="usage_amount">
                                    @error('usage_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <a wire:click="add_inggridient" class="btn btn-large btn-primary">Add Inggridient Product</a>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <thead>
                                        <th>ID INGGRIDIENT</th>
                                        <th>NAME INGGRIDIENT</th>
                                        <th>USAGE AMOUNT</th>
                                        <th>ACTION</th>
                                    </thead>
                                </thead>
                                <tbody>
                                    @foreach ($productInggridient as $key => $value)
                                        <tr>
                                            <td>{{ $value['id_inggridient'] }}</td>
                                            <td>{{ $value['name_inggridient'] }}</td>
                                            <td>{{ $value['usage_amount'] }} {{ $value['unit_inggridient'] }}</td>
                                            <td>
                                                <a wire:click="delete_inggridient({{ $value['id_inggridient'] }})" class="btn btn-sm btn-danger fas fa-trash-alt"> Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include('includes.footer')
        </div>
        <!-- ./wrapper -->
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: !$('.select2bs4').attr('required')
            })
            $('#unit_product').on('change', function(e) {
                var data = $('#unit_product').select2("val");
                @this.set('unit_product', data);
            });

            $('#keyInggridient').on('change', function(e) {
                var data = $('#keyInggridient').select2("val");
                @this.set('keyInggridient', data);
            });
        });
    </script>
@endpush
