<b-tab title="My profile" active>
    <b-card-text >
        <b-card-group deck>
            <b-card
                title="{{$user->name}} {{$user->surname}}"
                style="max-width: 22rem;"
                img-src="https://www.seekpng.com/png/small/349-3499598_portrait-placeholder-placeholder-person.png"
                img-top
            >
                <b-card-text>
                    <ul>
                        <li><strong>{{__('user.email')}}:</strong> {{$user->email}} </li>
                        <li><strong>{{__('Role')}}:</strong> {{$user->role->name}} </li>
                    </ul>
                </b-card-text>
            </b-card>
            <b-card>
                <b-card-sub-title class="mb-2">{{ __('Permissions') }}</b-card-sub-title>
                <b-card-text>
                    <b-table-simple hover>
                        <b-thead class="font-weight-bold text-center">
                            <b-th></b-th>
                            <b-th>List</b-th>
                            <b-th>Create</b-th>
                            <b-th>Edit</b-th>
                            <b-th>Details</b-th>
                            <b-th>Delete</b-th>
                            <b-th>Import</b-th>
                            <b-th>Export</b-th>
                        </b-thead>
                        <b-tbody>
                            <b-tr>
                                <b-td class="font-weight-bold">Invoices</b-td>
                                @foreach(['index', 'store', 'update', 'show', 'delete', 'import', 'export'] as $action)
                                    <b-td class="text-center">
                                        @if($permissions->contains('code',"invoice.$action"))
                                            <font-awesome-icon icon="check" class="text-green-600"/>
                                        @else
                                            <font-awesome-icon icon="times" class="text-red-600"/>
                                        @endif
                                    </b-td>
                                @endforeach
                            </b-tr>
                            @foreach(['stakeholder', 'product', 'category', 'order', 'role'] as $class)
                                <b-tr>
                                    <b-td class="font-weight-bold">{{ $class }}</b-td>
                                    @foreach(['index', 'store', 'update', 'show', 'delete'] as $action)
                                        <b-td class="text-center">
                                            @if($permissions->contains('code',"$class.$action"))
                                                <font-awesome-icon icon="check" class="text-green-600"/>
                                            @else
                                                <font-awesome-icon icon="times" class="text-red-600"/>
                                            @endif
                                        </b-td>
                                    @endforeach
                                </b-tr>
                            @endforeach
                        </b-tbody>
                    </b-table-simple>
                </b-card-text>
            </b-card>
        </b-card-group>
    </b-card-text>
</b-tab>
