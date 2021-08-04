<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                                                            <option @if(old('drink_id') == $drink->id) selected @endif value="{{$drink->id}}">{{$drink->name}}</option>
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
                                                    @if($errors->first('num_drinks'))
                                                        <li class='text-red-600'>{{$errors->first('num_drinks')}}</li>
                                                    @endif
                                                    <label for="basic-form-11">العدد(كميه المشروب)*</label>
                                                    <input type="number" min="1" value="{{old('num_drinks')}}" id="basic-form-11" class="form-control" name="num_drinks">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('floor_number'))
                                                        <li class='text-red-600'>{{$errors->first('floor_number')}}</li>
                                                    @endif
                                                    <label for="basic-form-11">الطابق(الدور)*</label>
                                                    <input type="number" value="{{old('floor_number')}}" id="basic-form-11" class="form-control" name="floor_number">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2"><i class="ft-check-square mr-1"></i>طلب</button>
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
