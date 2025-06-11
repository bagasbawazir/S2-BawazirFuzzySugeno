@section('title', 'Detail Inggridient')

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
                        <a href="{{ route('master_inggridient.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Back</a>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body pt-4">

                        <blockquote class="quote-secondary">
                            <h4>ID INGGRIDIENT: {{ 'B-' . '' . str_pad('' . $this->master_inggridient->id_inggridient, 5, '0', STR_PAD_LEFT) }}</h4>
                        </blockquote>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 170px"><strong>NAME INGGRIDIENT</strong></td>
                                    <td>{{ $this->master_inggridient->name_inggridient }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 170px"><strong>UNIT INGGRIDIENT</strong></td>
                                    <td>{{ $this->master_inggridient->unit_inggridient }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 170px"><strong>PRICE INGGRIDIENT</strong></td>
                                    <td>{{ $this->master_inggridient->price_inggridient }}</td>
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
