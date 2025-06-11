@section('title', 'Recap Purchase')

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

                        <div class="card-header">

                         <form wire:submit.prevent="submit">
                            <div class="row">
                                <div class="col">
                                    <fieldset disabled>
                                        <div class="form-group">
                                            <div class="input-group date" id="date_start" data-target-input="nearest">
                                                <div class="input-group-prepend" data-target="#date_start" data-toggle="datetimepicker">
                                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                                </div>
                                                <input type="text" value="" class="form-control disabled @error('date_start') is-invalid @enderror datetimepicker-input" id="date_start" placeholder="Input Date Start" data-target="#reservationdate" wire:model.defer="date_start" />
                                                @error('date_start')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>

                                <div class="col">
                                    <fieldset disabled>
                                        <div class="form-group">
                                            <div class="input-group date" id="date_end" data-target-input="nearest">
                                                <div class="input-group-prepend" data-target="#date_end" data-toggle="datetimepicker">
                                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                                </div>
                                                <input type="text" value="" class="form-control disabled @error('date_end') is-invalid @enderror datetimepicker-input" id="date_end" placeholder="Input Date End" data-target="#reservationdate" wire:model.defer="date_end" />
                                                @error('date_end')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                 <div class="col">
                                    <div class="form-group">
                                        <div wire:loading.remove>
                                            <button type="submit" class="btn btn-large btn-primary submit">Filter</button>
                                        </div>
                                        <div wire:loading.inline-flex>
                                            <button class="btn btn-large btn-primary" type="button" disabled>
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
                     </tbody>

                    <!-- ./card-header -->
                        <div class="card-body">
                            @if($this->load_datatable)
                            <table id="datatable" class="table table-bordered">
                                <thead>
                                    <th>ID INGGRIDIENT</th>
                                    <th>NAME INGGRIDIENT</th>
                                    <th>QUANTITY TOTAL INGGRIDIENT</th>
                                    <th>UNIT INGGRIDIENT</th>
                                    <th>TOTAL PRICE</th>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                        $totalqty = 0
                                    @endphp
                                     @foreach ($this->recap as $recapPurchase)
                                        @php
                                            $subtotal += $recapPurchase['total_price_inggridient'];
                                            $totalqty += $recapPurchase['qty'];

                                        @endphp
                                        <tr>
                                            <td>{{ 'B-' . '' . str_pad('' . $recapPurchase['id_inggridient'], 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $recapPurchase['name_inggridient'] }}</td>
                                            <td>{{$recapPurchase['qty'] }}</td>
                                            <td>{{$recapPurchase['unit_inggridient'] }}</td>
                                            <td>{{$recapPurchase['total_price_inggridient'] }}</td>
                                        </tr>
                                        @if ($loop->last)
                                            <tr>
                                                <td colspan="2"><strong>Total Quantity </strong></td>
                                                <td><strong>{{ $totalqty }}</strong></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                        @if ($loop->last)
                                            <tr>
                                                <td colspan="4"><strong>SUBTOTAL</strong></td>
                                                <td><strong>{{ $subtotal }}</strong></td>

                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
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

@push('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-3JRrEUwaCkFUBLK1N8HehwQgu8e23jTH4np5NHOmQOobuC4ROQxFwFgBLTnhcnQRMs84muMh0PnnwXlPq5MGjg==" crossorigin="anonymous" />
@endpush

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
<script>
    document.addEventListener('livewire:load', function() {
        // Get the value of the "count" property
        var firstDate = @this.data_first_date
        var lastDate = @this.data_last_date

        @this.set('date_start', moment(firstDate).format('DD/MM/YYYY'));
        @this.set('date_end', moment(lastDate).format('DD/MM/YYYY'));

        $('#date_start').datetimepicker({
            format: 'DD/MM/YYYY'
            , useCurrent: false
            , minDate: new Date(firstDate)
            , maxDate: new Date(lastDate)
            , defaultDate: new Date(firstDate)
        , });

        $('#date_end').datetimepicker({
            format: 'DD/MM/YYYY'
            , useCurrent: false
            , minDate: new Date(firstDate)
            , maxDate: new Date(lastDate)
            , defaultDate: new Date(lastDate)
        , });
    })

    $('#date_start').on("hide.datetimepicker", function(e) {
        @this.set('date_start', moment(e.date).format('DD/MM/YYYY'));
    });

    $('#date_end').on("hide.datetimepicker", function(e) {
        @this.set('date_end', moment(e.date).format('DD/MM/YYYY'));
    });

    window.addEventListener('initSomething', event => {
        $("#datatable").DataTable({
            "columnDefs": [{
                    "visible": false
                    , "targets": 1
                }
                , {
                    "type": "date"
                    , "targets": 0
                }
            ]
            , "pageLength": 50
            , "lengthMenu": [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ]
            , "responsive": true
            , "lengthChange": true
            , "autoWidth": false
            , "buttons": ["csv", "excel", "print", "colvis"]
        }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    })

    window.addEventListener('destroy', event => {
        $('#datatable').dataTable({
            "bDestroy": true
        }).fnDestroy();
    })

</script>
@endpush

