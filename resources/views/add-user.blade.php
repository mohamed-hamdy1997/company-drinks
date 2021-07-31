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
                <form action="{{route('addUser')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-lg-6 col-12 m-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add User Form</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
{{--                                    <p>This is the most basic and default form having inputs, labels and buttons.</p>--}}
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('name'))
                                                        <li class='text-red-600'>{{$errors->first('name')}}</li>
                                                    @endif
                                                    <label for="basic-form-1">Name*</label>
                                                    <input type="text" value="{{old('name')}}" id="basic-form-1" class="form-control" name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('email'))
                                                        <li class='text-red-600'>{{$errors->first('email')}}</li>
                                                    @endif
                                                    <label for="basic-form-3">E-mail*</label>
                                                    <input type="text" value="{{old('email')}}" id="basic-form-3" class="form-control" name="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('phone_number'))
                                                        <li class='text-red-600'>{{$errors->first('phone_number')}}</li>
                                                    @endif
                                                    <label for="basic-form-4">Phone Number</label>
                                                    <input type="number" value="{{old('phone_number')}}" id="basic-form-4" class="form-control" name="phone_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('type'))
                                                        <li class='text-red-600'>{{$errors->first('type')}}</li>
                                                    @endif
                                                    <label for="basic-form-6">Type*</label>
                                                    <select id="basic-form-6" name="type" class="form-control">
                                                        <option value="none" selected="" disabled="">User Type*</option>
                                                        <option @if(old('type') == 1) selected @endif value="1">Admin</option>
                                                        <option @if(old('type') == 2) selected @endif value="2">Employee</option>
                                                        <option @if(old('type') == 3) selected @endif value="3">Office boy</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                            <div class="form-row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group mb-2">
                                                    @if($errors->first('number_of_drinks'))
                                                        <li class='text-red-600'>{{$errors->first('number_of_drinks')}}</li>
                                                    @endif
                                                    <label for="basic-form-7">Number of drinks in day</label>
                                                    <input type="number" value="{{old('number_of_drinks')}}" id="basic-form-7" class="form-control" name="number_of_drinks">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2"><i class="ft-check-square mr-1"></i>Save</button>
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
