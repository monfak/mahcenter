@extends('frontend.layouts.app')
@section('title', 'آدرس‌های من')
@section('content')
<div class="container pt-5 pb-4">
    <div class="row">
        @include('frontend.layouts.sidebar')
        <div id="content" class="col-sm-9 p-xs-0 mt-xs-15">
            <div class="card crd-info">
                <div class="d-flex justify-between items-center">
                    <div class="text-h5">آدرس های من</div>
                    <div>
                        <a href="{{ route('panel.addresses.create') }}" class="btn btn-outline-danger">
                            <svg style="width: 24px; height: 24px; fill:#dc3545;">
                                <use xlink:href="#newAddress">
                                    <symbol id="newAddress" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M4 9.611C4 5.391 7.59 2 12 2s8 3.39 8 7.611c0 2.818-1.425 5.518-3.768 8.034a23.496 23.496 0 01-2.514 2.322c-.517.413-.923.706-1.166.867L12 21.2l-.552-.366c-.243-.16-.65-.454-1.166-.867a23.499 23.499 0 01-2.514-2.322C5.425 15.129 4 12.428 4 9.61zM11 6v3H8v2h3v3h2v-3h3V9h-3V6h-2zm3.768 10.281A21.542 21.542 0 0112 18.769a21.536 21.536 0 01-2.768-2.488C7.2 14.101 6 11.826 6 9.611 6 6.521 8.67 4 12 4s6 2.522 6 5.611c0 2.215-1.2 4.49-3.232 6.67z" clip-rule="evenodd"></path></symbol>
                                </use>
                                </svg>
                                     افزودن آدرس
                        </a>
                    </div>
                </div>
                <div class="d-block mt-1 mb-1">
                         <span class="red-line"></span>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover table-striped table-condensed ">
                        <thead>
                            <tr>
                                <th>عنوان آدرس</th>
                                <th>تلفن</th>
                                <th>شهر</th>
                                <th>کدپستی</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($addresses as $address)
                            <tr>
                                <td>
                                    {{ $address->name }}
                                    @if($address->is_default)
                                    <span class="label label-success">پیش فرض</span>
                                    @endif
                                </td>
                                <td>{{ $address->phone }}</td>
                                <td>{{ $address->city->name }}</td>
                                <td>{{ $address->post_code }}</td>
                                <td>
                                    <form action="{{ route('panel.addresses.destroy', $address->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a class="" href="{{ route('panel.addresses.edit', $address->id) }}">
                                           <svg style="width: 20px; height: 20px; fill:#19bfd3;">
                                         <use xlink:href="#edit">
                                            <symbol id="edit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M15.293 3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-12 12A1 1 0 018 21H4a1 1 0 01-1-1v-4a1 1 0 01.293-.707l12-12zM5 16.414V19h2.586l11-11L16 5.414l-11 11zM21 21H10l2-2h9v2z" clip-rule="evenodd"></path></symbol> 
                                         </use>
                                     </svg>
                                        </a>
                                        <button type="submit" class="" name="delete" value="1" onclick="return confirm('آیا از حذف این آدرس اطمینان دارید؟');">
                                          <svg style="width: 24px; height: 24px; fill: var(--color-icon-error);">
                                              <use xlink:href="#delete">
                                                  <symbol id="delete" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M8 2v2h8V2H8zM4 7V5h16v2H4zm13 1h2v11a3 3 0 01-3 3H8a3 3 0 01-3-3V8h2v11a1 1 0 001 1h8a1 1 0 001-1V8zm-6 0H9v10h2V8zm2 0h2v10h-2V8z" clip-rule="evenodd"></path></symbol>
                                              </use>
                                              </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
               <div class="box-footer clearfix">
                      {{ $addresses->links() }}
                      
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
