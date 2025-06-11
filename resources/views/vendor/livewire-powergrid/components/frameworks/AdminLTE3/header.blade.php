<div>
    @includeIf(data_get($setUp, 'header.includeViewOnTop'))
    <div class="dt--top-section">
        <div class="row">
            <div class="col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center">
                @include(powerGridThemeRoot() . '.header.actions')
                <div class="px-1">
                    @includeWhen(data_get($setUp, 'exportable'), powerGridThemeRoot() . '.header.export')
                </div>
                @include(powerGridThemeRoot() . '.header.toggle-columns')
                @includeIf(powerGridThemeRoot() . '.header.soft-deletes')

                @include(powerGridThemeRoot() . '.header.loading')
            </div>
            <div class="col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3">
                @include(powerGridThemeRoot() . '.header.filter')
            </div>
            <div class="col-12 col-sm-6 mt-sm-0 mt-3">
                <div class="row">
                    <label class="col-sm-3 col-form-label">Filter by Date:</label>
                    <div class="col-sm-8">
                        <x-livewire-powergrid::inline-filters :makeFilters="$makeFilters" :checkbox="$checkbox" :actions="$actions" :columns="$columns" :theme="$theme" :filters="$filters" :enabledFilters="$enabledFilters" :inputTextOptions="$inputTextOptions" :tableName="$tableName" :setUp="$setUp" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include(powerGridThemeRoot() . '.header.batch-exporting')
    @include(powerGridThemeRoot() . '.header.enabled-filters')
    @includeIf(data_get($setUp, 'header.includeViewOnBottom'))
    @includeIf(powerGridThemeRoot() . '.header.message-soft-deletes')
</div>
