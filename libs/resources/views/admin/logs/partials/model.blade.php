<h2>{{ $log->log_name }}</h2>
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
        @isset($log->properties['model'])
        @foreach($log->properties['model'] as $row)
            <tr class="{{ $row['is_changed'] ? 'changed' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->subject->getLabel($row['name']) }}</td>
                <td>
                @if($row['old'])
                    @switch($row['type'])
                        @case('image')
                            <img src="{{ asset($row['old']) }}" style="width: 45px; height: 45px">
                            @break
                        @case('integer')
                            {{ (int) $row['old'] }}
                            @break
                        @case('price')
                            {{ number_format($row['old'], 0) }} تومان
                            @break
                        @case('decimal')
                            {{ number_format($row['old'], 2) }}
                            @break
                        @case('datetime')
                            {{ jdate($row['old'])->format('d F Y ساعت H:i') }}
                            @break
                        @case('boolean')
                            {{
                                $row['old'] 
                                ? 'بله'
                                : 'خیر'
                            }}
                            @break
                        @case('relation')
                            <p>
                                @foreach($row['old'] as $key => $value)
                                {{ $log->subject->getLabel($key) }}: <strong>{{ $value }}</strong>
                                @unless($loop->last) <br> @endunless
                                @endforeach
                            </p>
                            @break
                        @default
                        {{ $row['old'] }}
                    @endswitch
                @endif
                </td>
                <td>
                @if($row['new'])
                    @switch($row['type'])
                        @case('image')
                            <img src="{{ asset($row['new']) }}" style="width: 45px; height: 45px">
                            @break
                        @case('integer')
                            {{ (int) $row['new'] }}
                            @break
                        @case('price')
                            {{ number_format($row['new'], 0) }} تومان
                            @break
                        @case('decimal')
                            {{ number_format($row['new'], 2) }}
                            @break
                        @case('datetime')
                            {{ jdate($row['new'])->format('d F Y ساعت H:i') }}
                            @break
                        @case('boolean')
                            {{
                                $row['new'] 
                                ? 'بله'
                                : 'خیر'
                            }}
                            @break
                        @case('relation')
                            <p>
                                @foreach($row['new'] as $key => $value)
                                {{ $log->subject->getLabel($key) }}: <strong>{{ $value }}</strong>
                                @unless($loop->last) <br> @endunless
                                @endforeach
                            </p>
                            @break
                        @default
                        {{ $row['new'] }}
                    @endswitch
                @endif
                </td>
            </tr>
        @endforeach
        @endisset
        </tbody>
    </table>
</div>
@isset($log->properties['relations'])
    @foreach($log->properties['relations'] as $name => $relation)
    <h3>{{ $log->subject->getLabel($name) }}</h3>
    <div class="table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
            <tr>
                <th>#</th>
                <th>شناسه</th>
                <th>مقدار قدیمی</th>
                <th>مقدار جدید</th>
            </tr>
            </thead>
            <tbody>
            @foreach($relation as $id => $row)
                <tr @if($row['is_changed']) class="bg-warning" @endif>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $id }}</td>
                    <td>
                    @if(isset($row['old']) && $row['old'])
                        @foreach($row['old'] as $key => $value)
                            @unless($loop->first) <br> @endunless
                            @if(is_array($value))
                                @foreach($value as $pivotKey => $pivotValue)
                                    @unless($loop->first) <br> @endunless
                                    {{ $log->subject->getLabel($pivotKey) }}: <strong>{{ $pivotValue }}</strong>
                                @endforeach
                            @else
                                {{ $log->subject->getLabel($key) }}: <strong>{{ $value }}</strong>
                            @endif
                        @endforeach
                    @endif
                    </td>
                    <td>
                    @if(isset($row['new']) && $row['new'])
                        @foreach($row['new'] as $key => $value)
                            @unless($loop->first) <br> @endunless
                            @if(is_array($value))
                                @foreach($value as $pivotKey => $pivotValue)
                                    @unless($loop->first) <br> @endunless
                                    {{ $log->subject->getLabel($pivotKey) }}: <strong>{{ $pivotValue }}</strong>
                                @endforeach
                            @else
                                {{ $log->subject->getLabel($key) }}: <strong>{{ $value }}</strong>
                            @endif
                        @endforeach
                    @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
@endisset