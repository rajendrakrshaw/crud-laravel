<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>CRUD FROM API</title>
    <style>
        .bg-mynav {
            background-color: #2c3e50;
        }

        body {
            font-size: 1.25rem;
            background-color: #f6f8fa;
        }

        td {
            line-height: 3rem;
        }
    </style>

    {{-- <link href="index.css" rel="stylesheet"> --}}
</head>

<body>

    <nav class="navbar navbar-dark bg-mynav">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My App</a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex bd-highlight mb-3">
            <div class="me-auto p-2 bd-highlight">
                <h2>Students
            </div>
            <div class="p-2 bd-highlight">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addStudent">Create</button>
            </div>
        </div>
        <div class="modal" id="addStudent" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Student</h5>
                        <button type="button" class="close btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addStudentForm" action="" class="p-3">
                            <div class="form-group">
                                @csrf
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="roll">Roll</label>
                                @csrf
                                <input type="text" class="form-control" name="roll" id="roll">
                            </div>
                            <div class="form-group">
                                <label for="stream">Stream</label>
                                @csrf
                                <input type="text" class="form-control" name="stream" id="stream">
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                @csrf
                                <input type="text" class="form-control" name="year" id="year">
                            </div>
                            <div class="form-group">
                                <label for="dob">DOB</label>
                                @csrf
                                <input type="date" class="form-control" name="dob" id="dob">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                @csrf
                                <input type="text" class="form-control" name="city" id="city">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="addStudentSubmit" class="btn btn-primary">Add student</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="editStudent" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Student</h5>
                        <button type="button" class="close btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editStudentForm" action="" class="p-3">
                            <div class="form-group">
                                @csrf
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="editname">
                            </div>
                            <div class="form-group">
                                <label for="roll">Roll</label>
                                @csrf
                                <input type="text" class="form-control" name="roll" id="editroll">
                            </div>
                            <div class="form-group">
                                <label for="stream">Stream</label>
                                @csrf
                                <input type="text" class="form-control" name="stream" id="editstream">
                            </div>
                            <div class="form-group">
                                <label for="year">Year</label>
                                @csrf
                                <input type="text" class="form-control" name="year" id="edityear">
                            </div>
                            <div class="form-group">
                                <label for="dob">DOB</label>
                                @csrf
                                <input type="date" class="form-control" name="dob" id="editdob">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                @csrf
                                <input type="text" class="form-control" name="city" id="editcity">
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="editStudentSubmit" class="btn btn-primary">Update student</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Roll</th>
                        <th scope="col">Stream</th>
                        <th scope="col">Year</th>
                        <th scope="col">DOB</th>
                        <th scope="col">City</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody id="mytable">
                    <tr>
                        <th scope="row" colspan="5">Loading...</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addStudentSubmit').click(function() {
                console.log('Submit button clicked'); // Add this line

                var formData = {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    roll: $('#roll').val(),
                    stream: $('#stream').val(),
                    year: $('#year').val(),
                    dob: $('#dob').val(),
                    city: $('#city').val(),

                    // Add other static fields as needed
                };

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/students/create',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log('Success:', response); // Add this line
                        $('#addStudentForm')[0].reset();
                        $('#addStudent').modal('hide');
                        $('.modal-backdrop').remove();
                        location.reload();

                    },
                    error: function(error) {
                        console.error('Error:', error); // Add this line
                        // Handle errors, e.g., display an error message
                    }
                });
            });
        });


        $(document).ready(function() {
            $.ajax({
                url: '/api/students/fetch', // Replace with your API endpoint
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    var tableBody = $('#mytable');
                    tableBody.empty(); // Clear the loading message or any existing data
                    var data = response.data;
                    // Check if data is not empty
                    if (data.length > 0) {
                        $.each(data, function(index, item) {
                            var row = $('<tr>');
                            row.append($('<td>').text(item.id));
                            row.append($('<td>').text(item.name));
                            row.append($('<td>').text(item.roll));
                            row.append($('<td>').text(item.stream));
                            row.append($('<td>').text(item.year));
                            row.append($('<td>').text(item.dob));
                            row.append($('<td>').text(item.city));
                            row.append(
                                '<td><button type="button" class="btn btn-warning btn-edit" data-id="' +
                                item.id +
                                '">Edit</button> <button  type="button" class="btn btn-danger btn-delete" data-id="' +
                                item.id + '">Delete</button></td>');
                            tableBody.append(row);
                        });
                    } else {
                        // If no data is returned
                        tableBody.append('<tr><td colspan="3">No data available</td></tr>');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error fetching data: ' + textStatus);
                    $('#mytable').html('<tr><td colspan="3">Error loading data</td></tr>');
                }
            });
        });

        $(document).on("click", ".btn-edit", function() {
            console.log("Edit button clicked");
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var student = {
                id: id,
                name: row.children('td').eq(1).text(),
                roll: row.children('td').eq(2).text(),
                stream: row.children('td').eq(3).text(),
                year: row.children('td').eq(4).text(),
                dob: row.children('td').eq(5).text(),
                city: row.children('td').eq(6).text()
            };
            console.log(student);
            // $.ajax({
            $('#editname').val(student.name);
            $('#editroll').val(student.roll);
            $('#editstream').val(student.stream);
            $('#edityear').val(student.year);
            $('#editdob').val(student.dob);
            $('#editcity').val(student.city);
            $('#editStudent').modal("show");
            $('#editStudentSubmit').click(function(){
                console.log("Update Submitted");
                // var formdata = new formData();
                var formdata = {
                    _token : '{{ csrf_token() }}',
                    id: id,
                    name : $('#editname').val(),
                    roll : $('#editroll').val(),
                    stream : $('#editstream').val(),
                    year : $('#edityear').val(),
                    dob : $('#editdob').val(),
                    city : $('#editcity').val(),
                };
                console.log(formdata);
                $.ajax({
                    url: "api/students/update",
                    method: "GET",
                    data: formdata,
                    dataType: 'json',
                    success: function(response) {
                        console.log('Success:', response); // Add this line
                        $('#editStudentForm')[0].reset();
                        $('#editStudent').modal('hide');
                        $('.modal-backdrop').remove();
                        location.reload();

                    },
                    error : function(response){
                        console.log('Error:', response);
                    }
                })
            });
        });

        $(document).on("click", ".btn-delete", function() {
            console.log("Delete button clicked");
            var id = $(this).data('id');
            $.ajax({
                url: '/api/students/delete/id', // Replace with your API endpoint
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(response) {
                    console.log('Delete success:', response);
                    // Reload or refresh the table data
                    location.reload();
                },
                error: function(error) {
                    console.error('Delete error:', error);
                    // Handle errors, e.g., display an error message
                }
            });
        });
    </script>
    {{-- <script src="index.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>
