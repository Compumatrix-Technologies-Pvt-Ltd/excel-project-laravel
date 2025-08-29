@extends('layouts.admin.master')
@section('title')
    {{ $moduleAction }}
@endsection
@section('toolbar')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Consolidated FFB</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active"><a href="">Consolidated FFB</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.creditPurchase.index') }}">Purchase &
                                Salse</a>
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
                <div class="card-header align-items-center d-flex justify-content-between">
                    <h4 class="card-title mb-0 flex-grow-1">Purchase & Salse Difference</h4>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <h5 class="card-title mb-2 text-dark flex-grow-1">For year 2024</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-end align-middle">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-start">Month</th>
                                        <th colspan="4" class="text-center">SM</th>
                                        <th colspan="4" class="text-center">SP</th>
                                        <th colspan="4" class="text-center">VC</th>
                                    </tr>
                                    <tr>
                                        <th>Total Purchases (MT)</th>
                                        <th>Sale to LKS (MT)</th>
                                        <th>Difference</th>
                                        <th></th>

                                        <th>Total Purchases (MT)</th>
                                        <th>Sale to LKS (MT)</th>
                                        <th>Difference</th>
                                        <th></th>

                                        <th>Total Purchases (MT)</th>
                                        <th>Sale to LKS (MT)</th>
                                        <th>Difference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start">Jan'24</td>
                                        <td>715.59</td>
                                        <td>722.06</td>
                                        <td>-6.47</td>
                                        <td></td>
                                        <td>508.63</td>
                                        <td>508.00</td>
                                        <td>0.63</td>
                                        <td></td>
                                        <td>333.43</td>
                                        <td>332.04</td>
                                        <td>1.39</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Feb'24</td>
                                        <td>563.07</td>
                                        <td>564.96</td>
                                        <td>-1.89</td>
                                        <td></td>
                                        <td>351.56</td>
                                        <td>351.15</td>
                                        <td>0.41</td>
                                        <td></td>
                                        <td>251.08</td>
                                        <td>249.97</td>
                                        <td>1.11</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Mar'24</td>
                                        <td>707.43</td>
                                        <td>702.64</td>
                                        <td>4.79</td>
                                        <td></td>
                                        <td>514.09</td>
                                        <td>513.41</td>
                                        <td>0.68</td>
                                        <td></td>
                                        <td>333.75</td>
                                        <td>332.63</td>
                                        <td>1.12</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Apr'24</td>
                                        <td>810.24</td>
                                        <td>809.95</td>
                                        <td>0.29</td>
                                        <td></td>
                                        <td>790.75</td>
                                        <td>790.14</td>
                                        <td>0.61</td>
                                        <td></td>
                                        <td>436.64</td>
                                        <td>434.41</td>
                                        <td>2.23</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">May'24</td>
                                        <td>726.35</td>
                                        <td>727.19</td>
                                        <td>(0.84)</td>
                                        <td></td>
                                        <td>708.30</td>
                                        <td>711.22</td>
                                        <td>(2.92)</td>
                                        <td></td>
                                        <td>431.36</td>
                                        <td>429.26</td>
                                        <td>2.10</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Jun'24</td>
                                        <td>772.77</td>
                                        <td>779.44</td>
                                        <td>(6.67)</td>
                                        <td></td>
                                        <td>597.92</td>
                                        <td>597.24</td>
                                        <td>0.68</td>
                                        <td></td>
                                        <td>383.79</td>
                                        <td>382.45</td>
                                        <td>1.34</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Jul'24</td>
                                        <td>728.51</td>
                                        <td>729.95</td>
                                        <td>(1.44)</td>
                                        <td></td>
                                        <td>701.63</td>
                                        <td>700.92</td>
                                        <td>0.71</td>
                                        <td></td>
                                        <td>414.67</td>
                                        <td>412.38</td>
                                        <td>2.29</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Aug'24</td>
                                        <td>736.02</td>
                                        <td>737.76</td>
                                        <td>(1.74)</td>
                                        <td></td>
                                        <td>725.28</td>
                                        <td>724.51</td>
                                        <td>0.77</td>
                                        <td></td>
                                        <td>450.51</td>
                                        <td>448.93</td>
                                        <td>1.58</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Sep'24</td>
                                        <td>739.24</td>
                                        <td>741.64</td>
                                        <td>(2.40)</td>
                                        <td></td>
                                        <td>818.06</td>
                                        <td>817.16</td>
                                        <td>0.90</td>
                                        <td></td>
                                        <td>500.75</td>
                                        <td>497.79</td>
                                        <td>2.96</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Oct'24</td>
                                        <td>656.86</td>
                                        <td>659.23</td>
                                        <td>(2.37)</td>
                                        <td></td>
                                        <td>997.06</td>
                                        <td>996.34</td>
                                        <td>0.72</td>
                                        <td></td>
                                        <td>559.47</td>
                                        <td>556.96</td>
                                        <td>2.51</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Nov'24</td>
                                        <td>538.64</td>
                                        <td>544.52</td>
                                        <td>(5.88)</td>
                                        <td></td>
                                        <td>1,100.49</td>
                                        <td>1,099.27</td>
                                        <td>1.22</td>
                                        <td></td>
                                        <td>438.23</td>
                                        <td>436.32</td>
                                        <td>1.91</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Dec'24</td>
                                        <td>527.61</td>
                                        <td>531.13</td>
                                        <td>(3.52)</td>
                                        <td></td>
                                        <td>819.92</td>
                                        <td>818.37</td>
                                        <td>1.55</td>
                                        <td></td>
                                        <td>350.88</td>
                                        <td>349.40</td>
                                        <td>1.48</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-start fw-bold">Total</td>
                                        <td>8,222.33</td>
                                        <td>8,250.47</td>
                                        <td>(28.14)</td>
                                        <td></td>
                                        <td>8,633.69</td>
                                        <td>8,627.73</td>
                                        <td>5.96</td>
                                        <td></td>
                                        <td>4,884.56</td>
                                        <td>4,862.54</td>
                                        <td>22.02</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <h5 class="card-title mb-2 text-dark flex-grow-1 mt-5">For year 2025</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm text-end align-middle">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-start">Month</th>
                                        <th colspan="4" class="text-center">SM</th>
                                        <th colspan="4" class="text-center">SP</th>
                                        <th colspan="4" class="text-center">VC</th>
                                    </tr>
                                    <tr>
                                        <th>Total Purchases (MT)</th>
                                        <th>Sale to LKS (MT)</th>
                                        <th>Difference</th>
                                        <th></th>

                                        <th>Total Purchases (MT)</th>
                                        <th>Sale to LKS (MT)</th>
                                        <th>Difference</th>
                                        <th></th>

                                        <th>Total Purchases (MT)</th>
                                        <th>Sale to LKS (MT)</th>
                                        <th>Difference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start">Jan'25</td>
                                        <td>715.00</td>
                                        <td>720.00</td>
                                        <td>(5.00)</td>
                                        <td></td>
                                        <td>510.00</td>
                                        <td>508.00</td>
                                        <td>2.00</td>
                                        <td></td>
                                        <td>335.00</td>
                                        <td>332.00</td>
                                        <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Feb'25</td>
                                        <td>560.00</td>
                                        <td>565.00</td>
                                        <td>(5.00)</td>
                                        <td></td>
                                        <td>352.00</td>
                                        <td>351.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>250.00</td>
                                        <td>249.00</td>
                                        <td>1.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Mar'25</td>
                                        <td>705.00</td>
                                        <td>700.00</td>
                                        <td>5.00</td>
                                        <td></td>
                                        <td>515.00</td>
                                        <td>513.00</td>
                                        <td>2.00</td>
                                        <td></td>
                                        <td>334.00</td>
                                        <td>332.00</td>
                                        <td>2.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Apr'25</td>
                                        <td>810.00</td>
                                        <td>810.00</td>
                                        <td>0.00</td>
                                        <td></td>
                                        <td>791.00</td>
                                        <td>790.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>437.00</td>
                                        <td>434.00</td>
                                        <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">May'25</td>
                                        <td>725.00</td>
                                        <td>728.00</td>
                                        <td>(3.00)</td>
                                        <td></td>
                                        <td>708.00</td>
                                        <td>711.00</td>
                                        <td>(3.00)</td>
                                        <td></td>
                                        <td>432.00</td>
                                        <td>429.00</td>
                                        <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Jun'25</td>
                                        <td>773.00</td>
                                        <td>779.00</td>
                                        <td>(6.00)</td>
                                        <td></td>
                                        <td>598.00</td>
                                        <td>597.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>384.00</td>
                                        <td>382.00</td>
                                        <td>2.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Jul'25</td>
                                        <td>729.00</td>
                                        <td>730.00</td>
                                        <td>(1.00)</td>
                                        <td></td>
                                        <td>702.00</td>
                                        <td>701.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>415.00</td>
                                        <td>412.00</td>
                                        <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Aug'25</td>
                                        <td>736.00</td>
                                        <td>738.00</td>
                                        <td>(2.00)</td>
                                        <td></td>
                                        <td>725.00</td>
                                        <td>724.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>451.00</td>
                                        <td>449.00</td>
                                        <td>2.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Sep'25</td>
                                        <td>739.00</td>
                                        <td>742.00</td>
                                        <td>(3.00)</td>
                                        <td></td>
                                        <td>818.00</td>
                                        <td>817.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>501.00</td>
                                        <td>498.00</td>
                                        <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Oct'25</td>
                                        <td>657.00</td>
                                        <td>659.00</td>
                                        <td>(2.00)</td>
                                        <td></td>
                                        <td>997.00</td>
                                        <td>996.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>560.00</td>
                                        <td>557.00</td>
                                        <td>3.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Nov'25</td>
                                        <td>539.00</td>
                                        <td>545.00</td>
                                        <td>(6.00)</td>
                                        <td></td>
                                        <td>1,100.00</td>
                                        <td>1,099.00</td>
                                        <td>1.00</td>
                                        <td></td>
                                        <td>438.00</td>
                                        <td>436.00</td>
                                        <td>2.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start">Dec'25</td>
                                        <td>528.00</td>
                                        <td>531.00</td>
                                        <td>(3.00)</td>
                                        <td></td>
                                        <td>820.00</td>
                                        <td>818.00</td>
                                        <td>2.00</td>
                                        <td></td>
                                        <td>351.00</td>
                                        <td>349.00</td>
                                        <td>2.00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-start fw-bold">Total</td>
                                        <td>8,516.00</td>
                                        <td>8,537.00</td>
                                        <td>(21.00)</td>
                                        <td></td>
                                        <td>8,836.00</td>
                                        <td>8,825.00</td>
                                        <td>11.00</td>
                                        <td></td>
                                        <td>4,888.00</td>
                                        <td>4,821.00</td>
                                        <td>67.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--end col-->
    </div>

@endsection



@section('scripts')
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('/assets/admin/plugins/custom/datatables/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common-index/index.js') }}"></script>
    <script type="text/javascript" src="{{asset('/assets/admin/js/common.js') }}"></script>

@endsection