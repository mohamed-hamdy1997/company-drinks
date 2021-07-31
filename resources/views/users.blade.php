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
                                                        <table id="users-list-datatable"
                                                               class="table dataTable no-footer" role="grid"
                                                               aria-describedby="users-list-datatable_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="ID: activate to sort column descending"
                                                                    style="width: 41.4219px;">ID
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 185.391px;">Name
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 185.391px;">Email
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">Type
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">Phone Number
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">Available Drinks Number
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Role: activate to sort column ascending"
                                                                    style="width: 48.3281px;">Drinks Ordered Today
                                                                </th>

                                                                <th class="" rowspan="1" colspan="1"
                                                                    aria-label="Action" style="width: 39.3906px;">Action
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($users as $user)
                                                                <tr role="row" class="odd">
                                                                <td class="sorting_1">#{{$user->id}}</td>
                                                                <td class="text-truncate">{{$user->name}}</td>
                                                                <td>{{$user->email}}</td>
                                                                <td>{{$user->type == 1 ? 'Admin' : $user->type == 2 ? 'Employee' : 'Office Boy'}}</td>
                                                                <td>{{$user->phone_number}}</td>
                                                                <td>{{$user->number_of_drinks}}</td>
                                                                <td>{{$user->number_of_drinks_ordered}}</td>
                                                                <td>
                                                                    <a href="{{'user/'.$user->id}}">
                                                                        <i class="fa fa-trash"> edit</i>
                                                                    </a>

                                                                    <a href="page-users-edit.html">
                                                                        <i class="fa fa-trash"> Delete</i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
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
