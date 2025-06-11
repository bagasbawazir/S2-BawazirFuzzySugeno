@section('title', 'Create Data Role')
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
                            <h3 class="card-title">Form Data Role</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body pt-4">
                            <form wire:submit.prevent="submit">
                                <div class="form-group">
                                    <label for="name">Name Role</label>
                                    <input type="text" class="form-control @error('role.name') is-invalid @enderror" id="name" placeholder="Enter Full Name" wire:model.defer="role.name">
                                    @error('role.name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="permissions">Permission</label>
                                    <div wire:ignore class="w-full">
                                        <div id="permissions-btn-container" class="mb-3">
                                            <button type="button" class="btn btn-info btn-sm select-all-button">Select All</button>
                                            <button type="button" class="btn btn-info btn-sm deselect-all-button">Deselect All</button>
                                        </div>
                                        <select class="select2bs4 form-control" required id="permissions" name="permissions" wire:model="permissions" data-minimum-results-for-search="Infinity" data-placeholder="Select Your Option" multiple="multiple">
                                            @foreach ($this->listsForFields['permissions'] as $key => $value)
                                                <option value="{{ $key }}">{{ Str::title(str_replace('_', ' ', $value)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-large btn-success submit">Save</button>
                                    <a href="{{ route('role.index') }}" class="btn btn-large btn-secondary">Cancel</a>
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        document.addEventListener("livewire:load", () => {
            let el = $('.select2bs4')
            let buttonsId = '#permissions-btn-container'

            function initButtons() {
                $(buttonsId + ' .select-all-button').click(function(e) {
                    el.val(_.map(el.find('option'), opt => $(opt).attr('value')))
                    el.trigger('change')
                })

                $(buttonsId + ' .deselect-all-button').click(function(e) {
                    el.val([])
                    el.trigger('change')
                })
            }

            function initSelect() {
                initButtons()
                $('.select2bs4').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Select Your Option',
                    allowClear: !el.attr('required')
                })
            }

            initSelect()

            Livewire.hook('message.processed', (message, component) => {
                initSelect()
            });

            el.on('change', function(e) {
                let data = $(this).select2("val")

                @this.set('permissions', data)
            });
        });
    </script>
@endpush
