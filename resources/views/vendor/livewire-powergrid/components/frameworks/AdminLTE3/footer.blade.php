<div>
    @includeIf(data_get($setUp, 'footer.includeViewOnTop'))
    @if (!is_array($data) && count(data_get($setUp, 'footer.perPageValues')) > 1)
        <footer class="mt-50 w-100 px-1">
            <div class="row d-flex justify-content-between">
                <div class="col-auto my-sm-2 my-md-0 ms-sm-0">
                    @if (data_get($setUp, 'footer.perPage') && count(data_get($setUp, 'footer.perPageValues')) > 1)
                        <div class="d-flex flex-lg-row align-items-center">
                            <label class="w-auto">
                                <select wire:model.lazy="setUp.footer.perPage" class="form-control">
                                    @foreach (data_get($setUp, 'footer.perPageValues') as $value)
                                        <option value="{{ $value }}">
                                            @if ($value == 0)
                                                {{ trans('livewire-powergrid::datatable.labels.all') }}
                                            @else
                                                {{ $value }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <small class="ms-2 text-muted">
                                    {{ trans('livewire-powergrid::datatable.labels.results_per_page') }}
                                </small>
                            </label>
                        </div>
                    @endif
                </div>
                <div class="col-auto my-sm-2 my-md-0 ms-sm-0">
                    @if (method_exists($data, 'links'))
                        {!! $data->links(data_get($setUp, 'footer.pagination') ?: powerGridThemeRoot() . '.pagination', [
                            'recordCount' => data_get($setUp, 'footer.recordCount'),
                        ]) !!}
                    @endif
                </div>
            </div>
        </footer>
    @endif
    @includeIf(data_get($setUp, 'footer.includeViewOnBottom'))
</div>
