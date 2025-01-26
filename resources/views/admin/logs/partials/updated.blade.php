<h2>عنوان مثلا محصول</h2>
<div class="table-responsive">
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>#</th>
            <th>نام</th>
            <th>مقدار قبلی</th>
            <th>مقدار جدید</th>
        </tr>
        </thead>
        <tbody>
        @foreach($log->properties['attributes']['new'] as $attr => $value)
            <tr class="{{ $log->properties['attributes']['original'][$attr] == $value ? ' class="bg-warning"' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->subject->getLabel($attr) }}</td>
                <td>
                    @if($attr == 'image')
                        <img src="{{ asset($log->properties['attributes']['original'][$attr]) }}" style="width: 45px; height: 45px">
                    @else
                        {{ $log->properties['attributes']['original'][$attr] }}
                    @endif
                </td>
                <td>
                @if($attr == 'image')
                    <img src="{{ asset($value) }}" style="width: 45px; height: 45px">
                @else
                    @include('admin.logs.partials.switch')
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@foreach($log->properties['relations'] as $name => $relation)
<h3>{{ $log->subject->getLabel($name) }}</h3>
<div class="table-responsive">
    <table class="table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>#</th>
            <th>نام</th>
            <th>مقدار</th>
        </tr>
        </thead>
        <tbody>
        @foreach($relation['new'] as $attr => $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $attr }}</td>
                <td>
                @if(is_array($value))
                    @foreach($value as $name => $val)
                        @unless($loop->first) <br> @endunless
                        <span>{{ $name }}:</span>
                        <strong>{{ $val }}</strong>
                    @endforeach
                @else
                    @if($attr == 'image')
                        <img src="{{ asset($value) }}" style="width: 45px; height: 45px">
                    @else
                        {{ $value }}
                    @endif
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endforeach
{{--<div class="table-responsive">
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
</div>--}}