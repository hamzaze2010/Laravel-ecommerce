@extends('Admin.adminLayout')
@section('content')

        <!-- ====================================
        ——— CONTENT WRAPPER
        ===================================== -->
        <div class="content-wrapper">
          <div class="content">                
                  <!-- Top Statistics -->
                  <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="card card-default card-mini">
                          <div class="card-header">
                            <h2>Total Admins</h2>
                            <div class="sub-title">
                              <span class="mr-1">{{ $totalAdmins }}</span>
                              <i class="mdi mdi-arrow-up-bold text-success"></i>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="chart-wrapper">
                              <div>
                                <div id="spline-area-1"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-default card-mini">
                        <div class="card-header">
                          <h2>Total Categories</h2>
                          
                          <div class="sub-title">
                            <span class="mr-1">{{ $totalCategorys }}</span>
                            <i class="mdi mdi-arrow-down-bold text-danger"></i>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart-wrapper">
                            <div>
                              <div id="spline-area-2"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-default card-mini">
                        <div class="card-header">
                          <h2>Total Products</h2>
                          
                          <div class="sub-title">
                            <span class="mr-1">{{ $totalProducts }}</span>
                            <i class="mdi mdi-arrow-up-bold text-success"></i>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart-wrapper">
                            <div>
                              <div id="spline-area-3"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                      <div class="card card-default card-mini">
                        <div class="card-header">
                          <h2>Total users</h2>
                          <div class="sub-title">
                            <span class="mr-1">{{ $totalUsers }}</span>
                            <i class="mdi mdi-arrow-up-bold text-success"></i>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart-wrapper">
                            <div>
                              <div id="spline-area-4"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


              </div>
          
          </div>
          <!-- ====================================
          ——— END OF  CONTENT WRAPPER
          ===================================== -->

          <!-- ====================================
          ——— END OF  PAGE WRAPPER
          ===================================== -->
        
          
@endsection      

     
