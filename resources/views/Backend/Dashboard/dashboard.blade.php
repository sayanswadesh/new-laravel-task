<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <a href="{{route('allChallan')}}">
                    <div class="inner">
                        <h3>{{$total_quentity??0}}</h3>
                        <p>Total Quantity Of Sand(in cft)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <a href="{{route('allChallan')}}">
                    <div class="inner">
                        <h3>{{$monthly_quentity??0}}</h3>
                        <p>Monthly Quantity Of Sand(in cft)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>