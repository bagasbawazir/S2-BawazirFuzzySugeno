@section('title', 'Purchase')

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
                    @can('purchases_create')
                        <div class="card-header">
                            <a href="{{ route('purchase.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Data</a>
                            <a href="{{ route('purchase.recap') }}" class="btn btn-info"><i class="fas fa-info-circle"></i> Recap Data Purchase</a>
                        </div>
                    @endcan
                    <!-- ./card-header -->
                    <div class="card-body pt-4">
                        <livewire:data-table.purchase-table />
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
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
