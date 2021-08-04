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
                <form action="{{route('updateDrink')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="drink_id" value="{{$drink->id}}">
                    <div class="col-lg-6 col-12 m-auto text-right">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">نموذج تعديل مشروب</h4>
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
                                                    <input type="text" value="{{$drink->name}}" id="basic-form-1" class="form-control" name="name">
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
                                                        <textarea name="description" id="basic-form-3" cols="30" rows="5" class="form-control" >{{$drink->description}}</textarea>
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
