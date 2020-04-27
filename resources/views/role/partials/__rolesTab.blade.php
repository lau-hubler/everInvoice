<b-tab title="Roles">
    <b-card-text>
        <b-card title="{{ __('Create new Role') }}">
            <p-role-form action="{{ route('roles.store') }}" method="POST"></p-role-form>
        </b-card>

        <b-table-simple hover striped>
            <b-thead class="font-weight-bold">
                <b-th>{{ __('Name') }}</b-th>
                <b-th>{{ __('Description') }}</b-th>
                <b-th>{{ __('Permissions')  }}</b-th>
                <b-th>{{ __('Updated at') }}</b-th>
                <b-th></b-th>
            </b-thead>
            <b-tbody>
                @foreach($roles as $role)
                    <b-tr>
                        <b-td>{{ $role->name }}</b-td>
                        <b-td>{{ $role->description }}</b-td>
                        <b-td>
                            <ul>
                                @foreach($role->permissions as $permission)
                                    <li>{{ $permission->description }}</li>
                                @endforeach
                            </ul>
                        </b-td>
                        <b-td>{{ $role->updated_at }}</b-td>
                        <b-td>
                            <form action="{{ route('roles.destroy', $role) }}" method="post">
                                @method('DELETE')
                                @csrf()
                                <button type="submit" class="btn btn-link text-danger">
                                    <font-awesome-icon icon="trash" />
                                </button>
                            </form>
                        </b-td>
                    </b-tr>
                @endforeach
            </b-tbody>
        </b-table-simple>
    </b-card-text>
</b-tab>
