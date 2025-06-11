<div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        <span>
            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </span>
    </a>
    <div class="dropdown-menu">
        @if (in_array('excel', data_get($setUp, 'exportable.type')))
            <div class="d-flex justify-content-end dropdown-item bg-transparent">
                @lang('Excel')
                <a class="mx-1 btn btn-sm btn-light" wire:click="exportToXLS()" href="#">
                    @lang('livewire-powergrid::datatable.labels.all')
                </a>
                @if ($checkbox)
                    /
                    <a class="mx-1 btn btn-sm btn-light" wire:click="exportToXLS(true)" href="#">
                        @lang('livewire-powergrid::datatable.labels.selected')
                    </a>
                @endif
            </div>
        @endif
        @if (in_array('csv', data_get($setUp, 'exportable.type')))
            <div class="d-flex justify-content-end dropdown-item bg-transparent">
                @lang('Csv')
                <a class="mx-1 btn btn-sm btn-light" wire:click="exportToCsv" href="#">
                    @lang('livewire-powergrid::datatable.labels.all')
                </a>
                @if ($checkbox)
                    /
                    <a class="mx-1 btn btn-sm btn-light" wire:click="exportToCsv(true)" href="#">
                        @lang('livewire-powergrid::datatable.labels.selected')
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
