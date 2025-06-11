@section('title', 'Detail Purchase')

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
                        <a href="{{ route('purchase.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                            Back</a>
                    </div>
                    <!-- ./card-header -->
                    <div class="card-body pt-4">

                        <blockquote class="quote-secondary">
                            <h4>ID PURCHASE:
                                {{ 'PU-' . '' . str_pad('' . $this->purchase->id_purchase, 5, '0', STR_PAD_LEFT) }}
                            </h4>
                        </blockquote>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width: 170px"><strong>NAME SUPPLIER</strong></td>
                                    <td>{{ $this->purchase->suppliers->name_supplier }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 170px"><strong>NAME USER</strong></td>
                                    <td>{{ $this->purchase->users->fullname }}</td>
                                </tr>
                                  <tr>
                                    <td style="width: 170px"><strong>Description</strong></td>
                                    <td>{{ $this->purchase->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="pt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <th>ID INGGRIDIENT</th>
                                    <th>NAME INGGRIDIENT</th>
                                    <th>DATE EXPIRED</th>
                                    <th>PRICE INGGRIDIENT</th>
                                    <th>QTY PURCHASE</th>
                                    <th>TOTAL PRICE</th>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($this->purchase->master_inggridients as $master_inggridients)
                                        @php
                                            $subtotal += $master_inggridients->pivot->total_price_inggridient;
                                        @endphp
                                        <tr>
                                            <td>{{ 'B-' . '' . str_pad('' . $master_inggridients->id_inggridient, 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $master_inggridients->name_inggridient }} ({{ $master_inggridients->unit_inggridient }})</td>
                                            <td>{{ \Carbon\Carbon::parse($master_inggridients->pivot->date_expired)->format('l, d F Y') }}</td>
                                            <td>{{ format_uang($master_inggridients->price_inggridient) }}</td>
                                            <td>{{ $master_inggridients->pivot->qty }}</td>
                                            <td>{{ format_uang($master_inggridients->pivot->total_price_inggridient) }}</td>
                                        </tr>
                                        @if ($loop->last)
                                            <tr>
                                                <td colspan="5"><strong>SUBTOTAL</strong></td>
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
