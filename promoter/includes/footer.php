<!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
    <div class="copyright">
        <p>Copyright © Developed by <a href="https://dexignzone.com/" target="_blank">DexignZone</a> 2023</p>
    </div>
</div>
<!--**********************************
            Footer end
        ***********************************-->

<!--**********************************
           Support ticket button start
        ***********************************-->

<!--**********************************
           Support ticket button end
        ***********************************-->


</div>
<!--**********************************
        Main wrapper end
    ***********************************-->

<!--**********************************
        Scripts
    ***********************************-->
<!-- Required vendors -->
<script src="./assets/vendor/global/global.min.js"></script>
<script src="./assets/vendor/chart.js/Chart.bundle.min.js"></script>
<script src="./assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="./assets/vendor/apexchart/apexchart.js"></script>

<!-- Dashboard 1 -->
<script src="./assets/js/dashboard/dashboard-1.js"></script>
<script src="./assets/vendor/draggable/draggable.js"></script>
<script src="./assets/vendor/swiper/js/swiper-bundle.min.js"></script>


<!-- tagify -->
<script src="./assets/vendor/tagify/dist/tagify.js"></script>

<script src="./assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="./assets/vendor/datatables/js/dataTables.buttons.min.js"></script>
<script src="./assets/vendor/datatables/js/buttons.html5.min.js"></script>
<script src="./assets/vendor/datatables/js/jszip.min.js"></script>
<script src="./assets/js/plugins-init/datatables.init.js"></script>

<!-- Apex Chart -->

<script src="./assets/vendor/bootstrap-datetimepicker/js/moment.js"></script>
<script src="./assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- Vectormap -->
<script src="./assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
<script src="./assets/vendor/jqvmap/js/jquery.vmap.world.js"></script>
<script src="./assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
<script src="./assets/js/custom.js"></script>
<script src="./assets/js/deznav-init.js"></script>
<script src="./assets/js/demo.js"></script>
<script src="./assets/js/styleSwitcher.js"></script>


<script src="./assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="./assets/js/plugins-init/sweetalert.init.js"></script>

<script>
    function removeMessages() {
        // Get all elements with class 'error' and 'success'
        var errorMessages = document.querySelectorAll('.error');
        var successMessages = document.querySelectorAll('.success');

        // Function to remove messages
        function removeElement(element) {
            element.parentNode.removeChild(element);
        }

        // Remove error messages after 1 minute
        errorMessages.forEach(function(element) {
            setTimeout(function() {
                removeElement(element);
            }, 5000);
        });

        // Remove success messages after 1 minute
        successMessages.forEach(function(element) {
            setTimeout(function() {
                removeElement(element);
            }, 5000); // 1 minute = 60,000 milliseconds
        });
    }

    // Call the function when the page loads
    window.onload = function() {
        // Call the existing window.onload function to clear messages from the URL
        if (window.history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('error');
            url.searchParams.delete('success');
            window.history.replaceState(null, null, url);
        }

        // Call the function to remove messages from the DOM after 1 minute
        removeMessages();
    };
    
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</body>

<!-- Mirrored from yashadmin.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 Jan 2024 08:54:37 GMT -->

</html>