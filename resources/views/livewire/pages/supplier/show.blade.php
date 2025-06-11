@section('title', 'Detail Supplier')

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
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body pt-4">

                        <blockquote class="quote-secondary">
                            <h4>ID SUPPLIER: {{ 'S-' . '' . str_pad('' . $this->supplier->id_supplier, 5, '0', STR_PAD_LEFT) }}</h4>
                        </blockquote>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 200px"><strong>NAME SUPPLIER</strong></td>
                                    <td>{{ $this->supplier->name_supplier }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 200px"><strong>PHONE SUPPLIER</strong></td>
                                    <td>{{ $this->supplier->phone_supplier }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 200px"><strong>ADDRESS SUPPLIER</strong></td>
                                    <td>{{ $this->supplier->address_supplier }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 200px"><strong>DESCRIPTION SUPPLIER</strong></td>
                                    <td>{{ $this->supplier->description_supplier }}</td>
                                </tr>
                            </tbody>
                        </table>
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
