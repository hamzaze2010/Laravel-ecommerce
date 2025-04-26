<!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="<?php echo e(asset('Adminindex')); ?>">
                <img src="<?php echo e(asset('admin/images/logo.png')); ?>" alt="Mono">
                <span class="brand-name">SHOP</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-left" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                

                
                  <li
                   
                   >
                    <a class="sidenav-item-link" href="<?php echo e(route('adminManage')); ?>">
                      <i class="mdi mdi-briefcase-account-outline"></i>
                      <span class="nav-text">Manage Admins</span>
                    </a>
                  </li>
                

                

                
                  <li
                   >
                    <a class="sidenav-item-link" href="<?php echo e(route('categoryManage')); ?>">
                      <i class="mdi mdi-chart-line"></i>
                      <span class="nav-text">Manage Category</span>
                    </a>
                  </li>
                 <li
                   >
                    <a class="sidenav-item-link" href="<?php echo e(route('productManage')); ?>">
                      <i class="mdi mdi-wechat"></i>
                      <span class="nav-text">Manage Product</span>
                    </a>
                  </li>

                  <li
                   >
                    <a class="sidenav-item-link" href="<?php echo e(route('userManage')); ?>">
                      <i class="mdi mdi-account-group"></i>
                      <span class="nav-text">User Management</span>
                    </a>
                  </li>
              


                
                  <li>
                  <a class="sidenav-item-link" href="<?php echo e(route('admin.order.manage')); ?>">
                      <i class="mdi mdi-email"></i>
                      <span class="nav-text">Order Management</span> 
                    </a>
                  </li>


                  <li
                   >
                    <a class="sidenav-item-link" href="calendar.html">
                      <i class="mdi mdi-calendar-check"></i>
                      <span class="nav-text">Manage Category</span>
                    </a>
                  </li>
                

                

                
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#users"
                      aria-expanded="false" aria-controls="users">
                      <i class="mdi mdi-image-filter-none"></i>
                      <span class="nav-text">User Management</span> 
                    </a>
                    <ul  class="collapse"  id="users"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                      </div>
                    </ul>
                  </li>
                

                

                
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#authentication"
                      aria-expanded="false" aria-controls="authentication">
                      <i class="mdi mdi-account"></i>
                      <span class="nav-text">User Management</span> 
                    </a>
                    <ul  class="collapse"  id="authentication"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                         
                          
                        

                        
                      </div>
                    </ul>
                  </li>
                

                

                
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#other-page"
                      aria-expanded="false" aria-controls="other-page">
                      <i class="mdi mdi-file-multiple"></i>
                      <span class="nav-text">Product Management</span> 
                    </a>
                    <ul  class="collapse"  id="other-page"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                        
                   </div>
                    </ul>
                  </li>
              
                <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#customization"
                      aria-expanded="false" aria-controls="customization">
                      <i class="mdi mdi-square-edit-outline"></i>
                      <span class="nav-text">Site Setting</span> 
                    </a>
                    <ul  class="collapse"  id="customization"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                        
                          
                           
                          
                        

                        
                        
                          
                            
                        

                        
                        
                          
                    
                          
                        

                        
                      </div>
                    </ul>
                  </li>
                

                
              </ul>

            </div>

                <div class="sidebar-footer">
                  <div class="sidebar-footer-content">
                    <ul class="d-flex">
                      <li>
                        <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i class="mdi mdi-settings"></i></a></li>
                      <li>
                        <a href="#" data-toggle="tooltip" title="No chat messages"><i class="mdi mdi-chat-processing"></i></a>
                      </li>
                    </ul>
                  </div>
                </div>
          </div>
        </aside>

      <!-- ====================================
          ——— END OF LEFT SIDEBAR WITH OUT FOOTER
        ===================================== --><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/Admin/adminLeftNavbar.blade.php ENDPATH**/ ?>