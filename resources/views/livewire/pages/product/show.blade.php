@section('title', 'Detail Product')

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
                        <a href="{{ route('master_product.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body pt-4">

                        <blockquote class="quote-secondary">
                            <h4>ID PRODUCT:
                                {{ 'P-' . '' . str_pad('' . $this->master_product->id_product, 5, '0', STR_PAD_LEFT) }}
                            </h4>
                        </blockquote>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 170px"><strong>NAME PRODUCT</strong></td>
                                    <td>{{ $this->master_product->name_product }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 170px"><strong>UNIT PRODUCT</strong></td>
                                    <td>{{ $this->master_product->unit_product }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 170px"><strong>PRICE PRODUCT</strong></td>
                                    <td>{{ $this->master_product->price_product }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="pt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID INGGRIDIENT</th>
                                    <th>NAME INGGRIDIENT</th>
                                    <th>USAGE AMOUNT</th>
                                    <th>PRICE INGGRIDIENT</th>
                                </thead>
                                <tbody>
                                    @foreach ($this->master_product->master_inggridients as $master_inggridients)
                                        <tr>
                                            <td>{{ 'B-' . '' . str_pad('' . $master_inggridients->id_inggridient, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $master_inggridients->name_inggridient }}</td>
                                            <td>{{ $master_inggridients->pivot->usage_amount }} {{ $master_inggridients->unit_inggridient }}</td>
                                            <td>{{ $master_inggridients->price_inggridient }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
