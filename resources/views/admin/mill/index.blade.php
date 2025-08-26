@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Mill Management </h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Mill Management</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.mill.management') }}">Mill Listing</a>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Mill Listing</h4>
                     <div class="card-toolbar">
                        <a href="{{ asset('storage/app/public/cash-purchase-pdf/VC_202505 _Cash_Purchase_Summary.pdf') }}" 
                            class="btn btn-primary btn-label waves-effect waves-light"
                            download="VC_202505 _Cash_Purchase_Summary.pdf">
                            <i class="mdi mdi-microsoft-excel label-icon align-middle fs-17 me-2"></i>Sample Excel
                        </a>
                         <button type="button" data-bs-toggle="modal" data-bs-target="#branchModal" class="btn btn-warning btn-label waves-effect waves-ligh">
                            <i class="mdi mdi-cloud-download-outline label-icon align-middle fs-16 me-2"></i> Import Excel
                        </button>
                
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <table id="SupplierListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR.No</th>
                                        <th>Mill_Id</th>
                                        <th>Mill_Name</th>
                                        <th>MPOB_Lic_No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>1.</td>
                                        <td>Atlantica</td>
                                        <td>Atlantica Palm Oil Mill Sdn. Bhd.</td>
                                        <td>500262404000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>2.</td>
                                        <td>Bell</td>
                                        <td>Kilang Sawit Bell Sdn Bhd</td>
                                        <td>500359104000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>3.</td>
                                        <td>FGVPM-Baidur</td>
                                        <td>Felda Global Ventures Plantations</td>
                                        <td>594461015000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>4.</td>
                                        <td>HCahaya</td>
                                        <td>Halus Cahaya Sdn Bhd</td>
                                        <td>543034115000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>5.</td>
                                        <td>HCahaya (Ban)</td>
                                        <td>Halus Cahaya Sdn Bhd</td>
                                        <td>537245015000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>6.</td>
                                        <td>KLK Agri</td>
                                        <td>KLK Agri Oils Sdn Bhd</td>
                                        <td>579635004000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>7.</td>
                                        <td>KSBA</td>
                                        <td>FGV Trading Sdn Bhd</td>
                                        <td>618460015000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>8.</td>
                                        <td>LCH</td>
                                        <td>LCH Palm Oil Mill Sdn. Bhd.</td>
                                        <td>617919104000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>9.</td>
                                        <td>LHassan</td>
                                        <td>Ladang Hassan Palm Oil Mill</td>
                                        <td>508118404000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>10.</td>
                                        <td>LPermai (BPPC)</td>
                                        <td>Ladang Permai Sdn Bhd</td>
                                        <td>500224104000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>11.</td>
                                        <td>LPermai (PPO)</td>
                                        <td>Ladang Permai Sdn Bhd</td>
                                        <td>500115604000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>12.</td>
                                        <td>Prolific</td>
                                        <td>Prolific Yield Palm Oil Mill</td>
                                        <td>500256004000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>13.</td>
                                        <td>TEOPP</td>
                                        <td>Tanah Emas Oil Palm Processing Sdn. Bhd.</td>
                                        <td>500282904000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>14.</td>
                                        <td>THP</td>
                                        <td>THP Sabaco Sdn. Bhd.</td>
                                        <td>509162704000</td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- <table id="SupplierListing" class="table nowrap dt-responsive align-middle" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th>SR No.</th>
                                        <th>Supplier Code</th>
                                        <th>Supplier Type(A/B)</th>
                                        <th>Supplier Name</th>
                                        <th>Telephone Number</th>
                                        <th>Email</th>
                                        <th>MPOB License No</th>
                                        <th>MSPO Cert. No</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>3.</td>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>1</td>
                                        <td>VC-A-001</td>
                                        <td>A</td>
                                        <td>Green Palm Suppliers</td>
                                        <td>+60 12-3456789</td>
                                        <td>greenpalm@example.com</td>
                                        <td>MPOB-1001</td>
                                        <td>MSPO-5001</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                    <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>2</td>
                                        <td>VC-B-002</td>
                                        <td>B</td>
                                        <td>Sunrise Agro</td>
                                        <td>+60 11-2233445</td>
                                        <td>sunriseagro@example.com</td>
                                        <td>MPOB-1002</td>
                                        <td>MSPO-5002</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>3</td>
                                        <td>VC-A-003</td>
                                        <td>A</td>
                                        <td>Tropical Oils Sdn Bhd</td>
                                        <td>+60 16-3344556</td>
                                        <td>tropoils@example.com</td>
                                        <td>MPOB-1003</td>
                                        <td>MSPO-5003</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>4</td>
                                        <td>VC-B-004</td>
                                        <td>B</td>
                                        <td>Harvest Traders</td>
                                        <td>+60 19-4455667</td>
                                        <td>harvesttraders@example.com</td>
                                        <td>MPOB-1004</td>
                                        <td>MSPO-5004</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>5</td>
                                        <td>VC-A-005</td>
                                        <td>A</td>
                                        <td>Evergreen Supplies</td>
                                        <td>+60 13-5566778</td>
                                        <td>evergreen@example.com</td>
                                        <td>MPOB-1005</td>
                                        <td>MSPO-5005</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>6</td>
                                        <td>VC-B-006</td>
                                        <td>B</td>
                                        <td>AgroFresh Malaysia</td>
                                        <td>+60 18-6677889</td>
                                        <td>agrofresh@example.com</td>
                                        <td>MPOB-1006</td>
                                        <td>MSPO-5006</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>7</td>
                                        <td>VC-A-007</td>
                                        <td>A</td>
                                        <td>Golden Palm Oils</td>
                                        <td>+60 14-7788990</td>
                                        <td>goldenpalm@example.com</td>
                                        <td>MPOB-1007</td>
                                        <td>MSPO-5007</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>8</td>
                                        <td>VC-B-008</td>
                                        <td>B</td>
                                        <td>Prime Agro Products</td>
                                        <td>+60 10-8899001</td>
                                        <td>primeagro@example.com</td>
                                        <td>MPOB-1008</td>
                                        <td>MSPO-5008</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>9</td>
                                        <td>VC-A-009</td>
                                        <td>A</td>
                                        <td>NatureLink Oils</td>
                                        <td>+60 17-9911223</td>
                                        <td>naturelink@example.com</td>
                                        <td>MPOB-1009</td>
                                        <td>MSPO-5009</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>10</td>
                                        <td>VC-B-010</td>
                                        <td>B</td>
                                        <td>Agro Alliance</td>
                                        <td>+60 11-2233112</td>
                                        <td>agroalliance@example.com</td>
                                        <td>MPOB-1010</td>
                                        <td>MSPO-5010</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>11</td>
                                        <td>VC-A-011</td>
                                        <td>A</td>
                                        <td>EcoPalm Resources</td>
                                        <td>+60 12-3344556</td>
                                        <td>ecopalm@example.com</td>
                                        <td>MPOB-1011</td>
                                        <td>MSPO-5011</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>12</td>
                                        <td>VC-B-012</td>
                                        <td>B</td>
                                        <td>FreshHarvest Oils</td>
                                        <td>+60 13-4455667</td>
                                        <td>freshharvest@example.com</td>
                                        <td>MPOB-1012</td>
                                        <td>MSPO-5012</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>13</td>
                                        <td>VC-A-013</td>
                                        <td>A</td>
                                        <td>Unity Agro</td>
                                        <td>+60 15-5566778</td>
                                        <td>unityagro@example.com</td>
                                        <td>MPOB-1013</td>
                                        <td>MSPO-5013</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>14</td>
                                        <td>VC-B-014</td>
                                        <td>B</td>
                                        <td>BioPalm Trading</td>
                                        <td>+60 19-6677889</td>
                                        <td>biopalm@example.com</td>
                                        <td>MPOB-1014</td>
                                        <td>MSPO-5014</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>15</td>
                                        <td>VC-A-015</td>
                                        <td>A</td>
                                        <td>AgriWorld Sdn Bhd</td>
                                        <td>+60 16-7788990</td>
                                        <td>agriworld@example.com</td>
                                        <td>MPOB-1015</td>
                                        <td>MSPO-5015</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>16</td>
                                        <td>VC-B-016</td>
                                        <td>B</td>
                                        <td>PalmRich Supplies</td>
                                        <td>+60 18-8899001</td>
                                        <td>palmrich@example.com</td>
                                        <td>MPOB-1016</td>
                                        <td>MSPO-5016</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>17</td>
                                        <td>VC-A-017</td>
                                        <td>A</td>
                                        <td>FarmLink Oils</td>
                                        <td>+60 14-9911223</td>
                                        <td>farmlink@example.com</td>
                                        <td>MPOB-1017</td>
                                        <td>MSPO-5017</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>18</td>
                                        <td>VC-B-018</td>
                                        <td>B</td>
                                        <td>Vista Agro</td>
                                        <td>+60 17-2233445</td>
                                        <td>vistaagro@example.com</td>
                                        <td>MPOB-1018</td>
                                        <td>MSPO-5018</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>19</td>
                                        <td>VC-A-019</td>
                                        <td>A</td>
                                        <td>AgroLink Resources</td>
                                        <td>+60 12-3344667</td>
                                        <td>agrolink@example.com</td>
                                        <td>MPOB-1019</td>
                                        <td>MSPO-5019</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check"><input class="form-check-input fs-15" type="checkbox">
                                            </div>
                                        </td>
                                        <td>20</td>
                                        <td>VC-B-020</td>
                                        <td>B</td>
                                        <td>Harvest Palm Oils</td>
                                        <td>+60 13-4455778</td>
                                        <td>harvestpalm@example.com</td>
                                        <td>MPOB-1020</td>
                                        <td>MSPO-5020</td>
                                        <td>
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">

                                                   <li><a class="dropdown-item edit-item-btn" href="{{ route('admin.suppliers.edit') }}">
                                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table> --}}

                        </div><!--end row-->
                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/assets/admin/js/common.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#SupplierListing').DataTable({
                paging: true,
                searching: true,
                ordering: true

            });
        });
    </script>
@endsection
