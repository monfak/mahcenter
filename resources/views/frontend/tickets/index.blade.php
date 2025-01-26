@extends('frontend.layouts.app')
@section('title', 'پیام‌های پشتیبانی')
@section('content')
<div class="container pt-5 pb-4">
    <div class="row">
        @include('frontend.layouts.sidebar')
        <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
           <div class="card crd-info">
                <div class="text-h5">پیام‌های پشتیبانی من</div>
                <div class="d-block mt-1 mb-1">
                    <span class="red-line"></span>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>اولویت</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ticket->title }}</td>
                                    <td>
                                        @if($ticket->priority == 'high')
                                            زیاد
                                        @elseif($ticket->priority == 'medium')
                                            متوسط
                                        @else
                                            کم
                                        @endif
                                    </td>
                                    <td>{{ jdate($ticket->created_at)->format('d M Y') }}</td>
                                    <td>{{ $ticket->status == 1 ? 'باز' : 'بسته' }}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs" href="{{ route('panel.tickets.show', $ticket->slug) }}">
                                            <span class="fa fa-eye"></span>
                                            مشاهده پیام
                                        </a>
        
                                        <form style="display: inline-block;" action="{{ route('panel.tickets.destroy', $ticket->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-{{ $ticket->status ? 'warning' : 'success' }} btn-xs" name="status" value="{{ $ticket->status ? 0 : 1}}">
                                                <span class="fa fa-{{ $ticket->status ? 'close' : 'check' }}"></span> {{ $ticket->status ? 'بستن پیام' : 'باز کردن پیام' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <a class="btn btn-primary btn-sm" href="{{ route('panel.tickets.create') }}">پیام پشتیبانی جدید</a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection
