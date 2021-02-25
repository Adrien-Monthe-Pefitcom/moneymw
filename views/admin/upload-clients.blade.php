@extends('layouts.dash')
@section('content')
<main>

    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script
        src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet"
          href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

    <div class="container-fluid">
        <h1 class="mt-4">Importer des Clients</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Compte/Administration/Enregistrer des clients</li>
        </ol>



                    <h3 align="center">Import Excel File in Laravel</h3>
                    <br />
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        Upload Validation Error<br><br>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <table class="table">
                                <tr>
                                    <td  align="right"><label>Select File for Upload</label></td>
                                    <td >
                                        <input type="file" name="select_file" />
                                    </td>
                                    <td  align="left">
                                        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                                    </td>
                                </tr>
                                <tr>
                                    <td  align="right"></td>
                                    <td ><span class="text-muted">.xls, .xslx</span></td>
                                    <td  align="left"></td>
                                </tr>
                            </table>
                        </div>
                    </form>

                    <br />

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Customer Data</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Numéro de Compte</th>
                                        <th>Numéro de téléphone</th>

                                    </thead>
                                    @if(isset($data))
                                    
                                        @foreach($data as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->no_compte_carte_virtuelle }}</td>
                                            <td>{{ $row->phone }}</td>

                                        </tr>
                                        @endforeach
                                    @else
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>



    </div>

</main>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
@endsection

