 <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
 <script>
     $(".dataTypeSelect").on("change",function (e){
         if($(this).val().replaceAll(' ') === "Yearly"){
             $(".selectaday").addClass("d-none");
             $(".yearlyData").removeClass("d-none");
             $(".weeklyData").addClass("d-none");
             $(".monthlyData").addClass("d-none");
         }else if($(this).val().replaceAll(' ') === "Monthly") {
             $(".selectaday").addClass("d-none");
             $('.monthlyData').removeClass('d-none');
             $(".yearlyData").removeClass("d-none");
             $(".weeklyData").addClass("d-none");
         } else if ($(this).val().replaceAll(' ') === "Weekly"){
             $(".selectaday").addClass("d-none");
             $(".weeklyData").removeClass("d-none");
             $(".yearlyData").removeClass("d-none");
             $(".monthlyData").addClass("d-none");
         }else {
             $(".selectaday").removeClass("d-none");
             $(".weeklyData").addClass("d-none");
             $(".yearlyData").addClass("d-none");
             $('.monthlyData').addClass('d-none');
         }

         // $(".selectaday").removeClass("d-none");
     });
     $("#selectedYear").on("change",function (e){
         const selectedYear = $(this).val();
         $.ajax({
             url : "{{route('getWeeks')}}",
             data : {'year' : selectedYear},
             success : function (res){
                 const selectElement = document.querySelector('.weeklyData2');
                 $('.weeklyData2').empty();
                 for (const [key, value] of Object.entries(res.weeks)) {
                     const option = document.createElement('option');
                     option.value = key;
                     option.text = value;
                     selectElement.appendChild(option);
                 }
             }
         });
     })
 </script>
</body>
