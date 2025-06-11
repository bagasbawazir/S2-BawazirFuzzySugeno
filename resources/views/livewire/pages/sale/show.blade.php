@section('title', 'Detail Sale')

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
                        <a href="{{ route('sale.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body pt-4">

                        <blockquote class="quote-secondary">
                            <h4>ID SALE:
                                {{ 'SA-' . '' . str_pad('' . $this->request_sale->id_sale, 5, '0', STR_PAD_LEFT) }}
                            </h4>
                        </blockquote>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 170px"><strong>NAME USER</strong></td>
                                    <td>{{ $this->request_sale->users->fullname }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="pt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID PRODUCT</th>
                                    <th>NAME PRODUCT</th>
                                    <th>PRICE PRODUCT</th>
                                    <th>QTY</th>
                                    <th>TOTAL PRICE</th>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($this->request_sale->master_products as $master_products)
                                        @php
                                            $subtotal += $master_products->pivot->total_price_product;
                                        @endphp
                                        <tr>
                                            <td>{{ 'P-' . '' . str_pad('' . $master_products->id_product, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $master_products->name_product }}</td>
                                            <td>{{ format_uang($master_products->price_product) }}</td>
                                            <td>{{ $master_products->pivot->qty }} {{ $master_products->unit_product }}</td>
                                            <td>{{ format_uang($master_products->pivot->total_price_product) }}</td>
                                        </tr>
                                        @if ($loop->last)
                                            <tr>
                                                <td colspan="4"><strong>SUBTOTAL</strong></td>
                                                <td><strong>{{ format_uang($subtotal) }}</strong></td>
                                            </tr>
                                        @endif
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
