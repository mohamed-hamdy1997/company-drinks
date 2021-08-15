<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="main-content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <section class="users-list-wrapper">
                <!-- Table starts -->
                <div class="users-list-table">
                    @include('flash-message')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- Datatable starts -->
                                        <div class="table-responsive" style="overflow-x: visible;">
                                            <div id="users-list-datatable_wrapper"
                                                 class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table id="users-list-datatable" class="table dataTable no-footer" role="grid" aria-describedby="users-list-datatable_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="ID: activate to sort column descending"
                                                                    style="width: 41.4219px;">المسلسل
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 185.391px;">الاسم
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 185.391px;">البريد الالكتروني
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">النوع
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">الدور(الطابق)
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">رقم الموبايل
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">عدد المشاريب المسموحه
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">عدد المشاريب المستخدمه اليوم
                                                                </th>

                                                                <th class="" rowspan="1" colspan="1"
                                                                    aria-label="Action" style="width: 39.3906px;">الاعدادت
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($users as $user)
                                                                <tr role="row" class="odd">
                                                                <td class="sorting_1">#{{$user->id}}</td>
                                                                <td class="text-truncate">{{$user->name}}</td>
                                                                <td>{{$user->email}}</td>

                                                                    <td>
                                                                        @if($user->type == 1)
                                                                            ادمن
                                                                        @elseif($user->type == 2)
                                                                        موظف
                                                                        @else
                                                                        عامل مكتب
                                                                        @endif
                                                                    </td>
                                                                <td>{{$user->type == 3 ? $user->floor : '-'}}</td>
                                                                <td>{{$user->phone_number}}</td>
                                                                <td>{{$user->number_of_drinks}}</td>
                                                                <td>{{$user->number_of_drinks_ordered}}</td>
                                                                <td>
                                                                    <a href="{{'user/'.$user->id}}">
                                                                        <i class="fa fa-edit" title="تعديل"> </i>
                                                                    </a>

                                                                    <a href="{{'delete-user/'.$user->id}}" style="margin-right: 7px;" onclick="if(!confirm('متاكد من حذف المستخدم؟')) return false">
                                                                        <i class="fa fa-trash" title="حذف" > </i>
                                                                    </a>

                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row" style="direction: ltr">
                                                    <div class="col-sm-12 col-md-12 m-auto">
                                                        <div class="dataTables_paginate paging_simple_numbers"
                                                             id="users-list-datatable_paginate">
                                                            <ul class="pagination">
                                                                {{ $users->links() }}

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Datatable ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table ends -->
            </section>

        </div>
    </div>

</x-app-layout>
