<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
{{--                <x-jet-welcome />--}}
                @include('flash-message')
                <form action="{{route('updateUser')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="col-lg-6 col-12 m-auto text-right">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">نموذج تعديل بيانات مستخدم</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('name'))
                                                        <li class='text-red-600'>{{$errors->first('name')}}</li>
                                                    @endif
                                                    <label for="basic-form-1">الاسم*</label>
                                                    <input type="text" value="{{$user->name}}" id="basic-form-1" class="form-control" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('email'))
                                                        <li class='text-red-600'>{{$errors->first('email')}}</li>
                                                    @endif
                                                    <label for="basic-form-3">البريد الالكتروني*</label>
                                                    <input type="text" value="{{$user->email}}" id="basic-form-3" class="form-control" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('phone_number'))
                                                        <li class='text-red-600'>{{$errors->first('phone_number')}}</li>
                                                    @endif
                                                    <label for="basic-form-4">رقم الموبايل</label>
                                                    <input type="number" value="{{$user->phone_number}}" id="basic-form-4" class="form-control" name="phone_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('type'))
                                                        <li class='text-red-600'>{{$errors->first('type')}}</li>
                                                    @endif
                                                    <label for="basic-form-6">الوظيفه*</label>
                                                    <select onchange="changeRole()" id="basic-form-6" name="type" class="form-control">
                                                        <option value="none" selected="" disabled="">الوظيفه*</option>
                                                        <option @if($user->type == 1) selected @endif value="1">ادمن</option>
                                                        <option @if($user->type == 2) selected @endif value="2">موظف</option>
                                                        <option @if($user->type == 3) selected @endif value="3">عامل مكتب</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row" id="floorId" style="@if($user->type != 3) display: none @endif">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('floor'))
                                                        <li class='text-red-600'>{{$errors->first('floor')}}</li>
                                                    @endif
                                                    <label for="basic-form-10">الطابق(الدور)*</label>
                                                        <input type="number" value="{{$user->floor}}" id="basic-form-10" class="form-control" name="floor">

                                                </div>
                                            </div>
                                        </div>

                                            <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('number_of_drinks'))
                                                        <li class='text-red-600'>{{$errors->first('number_of_drinks')}}</li>
                                                    @endif
                                                    <label for="basic-form-7">عدد المشاريب المتاحه في اليوم</label>
                                                    <input type="number" value="{{$user->number_of_drinks}}" id="basic-form-7" class="form-control" name="number_of_drinks">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2"><i class="ft-check-square mr-1"></i>تعديل</button>
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

<script>
    function changeRole() {
        if (document.getElementById("basic-form-6").value == 3)
        {
            document.getElementById("floorId").style.display = 'block';
        } else {
            document.getElementById("floorId").style.display = 'none';
        }
    }
</script>
