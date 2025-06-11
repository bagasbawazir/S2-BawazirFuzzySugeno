@section('title', 'Create Data Supplier')
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
                            <h3 class="card-title">Form Data Supplier</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body pt-4">
                            <form wire:submit.prevent="submit">
                                <div class="form-group">
                                    <label for="name_supplier">Name Supplier</label>
                                    <input type="text" class="form-control @error('supplier.name_supplier') is-invalid @enderror" id="name_supplier" placeholder="Enter Name Supplier" wire:model.defer="supplier.name_supplier">
                                    @error('supplier.name_supplier')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone_supplier">Phone Supplier</label>
                                    <input type="text" class="form-control @error('supplier.phone_supplier') is-invalid @enderror" id="phone_supplier" placeholder="Enter Phone Supplier" wire:model.defer="supplier.phone_supplier">
                                    @error('supplier.phone_supplier')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address_supplier">Address Supplier</label>
                                    <textarea class="form-control @error('supplier.address_supplier') is-invalid @enderror" id="address_supplier" rows="3" placeholder="Enter ..." wire:model.defer="supplier.address_supplier"></textarea>
                                    @error('supplier.address_supplier')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description_supplier">Description Supplier</label>
                                    <textarea class="form-control @error('supplier.description_supplier') is-invalid @enderror" id="description_supplier" rows="3" placeholder="Enter ..." wire:model.defer="supplier.description_supplier"></textarea>
                                    @error('supplier.description_supplier')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-large btn-success submit">Save</button>
                                    <a href="{{ route('supplier.index') }}" class="btn btn-large btn-secondary">Cancel</a>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include('includes.footer')
        </div>
        <!-- ./wrapper -->
    </div>
</div>
