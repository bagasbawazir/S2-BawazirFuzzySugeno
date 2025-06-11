@section('title', 'Inggridient')

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
                    @can('master_inggridients_create')
                        <div class="card-header">
                            <a href="{{ route('master_inggridient.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create New Data</a>
                        </div>
                    @endcan
                    <!-- ./card-header -->
                    <div class="card-body pt-4">
                        <livewire:data-table.master-inggridient-table />
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
