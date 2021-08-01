<x-app-layout>
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
                                        <h5>الطابق(الدور): {{app(\App\Http\Controllers\UserController::class)->convertNumbersToArabic(auth()->user()->floor)}}</h5>
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
                                                                    style="width: 70.4219px;">المسلسل
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 200px;">اسم المشروب
                                                                </th>
                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 200.391px;">ملاحظات
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 200.391px;">تم الطلب في التوقيت
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 50.391px;">الطابق(الدور)
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 185.391px;">صاحب المشروب
                                                                </th>

                                                                <th class="" tabindex="0"
                                                                    aria-controls="users-list-datatable" rowspan="1"
                                                                    colspan="1"
                                                                    aria-label="Name: activate to sort column ascending"
                                                                    style="width: 185.391px;">رقم التليفون
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
                                                                    style="width: 185.391px;">الصانع
                                                                </th>

                                                                <th class="" rowspan="1" colspan="1"
                                                                    aria-label="Action" style="width: 39.3906px;">
                                                                    الاعدادات
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($drinks as $key => $drink)
                                                                <tr role="row" class="odd">
                                                                <td class="sorting_1"># {{app(\App\Http\Controllers\UserController::class)->convertNumbersToArabic($key +1)}}</td>
                                                                <td class="text-truncate">{{$drink->drink_name}}</td>
                                                                <td>{{$drink->hint}}</td>
                                                                <td>{{app(\App\Http\Controllers\UserController::class)->convertNumbersToArabic($drink->created_at->format('g:i'))}}
                                                                    @if ($drink->created_at->format('A') == 'PM')
                                                                        م
                                                                    @else
                                                                    ص
                                                                    @endif
                                                                </td>
                                                                <td>{{$drink->floor_number}}</td>
                                                                <td>{{$drink->user->name}}</td>
                                                                <td>{{$drink->user->phone_number}}</td>
                                                                    <td>
                                                                        @if($drink->status == \App\Enums\DrinkStatus::ORDERED)
                                                                            تحت الطلب
                                                                        @else
                                                                            تم التحضير
                                                                        @endif
                                                                    </td>
                                                                <td>{{$drink->maker ? $drink->maker->name : 'لم يتم التحضير'}}</td>
                                                                <td>
                                                                    @if($drink->status != \App\Enums\DrinkStatus::COMPLETED)
                                                                    <a href="{{'complete-order/'.$drink->id}}">
                                                                        <button class="btn btn-primary btn-sm" style="width: max-content;">
                                                                            <i class="fa fa-edit" title="تعديل"> </i>
                                                                            اكتمال المشروب</button></a>
                                                                    @endif
                                                                </td>
                                                            </td>
                                                            @endforeach
                                                            @if(!count($drinks))
                                                                <h5 style="text-align: center; margin: auto">لايوجد مشاريب.</h5>
                                                            @endif
                                                                </tr>
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
                </div>
                <!-- Table ends -->
            </section>

        </div>
    </div>

</x-app-layout>
