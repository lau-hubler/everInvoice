@extends('layouts.app')

@section('content')
<div class="container px-5 py-3 justify-content-center">
    <b-card>
        <b-card-title>Factura</b-card-title>
        <b-card-text>Dados</b-card-text>
    </b-card>
</div>
<div class="container px-5 pb-3">
    <b-card-group deck>
        <b-card>
            <b-card-title>Cliente</b-card-title>
            <b-card-text>
                <p>1</p>
                <p>2</p>
                <p>3</p>
                <p>4</p>
                <p>5</p>
            </b-card-text>
        </b-card>

        <b-card>
            <b-card-title>Vendedor</b-card-title>
            <b-card-text>Dados</b-card-text>
        </b-card>
    </b-card-group>
</div>
<div class="container px-5">
    <b-card>
        <template v-slot:header>
            <h6 class="mb-0 h4">Header Slot</h6>
        </template>
        <b-card-text>Productos</b-card-text>
    </b-card>
</div>
@endsection
