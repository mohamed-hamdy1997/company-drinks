<x-app-layout>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
{{--                <x-jet-welcome />--}}
{{--                =========================--}}
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- Datatable starts -->
                                    <div class="table-responsive" style="overflow-x: visible;">
                                        <div id="users-list-datatable_wrapper"
                                             class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <h5>الحد الاقصي للمشاريب اليومي: {{ $number_of_drinks }}
                                                <span style="margin-right: 26px; margin-left: 26px;">|</span>
                                                عدد المشاريب التي تم طلبها اليوم: {{ $number_of_drinks_ordered }}

                                            </h5>
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
                                                                style="width: 185.391px;">اسم المشروب
                                                            </th>
                                                            <th class="" tabindex="0"
                                                                aria-controls="users-list-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Name: activate to sort column ascending"
                                                                style="width: 185.391px;">التوقيت
                                                            </th>

                                                            <th class="" tabindex="0"
                                                                aria-controls="users-list-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Name: activate to sort column ascending"
                                                                style="width: 185.391px;">التفاصيل
                                                            </th>
                                                            <th class="" tabindex="0"
                                                                aria-controls="users-list-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="ID: activate to sort column descending"
                                                                style="width: 41.4219px;">العدد
                                                            </th>
                                                            <th class="" tabindex="0"
                                                                aria-controls="users-list-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="ID: activate to sort column descending"
                                                                style="width: 41.4219px;">الدور
                                                            </th>
                                                            <th class="" tabindex="0"
                                                                aria-controls="users-list-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Name: activate to sort column ascending"
                                                                style="width: 185.391px;">حاله الطلب
                                                            </th>
                                                            <th class="" tabindex="0"
                                                                aria-controls="users-list-datatable" rowspan="1"
                                                                colspan="1"
                                                                aria-label="Name: activate to sort column ascending"
                                                                style="width: 185.391px;">صانع المشروب
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        @foreach($drinksOrdered as $drinkOrdered)
                                                            <tr role="row" class="odd">
                                                                <td class="sorting_1">#{{$drinkOrdered->id}}</td>
                                                                <td class="text-truncate">{{$drinkOrdered->drink_name}}</td>
                                                                <td>{{$drinkOrdered->created_at}}</td>
                                                                <td>{{$drinkOrdered->hint}}</td>
                                                                <td>{{$drinkOrdered->num_drinks}}</td>
                                                                <td>{{$drinkOrdered->floor_number}}</td>
                                                                <td>
                                                                @if($drinkOrdered->status == \App\Enums\DrinkStatus::ORDERED)
                                                                    تحت الطلب
                                                                    @elseif($drinkOrdered->status == \App\Enums\DrinkStatus::IN_PROGRESS)
                                                                    يتم التحضير
                                                                    @else
                                                                    تم التحضير
                                                                    @endif
                                                                </td>
                                                                <td>{{$drinkOrdered->maker_id ? $drinkOrdered->maker->name : 'لم يتم البدء'}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
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
{{--                ======================================--}}

            </div>
        </div>
    </div>
</x-app-layout>
