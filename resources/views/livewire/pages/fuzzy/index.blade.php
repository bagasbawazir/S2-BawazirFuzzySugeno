@section('title', 'Index Fuzzy')

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
                         <form wire:submit.prevent="submit">
                            <div class="row">
                                <div class="col">
                                    <fieldset disabled>
                                        <div class="form-group">
                                            <div class="input-group date" id="date_start" data-target-input="nearest">
                                                <div class="input-group-prepend" data-target="#date_start" data-toggle="datetimepicker">
                                                    <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                                </div>
                                                <input type="text" value="" class="form-control disabled @error('date_start') is-invalid @enderror datetimepicker-input" id="date_start" placeholder="Input Tanggal Awal" data-target="#reservationdate" wire:model.defer="date_start" />
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
                                                <input type="text" value="" class="form-control disabled @error('date_end') is-invalid @enderror datetimepicker-input" id="date_end" placeholder="Input Tanggal Akhir" data-target="#reservationdate" wire:model.defer="date_end" />
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
                                            <button type="submit" class="btn btn-large btn-primary submit">Process</button>
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
                            {{-- FUZZYFIKASI --}}
                            <h2>Fuzzyfikasi</h2>
                            <table  class="table table-bordered">

                                <thead>
                                    <th>ID INGGRIDIENT</th>
                                    <th>STOCK IN LITTLE</th>
                                    <th>STOCK IN LOTS</th>
                                    <th>STOCK OUT NOT ENOUGH</th>
                                    <th>STOCK OUT PLUS</th>
                                    <th>LAST STOCK SMALL</th>
                                    <th>LAST STOCK BIG</th>

                                </thead>
                                <tbody>

                                     @foreach ($this->inggridient as $key => $value)

                                        <tr>
                                            <td>{{ 'B' . '' . str_pad('' . $value['id_inggridient'], 5, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ number_format($this->range[$key]['little'],2) }}</td>
                                            <td>{{ number_format($this->range[$key]['lots'],2) }}</td>
                                            <td>{{ number_format($this->range[$key]['not_enough'],2) }}</td>
                                            <td>{{ number_format($this->range[$key]['plus'],2) }}</td>
                                            <td>{{ number_format($this->range[$key]['small'],2) }}</td>
                                            <td>{{ number_format($this->range[$key]['big'],2) }}</td>

                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>

                            {{-- INFERENSI FUZZY --}}
                            <div class="card-body">
                            @if($this->load_datatable)
                              <h2>Rules</h2>
                              <table class="table table-bordered">
                                <thead>
                                    <th>ID INGGRIDIENT</th>
                                    <th>MIN R1</th>
                                    <th>MIN R2</th>
                                    <th>MIN R3</th>
                                    <th>RESULT R1</th>
                                    <th>RESULT R2</th>
                                    <th>RESULT R3</th>
                                </thead>
                                <tbody>
                                  @foreach ($this->inggridient as $key => $value)
                                  <tr>
                                <td>{{ 'B' . '' . str_pad('' . $value['id_inggridient'], 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ number_format($this->range[$key]['R1'],2)  }}</td>
                                <td>{{ number_format($this->range[$key]['R2'],2) }}</td>
                                <td>{{ number_format($this->range[$key]['R3'],2) }}</td>
                                <td>{{ $this->range[$key]['resultR1'] }}</td>
                                <td>{{ $this->range[$key]['resultR2'] }}</td>
                                <td>{{ $this->range[$key]['resultR3'] }}</td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                             @endif
                        </div>
{{-- Defuzzyfikasi --}}
                         <div class="card-body">
                            @if($this->load_datatable)
                              <h2>DefuzzyFikasi</h2>
                              <table class="table table-bordered">
                                <thead>
                                    <th>ID INGGRIDIENT</th>
                                    <th>atas</th>
                                    <th>bawah</th>
                                    <th>Hasil Prediksi</th>
                                </thead>
                                <tbody>
                                  @foreach ($this->inggridient as $key => $value)
                                  <tr>
                                <td>{{ 'B' . '' . str_pad('' . $value['id_inggridient'], 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{number_format($this->range[$key]['nilai_atas'],2) }}</td>
                                <td>{{number_format($this->range[$key]['nilai_keanggotaan'],2) }}</td>
                                <td>{{number_format((float)$this->range[$key]['defuzzy'],2,'.','')}}</td>
                                </tr>
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
                format: 'DD/MM/YYYY',
                useCurrent: false

            });

            $('#date_end').datetimepicker({
                format: 'DD/MM/YYYY',
                useCurrent: true

            });
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
                    "visible": false,
                    "targets": 1
                }, {
                    "type": "date",
                    "targets": 0
                }],
                "pageLength": 50,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["csv", "excel", "print", "colvis"]
            }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
        })

        window.addEventListener('destroy', event => {
            $('#datatable').dataTable({
                "bDestroy": true
            }).fnDestroy();
        })
    </script>
@endpush
