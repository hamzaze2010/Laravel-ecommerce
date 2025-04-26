 <!-- ====================================
      ——— START OF FOOTER
      ===================================== -->
      <footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year"></span> Copyright MOHAMED AND HAMZA <a class="text-primary" href="" target="_blank" >MOHAZ</a>.
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer>

      </div>
    </div>
    
                    



    
                    <script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/plugins/simplebar/simplebar.min.js')); ?>"></script>
                    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

                    
                    
                    <script src="<?php echo e(asset('admin/plugins/apexcharts/apexcharts.js')); ?>"></script>
                    
                    
                    
                    <script src="<?php echo e(asset('admin/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js')); ?>"></script>
                    
                    
                    
                    <script src="<?php echo e(asset('admin/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/plugins/jvectormap/jquery-jvectormap-us-aea.js')); ?>"></script>
                    
                    
                    
                    <script src="<?php echo e(asset('admin/plugins/daterangepicker/moment.min.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
                    <script>
                      jQuery(document).ready(function() {
                        jQuery('input[name="dateRange"]').daterangepicker({
                        autoUpdateInput: false,
                        singleDatePicker: true,
                        locale: {
                          cancelLabel: 'Clear'
                        }
                      });
                        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
                          jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
                        });
                        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
                          jQuery(this).val('');
                        });
                      });
                    </script>
                    
                    
                    
                    
                    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                    
                    
                    
                    <script src="<?php echo e(asset('admin/plugins/toaster/toastr.min.js')); ?>"></script>

                    
                    
                    <script src="<?php echo e(asset('admin/js/mono.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/js/chart.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/js/map.js')); ?>"></script>
                    <script src="<?php echo e(asset('admin/js/custom.js')); ?>"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
                    <script>
                        $(document).ready(function() {
                            $('#liveSearchInput').on('input', function() {
                                var query = $(this).val().trim().toLowerCase();

                                // Clear previous highlights
                                $('.searchable table tbody td').each(function() {
                                    var cellText = $(this).text();
                                    $(this).html(cellText); // Reset original text (remove any previous highlighting)
                                });

                                // Highlight function
                                if (query !== '') {
                                    $('.searchable table tbody td').each(function() {
                                        var cellText = $(this).text();
                                        var highlightedText = cellText.replace(new RegExp(query, "gi"), function(match) {
                                            return '<span class="highlight">' + match + '</span>';
                                        });
                                        $(this).html(highlightedText);
                                    });
                                }
                            });
                        });
                    </script>


                    <!-- ====================================
                    ——— END OF  FOOTER
                    ===================================== -->


 <?php /**PATH C:\wamp64\www\shopShatarat\resources\views/Admin/adminFooter.blade.php ENDPATH**/ ?>