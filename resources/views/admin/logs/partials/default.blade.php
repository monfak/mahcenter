<div class="table-responsive">
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th>#</th>
            <th>نام پراپرتی</th>
            <th>مقدار قدیمی</th>
            <th>مقدار جدید</th>
        </tr>
        </thead>
        <tbody>
        @foreach($log->changes['attributes'] as $attr => $value)
            <tr @if(($log->changes['old'][$attr] ?? '') != $value) class="bg-warning" @endif>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $attr }}</td>
                <td>{{ $log->changes['old'][$attr] ?? '' }}</td>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>