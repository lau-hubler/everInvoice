<b-tab title="Users">
    <b-card-text>
        <b-table-simple hover striped>
            <b-thead class="font-weight-bold">
                <b-th>{{ __('Name') }}</b-th>
                <b-th>{{ __('Email') }}</b-th>
                <b-th>{{ __('Role')  }}</b-th>
                <b-th>{{ __('Updated at') }}</b-th>
                <b-th></b-th>
            </b-thead>
            <b-tbody>
                @foreach($users as $u)
                    <p-user-role-row
                        action="{{ route('roles.updateUser', $u->id) }}"
                        method="POST"
                        u="{{json_encode($u)}}"
                        stringify-roles="{{json_encode($roles)}}"
                    ></p-user-role-row>
                @endforeach
            </b-tbody>
        </b-table-simple>
    </b-card-text>
</b-tab>
