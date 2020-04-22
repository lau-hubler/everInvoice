<b-collapse id="export-collapse">
    <b-card>
        <b-col cols="7">
            <h4>{{ __('Export files') }}</h4>
            <p>{{ __('Select your export format') }}</p>
            <b-form action="{{route('invoices.export')}}" method="POST">
                @csrf
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="formatToExport" id="xlsx" value="xlsx">
                    <label class="form-check-label" for="xlsx">.xlsx</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="formatToExport" id="csv" value="csv">
                    <label class="form-check-label" for="csv">.csv</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="formatToExport" id="txt" value="txt">
                    <label class="form-check-label" for="txt">.txt</label>
                </div>

                <b-button type="submit" variant="outline-primary">{{ __('Export Files') }}</b-button>
            </b-form>
        </b-col>
    </b-card>
</b-collapse>
