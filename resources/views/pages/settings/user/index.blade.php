@extends('layouts.master')

@section('users.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Users List
@endsection

@section('breadcrumb_navigation_path')
    @include('partials.breadcrumb-navigation', [
        'breadcrumbs'=>[
            ['name'=> 'User Management', 'url' => 'users.index'],
        ]
    ])
@endsection

@section('page_css')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('page_content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">@include('components.svg.search_icon')</span>

                    <input id="searchInput" type="text" data-kt-user-table-filter="search"
                           class="form-control form-control-solid w-250px ps-14" placeholder="Search user"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <a href="{{route('users.create')}}" class="btn btn-info hover-scale">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                        <span class="svg-icon svg-icon-2">
                             <i class="fa-solid fa-plus fs-2"></i>
                        </span>
                        <!--end::Svg Icon-->
                        Add User
                    </a>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Phone</th>
                    <th class="min-w-125px">Status</th>
                    <th class="min-w-125px">Role</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                @foreach($users as $user)
                    <!--begin::Table row-->
                    <tr>
                        <!--begin::User=-->
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            {{--<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">--}}
                            {{--    <div class="symbol-label">--}}
                            {{--        <img src="assets/media/avatars/300-6.jpg" alt="Emma Smith" class="w-100"/>--}}
                            {{--    </div>--}}
                            {{--</div>--}}
                            <!--end::Avatar-->
                            <!--begin::User details-->

                            <div class="d-flex flex-column">
                                <span class="text-gray-800 text-hover-primary mb-1">{{$user->name}}</span>
                                <span>{{$user->email}}</span>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <!--end::User-->

                        <!--begin::Phone=-->
                        <td>
                            {{$user->phone}}
                        </td>
                        <!--end::Phone=-->

                        <!--begin::Status=-->
                        <td>
                            <span style="display: none">{{$user->status}}</span>
                            @if( $user->status==1)
                                <i class="fa-solid fa-circle-check text-success fs-2"></i>
                            @else
                                <i class="fa-solid fa-circle-xmark text-danger fs-2"></i>
                            @endif
                        </td>
                        <!--end::Status-->

                        <!--begin::Role-->
                        <td>
                            @if(count($user->roles)>0)
                                <span class="badge badge-light-info ">{{$user->roles[0]->name}}</span>
                            @endif
                        </td>
                        <!--end::Role-->

                        <!--begin::Action=-->
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-info btn-sm"
                               data-kt-menu-trigger="click"
                               data-kt-menu-placement="bottom-end">
                                Actions
                                <span class="svg-icon svg-icon-5 m-0">@include('components.svg.arrow_down')</span>
                            </a>
                            <!--begin::Menu-->
                            <div
                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary  fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{route('users.edit', $user->id)}}" class="menu-link px-3">
                                        <i class="fa-regular fa-pen-to-square me-2"></i> Edit
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{route('users.show', $user->id)}}" class="menu-link px-3">
                                        <i class="fa-solid fa-eye me-2"></i> View
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                        <!--end::Action=-->
                    </tr>
                    <!--end::Table row-->
                @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
@endsection


@section('page_scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->

    <script>
        const table = $('#kt_table').DataTable();

        // #searchInput is a <input type="text"> element
        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });
    </script>
@endsection
