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
                <form action="{{route('addDrink')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-lg-6 col-12 m-auto text-right">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">نموذج اضافه مشروب جديد</h4>
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
                                                    <input type="text" value="{{old('name')}}" id="basic-form-1" class="form-control" name="name">
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
                                                    @if($errors->first('target'))
                                                        <li class='text-red-600'>{{$errors->first('target')}}</li>
                                                    @endif
                                                    <label for="basic-form-121">متاح الي*</label>
                                                        <select id="basic-form-121" name="target" class="form-control">
                                                            <option value="none" selected="" disabled="">متاح الي*</option>
                                                            <option @if(old('target') == 1) selected @endif value="1">الادمن</option>
                                                            <option @if(old('target') == 2) selected @endif value="2">الموظفين</option>
                                                            <option @if(old('target') == 3) selected @endif value="3">عمال المكتب</option>
                                                            <option @if(old('target') == 4) selected @endif value="4">الادمن/الموظفين</option>
                                                            <option @if(old('target') == 5) selected @endif value="5">الادمن/عمال المكتب</option>
                                                            <option @if(old('target') == 6) selected @endif value="6">الموظفين/عمال المكتب</option>
                                                            <option @if(old('target') == 7) selected @endif value="7">الادمن/الموظفين/عمال المكتب</option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('image_url'))
                                                        <li class='text-red-600'>{{$errors->first('image_url')}}</li>
                                                    @endif
                                                    <label for="basic-form-3">صوره المشروب</label>
                                                        <input type="file" class="form-control" name="image_url" value="{{old('image_url')}}">
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
