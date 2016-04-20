@extends('adminPanel.adminDashboard')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Companies in Database: </h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Sr.</th>
                <th>Db ID</th>
                <th>Name</th>
                <th>Creation</th>
            </tr>
            </thead>
            <tbody>
            <?php echo $companyList;  ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Sr.</th>
                <th>Db ID</th>
                <th>Name</th>
                <th>Creation</th>
            </tr>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection