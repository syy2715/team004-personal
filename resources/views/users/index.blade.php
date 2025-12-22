<table class="table table-bordered table-hover align-middle text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>所属課</th>
            <th>メール</th>
            <th>電話番号</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->group_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone ?? '未登録' }}</td>
            <td>
                <a href="{{ url('/users/' . $user->id . '/edit') }}"
                    class="btn btn-sm btn-warning">
                    編集
                </a>

                <form action="{{ url('/users/' . $user->id) }}"
                        method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('削除しますか？')">
                        削除
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
