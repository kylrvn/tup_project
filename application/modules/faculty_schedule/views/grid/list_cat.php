<div class="card-body table-responsive p-0" style="height: 300px;">
                        
    <table class="table table-head-fixed text-nowrap">
        <thead>
            <tr>
                <th>Category</th>
                <th>Date Created</th>
                <th>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default1" id="Add_cat">Add Category</button> 
                </th>
            </tr>
        </thead>
            <?php
            $ci = & get_instance();
            if(!empty($details)){
                foreach ($details as $key => $value) {
                    ?>
                        <tr>
                            <td><?=(@$value->Cat_name)?></td>
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

<!-- CONFIRMATION MODAL ADD CATEGORY -->
<div class="modal fade" id="modal-default1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                    <!-- FORM FOR ADDING CATEGORY -->
                    <form>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group w-100">
                                    <label for="">Document Category</label>
                                    <input type="text" id="doc_cat" class="form-control inpt" placeholder="Category">
                                </div>
                            </div>
                        </div>
                    </form>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default1" id="save_cat">Submit</button>
            </div>
        </div>
    </div>
</div>