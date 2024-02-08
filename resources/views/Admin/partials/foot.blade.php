</div>
<script src="{{asset('assets/admin/js/main.js')}}"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Your custom JS -->
<script src="{{asset('assets/admin/js/main.js')}}"></script>
<!-- Initialize Summernote -->
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Enter description here...',
            height: 200,
        });
    });
</script>
</body>
</html>
