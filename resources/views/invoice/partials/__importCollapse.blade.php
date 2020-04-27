<b-collapse id="import-collapse">
    <b-card>
        <b-col cols="7">
            <h4>{{ __('Import new file') }}</h4>
            <p>{{ __('Your file extension must be .xls or .xlsx') }}</p>
            <b-form action="{{route('invoices.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <p-file-input
                    name="import_file"
                    id="import_file"
                    rules="required|ext:xls,xlsx"
                    accept=".xlsx, .xls"
                    :error="error"></p-file-input>
                <b-button type="submit" variant="outline-primary">{{ __('Import File') }}</b-button>
            </b-form>
        </b-col>
    </b-card>
</b-collapse>
