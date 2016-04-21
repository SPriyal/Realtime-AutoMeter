@extends('adminPanel.adminDashboard')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Database </h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <?php echo $List ?>
            </tfoot>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection