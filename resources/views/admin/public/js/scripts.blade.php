        <script src="{{asset('js/jquery/jquery-3.5.1.slim.min.js')}}"></script>
        <script src="{{ asset('js/jquery/popper.min.js') }}"></script>
        <script src="{{ asset('js/jquery/jquery-3.5.1.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bs4/bootstrap.min.js') }}"></script>
        <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
        <script src="{{ asset('fontawesome/js/brands.js') }}"></script>
        <script src="{{ asset('fontawesome/js/fontawesome.min.js') }}"></script>
        <script src="{{ asset('fontawesome/js/solid.js') }}"></script>
        <script src="{{ asset('jtable/jquery.dataTables.min.js') }}"></script>
        <script>
            $(document).ready( function () {
                var Vietnamese ="{{ asset('jtable/Vietnamese.json') }}";
                $('#myTable').DataTable({

                    processing:true,
                    language: {
                        "url": Vietnamese
                    },
                });
                // Setup - add a text input to each footer cell
            } );

        </script>
