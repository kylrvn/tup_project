<div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Remarks</th>
                                    <th>Publish By</th>
                                    <th>Publish Date</th>
                                    <th>Date Created</th>

                                </tr>
                            </thead>
                                <?php
                                $ci = & get_instance();
                                if(!empty($details)){
                                    foreach ($details as $key => $value) {
                                        ?>
                                            <tr>
                                                <td><?=(@$value->Doc_name)?></td>
                                                <td><?=(@$value->Description)?></td>
                                                <td><?=@$value->Cat_name?></td>
                                                <td><?=@$value->Remarks?></td>
                                                <td><?=@$value->Publish_by?></td>
                                                <td><?=date("M d, Y", strtotime(@$value->Publish_date))?></td>
                                                <td><?=date("M d, Y", strtotime(@$value->Date_created))?></td>                   
                                            </tr>
                                        <?php  
                                    }        
                                }
                                else{
                                    ?>
                                        <tr>
                                            <td colspan="7">
                                                <div><center><h6 style="color:red">No Data Found.</h6></center></div>
                                            </td>
                                        </tr>
                                    <?php
                                    
                                }
                            ?>
                        </table>
                    </div>