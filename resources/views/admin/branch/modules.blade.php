@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Branch User Module Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Branch User Module Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Modules Listing</a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-between gy-3">
                                <div class="col-lg-3">
                                    <div class="search-box">
                                        <input type="text" class="form-control search"
                                            placeholder="Search for modules...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <div class="col-lg-auto">
                                    <div class="d-md-flex text-nowrap gap-2">
                                        <h6>Branch Name: {{$UserModules->branch->name}}</h6>
                                    </div>
                                    <div class="d-md-flex text-nowrap gap-2">
                                        <h6>User Name: {{$UserModules->name}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">
                
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/oclwxpmm.json" trigger="hover" colors="primary:#405189"
                                target="div" style="width:50px;height:50px"></lord-icon>
<a href="{{ url('main/' . base64_encode($UserModules->id)) }}" class="stretched-link">
                                <h5 class="mt-4">Main</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/dklbhvrt.json" trigger="hover" colors="primary:#405189"
                                target="div" style="width:50px;height:50px"></lord-icon>
                                <a href="{{ url('suppliers/' . base64_encode($UserModules->id)) }}" class="stretched-link">

                                <h5 class="mt-4">supplier </h5>
                            </a>    
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/adwosptt.json" trigger="hover" colors="primary:#405189"
                                target="div" style="width:50px;height:50px"></lord-icon>
                                <a href="{{ url('transactions/' . base64_encode($UserModules->id)) }}" class="stretched-link">

                                <h5 class="mt-4">DailyCrTrx</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/kkcllwsu.json" trigger="hover" colors="primary:#405189"
                                target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="" class="stretched-link">
                                <h5 class="mt-4">Deduction</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/rahcoaeu.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">SInv</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/smauprql.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">DedRep</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/itykargr.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Credit Purchase</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/cnyeuzxc.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Bank</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/sygggnra.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Via Bank</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/hfmdczge.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Pay List</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/xhebrhsj.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Cash Purchase</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/ucvsemjq.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Cash Purchase Summary</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/auvicynv.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Daily CP Summary</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/auvicynv.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">SCB</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/auvicynv.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Analysis 1</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/auvicynv.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Analysis 2</h5>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center py-4">
                            <lord-icon src="https://cdn.lordicon.com/auvicynv.json" trigger="hover"
                                colors="primary:#405189" target="div" style="width:50px;height:50px"></lord-icon>
                            <a href="#!" class="stretched-link">
                                <h5 class="mt-4">Supplier List By coordinates</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('/assets/admin/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-create-edit.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#UsersTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
