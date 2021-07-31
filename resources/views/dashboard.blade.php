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
                                                                <td>
                                                                @if($drinkOrdered->status == \App\Enums\DrinkStatus::ORDERED)
                                                                    تحت الطلب
                                                                    @elseif($drinkOrdered->status == \App\Enums\DrinkStatus::IN_PROGRESS)
                                                                    يتم التحضير
                                                                    @else
                                                                    تم التحضير
                                                                    @endif
                                                                </td>
{{--                                                                {{dd($drinkOrdered)}}--}}
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
                @include('flash-message')
                <form action="{{route('orderDrink')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-lg-6 col-12 m-auto text-right">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">طلب مشروب جديد</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('drink_id'))
                                                        <li class='text-red-600'>{{$errors->first('drink_id')}}</li>
                                                    @endif
                                                        <label for="drinkName">اسم المشروب*</label>
                                                        <select id="drinkName" name="drink_id" class="form-control">
                                                            <option value="none" selected="" disabled="">اسم المشروب*</option>
                                                            @foreach($drinks as $drink)
                                                            <option value="{{$drink->id}}">{{$drink->name}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('description'))
                                                        <li class='text-red-600'>{{$errors->first('description')}}</li>
                                                    @endif
                                                    <label for="basic-form-3">التفاصيل</label>
                                                        <textarea name="description" id="basic-form-3" cols="30" rows="5" class="form-control" >{{old('description')}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('floor'))
                                                        <li class='text-red-600'>{{$errors->first('floor_number')}}</li>
                                                    @endif
                                                    <label for="basic-form-11">الطابق(الدور)*</label>
                                                        <input type="number" value="{{old('floor_number')}}" id="basic-form-11" class="form-control" name="floor_number">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2"><i class="ft-check-square mr-1"></i>حفظ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
