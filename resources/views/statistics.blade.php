<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @include('flash-message')
                <form action="{{route('orderDrink')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="col-lg-6 col-12 m-auto text-right">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">احصائيات</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <!-- Datatable starts -->
                                                        <div class="table-responsive" style="overflow-x: visible;">
                                                            <div id="users-list-datatable_wrapper" style="overflow-x: hidden !important;"
                                                                 class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <table id="users-list-datatable" class="table dataTable no-footer" role="grid" aria-describedby="users-list-datatable_info">
                                                                            <tbody>
                                                                                <tr role="row" class="odd">
                                                                                    <td class="sorting_1">عدد الادمن:</td>
                                                                                    <td>{{$numAdmins}}</td>
                                                                                </tr>

                                                                                <tr role="row" class="odd">
                                                                                    <td class="sorting_1">عدد الموظفين:</td>
                                                                                    <td>{{$numEmployee}}</td>
                                                                                </tr>

                                                                                <tr role="row" class="odd">
                                                                                    <td class="sorting_1">عدد عمال المكتب:</td>
                                                                                    <td>{{$numOfficeboy}}</td>
                                                                                </tr>

                                                                                <tr role="row" class="odd">
                                                                                    <td class="sorting_1">عدد المشاريب المتاحه:</td>
                                                                                    <td>{{$numDrinks}}</td>
                                                                                </tr>

                                                                                <tr role="row" class="odd">
                                                                                    <td class="sorting_1">عدد المشاريب اليوم:</td>
                                                                                    <td>{{$numDrinksToday}}</td>
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
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
