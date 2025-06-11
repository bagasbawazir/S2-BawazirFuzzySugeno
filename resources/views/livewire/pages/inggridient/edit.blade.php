@section('title', 'Editing Data Inggridient')
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
                            <h3 class="card-title">Form Data Master Inggridient</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body pt-4">
                            <form wire:submit.prevent="submit">
                                <div class="form-group">
                                    <label for="name_inggridient">Name Inggridient</label>
                                    <input type="text" class="form-control @error('master_inggridient.name_inggridient') is-invalid @enderror" id="name_inggridient" placeholder="Enter Name Inggridient" wire:model.defer="master_inggridient.name_inggridient">
                                    @error('master_inggridient.name_inggridient')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="unit_inggridient">Unit Inggridient</label>
                                    <div wire:ignore>
                                        <select class="select2bs4 form-control" name="selected" wire:model="selected" required>
                                            <option value="">Select your option</option>
                                            <option value="gr">gr</option>
                                            <option value="ml">ml</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price_inggridient">Price Inggridient</label>
                                    <input type="number" class="form-control @error('master_inggridient.price_inggridient') is-invalid @enderror" id="price_inggridient" placeholder="Enter Name Inggridient" wire:model.defer="master_inggridient.price_inggridient">
                                    @error('master_inggridient.price_inggridient')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-large btn-success submit">Update</button>
                                    <a href="{{ route('master_inggridient.index') }}" class="btn btn-large btn-secondary">
                                        Cancel
                                    </a>
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
            $('.select2bs4').on('change', function(e) {
                var data = $('.select2bs4').select2("val");
                @this.set('selected', data);
            });
        });
    </script>
@endpush
