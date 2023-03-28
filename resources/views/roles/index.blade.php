@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                <div class="content-body">
                    @can('add_roles')   <a style="margin-bottom: 30px" href="{{route('roles.create')}}" class="btn btn-primary">create roles</a>@endcan

                    <div class="row" id="table-striped">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-striped mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th>Role Name</th>
                                                <th scope="col">Edit</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                            @foreach($roles as $role)
                                                <tr>
                                                    <?php $i++; ?>
                                                    <th scope="row">{{$i}}</th>
                                                        <td>{{$role -> name}}</td>


                                                               <td><a href="{{route('roles.edit',$role->id)}}"
                                                           class="btn btn-primary"><i class="fa fa-edit"></i>Edit </a></td>


                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Ecommerce Pagination Starts -->







                    <!-- Ecommerce Pagination Ends -->

                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
    <script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
    <script
        src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script>

        $(document).ready(function(){

            $("#myTable").dataTable({
                "bStateSave": true,
                "fnStateSave": function (oSettings, oData) {
                    localStorage.setItem('dataTable2', JSON.stringify(oData));
                },
                "fnStateLoad": function (oSettings) {
                    return JSON.parse(localStorage.getItem('dataTable2'));
                },
                language: {
                    paginate: {

                        "previous": "السابق",
                        "next": "التالي",

                    },
                    search: 'بحث',
                    info: "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    lengthMenu: "أظهر _MENU_ مدخلات",
                    infoEmpty: "يعرض 0 إلى 0 من أصل 0 مُدخل",
                    loadingRecords: "جارٍ التحميل...",
                    zeroRecords: "لم يعثر على أية سجلات",
                    countFiltered: "عدد المفلتر",
                    emptyTable: "لا يوجد بيانات متاحة في الجدول",
                    infoFiltered: "(مرشحة من مجموع _MAX_ مُدخل)",


                },
            });

        });
    </script>
@endsection
