<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        Copyright &copy; 2024 <strong>Janani MultiSpeciality Hospital.</strong>
    </div>
    <div class="credits">
        Made With ❤ <a href="https://medyawebtech.com/"> Medya Web Technologies</a>
    </div>
</footer>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('js/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/chart.umd.js') }}"></script>
<script src="{{ asset('js/echarts.min.js') }}"></script>
<script src="{{ asset('js/quill.js') }}"></script>
<script src="{{ asset('js/simple-datatables.js') }}"></script>
<script src="{{ asset('js/tinymce.min.js') }}"></script>
<script src="{{ asset('js/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('js/mainjs/main.js') }}"></script>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Use full version -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Updated Font Awesome CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<script src="{{ asset('js/customjs/chatting.js') }}"></script>
<script>
    async function sendAxiosRequest(method, apiEndpoint, data) {
        let config = {
            method: method,
            maxBodyLength: Infinity,
            url: `${apiEndpoint}`, // Use relative URL, assuming the API is part of the same Laravel app
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer {{ session('token') }}` // Authorization token
            },
            data: data
        };

        try {
            const response = await axios.request(config);
            return response;
        } catch (error) {
            if (error.response && error.response.status === 401) {
                alert('Please login to continue.');
                window.location.href = "{{ url('/') }}"; // Use direct relative route to login page
            } else {
                throw error;
            }
        }
    }
</script>
@yield('js_script')

</body>

</html>
