<b-list-group>
    <b-list-group-item
        href="{{ route('invoices.index') }}"
        {{ App\Helpers\Nav::is('invoices.index') ? 'active' : '' }}
    >
        {{ __('invoice.title') }}
    </b-list-group-item>

    <b-list-group-item
        href="{{ route('stakeholders.index') }}"
        {{ App\Helpers\Nav::is('stakeholders.index') ? 'active' : '' }}
    >
        {{ __('stakeholder.title') }}
    </b-list-group-item>

    <b-list-group-item
        href="{{ route('products.index') }}"
        {{ App\Helpers\Nav::is('products.index') ? 'active' : '' }}
    >
        {{ __('product.title') }}
    </b-list-group-item>

    <b-list-group-item
        href="{{ route('categories.index') }}"
        {{ App\Helpers\Nav::is('categories.index') ? 'active' : '' }}
    >
        {{ __('category.title') }}
    </b-list-group-item>
</b-list-group>
