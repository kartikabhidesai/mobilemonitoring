<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="col-md-3" style="padding-left: 0">
                    <div class="caption">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject font-green-haze sbold uppercase"> Affiliate user List </span>
                    </div>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body">
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                        <thead>
                        <tr role="row" class="heading">
                            <th>No</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone no</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j=0;
                            for($i=0; $i<count($getAffiliateUser); $i++){ 
                                $j++
                                ?>
                                <tr>  
                                   <td><?= $j;?></td>  
                                   <td><?= $getAffiliateUser[$i]->user_name?></td>  
                                   <td><?= $getAffiliateUser[$i]->email?></td>  
                                   <td><?= $getAffiliateUser[$i]->phone_no?></td>  
                                </tr>
                           <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>