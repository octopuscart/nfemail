<?php
$this->load->view('layout/layoutTop');
//$res = $this->Product_model->get_parent($category_id);
//$categoryData = explode(',', $res);
?>
<div class="col-md-12"> 
    <div class="panel panel-inverse" data-sortable-id="index-5">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="<?php echo base_url('index.php/ProductHandler/add_category/0'); ?>"  class="btn btn-xs btn-icon btn-circle btn-default fa fa-arrow-circle-left" ></a> 
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>

            <h4 class="panel-title" style="font-size: 17px;font-weight: 500;">Add Category Information</h4>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-12">
                    <a href='#modal-alert'data-toggle='modal' class="btn btn-primary"><i class="fa fa-plus"></i> Add Main Category</a>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <form method="post">
                        <div id="jstree-default" style="font-size: 17px;">

                            <?php
                            $database = $this->session->userdata('database');
                            print_r($database);
                       
                            $conn = mysql_connect($database['host_name'], $database['user_name'], $database['password']);
                            mysql_select_db($database['database'], $conn);

                            function parent_get($table, $column, $id) {
                                echo "<ul>";
                                $query = mysql_query("select * from $table where $column=$id order by index_menu");
                                while ($row = mysql_fetch_array($query)) {
                                    ?>    
                                    <li data-jstree='{"opened":true}'  id="sortable-<?php echo $row['id']; ?>">
                                        <?php
                                        echo "<span class='product_add'>" . $row['name'] . "&nbsp";
                                        echo "<a href='#modal-alert'data-toggle='modal' onclick='add_category_info(this)'  style='margin: 5px;' class='btn btn-info btn-icon btn-circle btn-xs'  id='" . $row['id'] . "'><i class='fa fa-plus'></i></a>"
                                        . "<a class='delete_menu btn btn-danger btn-icon btn-circle btn-xs'  onclick='delete_category(this)' value='" . $row['id'] . "'><i class ='fa fa-times'></i></a><a style='margin-left : 5px;' href='#modal-alert'data-toggle='modal' class='btn btn-warning btn-icon btn-circle btn-xs' onclick='updateMenuInfo(this)' parent='" . $row['parent'] . "' value='" . $row['id'] . "'  index='" . $row['index_menu'] . "'><i class ='fa fa fa-edit'></i></a></span>";
                                        $cat[$row['id']] = child($table, $column, $row['id']);

                                        echo "</li>";
                                    }
                                    echo "<ul>";
                                    return $cat;
                                }

                                function child($table, $column, $id) { 
                                    echo "<ul>";
                                    $query = mysql_query("select * from $table where $column=$id order by index_menu");
                                    $cat = array();
                                    while ($row = mysql_fetch_array($query)) {
                                        ?>
                                    <li data-jstree='{"opened":true}'  id="sortable-<?php echo $row['id']; ?>">
                                        <?php
                                        $tt = child($table, $column, $row['id']);

                                        if (count($tt) > 0) {

                                            echo "<span class='product_add'>" . $row['name'] . "&nbsp";

                                            echo "<a href='#modal-alert'data-toggle='modal' onclick='add_category_info(this)' class='btn btn-info btn-icon btn-circle btn-xs'  id='" . $row['id'] . "'><i class='fa fa-plus'></i></a> <a style='margin-right: 4px;'  onclick='delete_category(this)'  class='delete_menu btn btn-danger btn-icon btn-circle btn-xs' value='" . $row['id'] . "'><i class ='fa fa-times'></i></a>"
                                            . " <a  href='#modal-alert'data-toggle='modal' style='margin-left : 5px;' class='btn btn-warning btn-icon btn-circle btn-xs' onclick='updateMenuInfo(this)' parent='" . $row['parent'] . "' value='" . $row['id'] . "'  index='" . $row['index_menu'] . "'><i class ='fa fa fa-edit'></i></a></span>";
                                        } else {

                                            echo "<span class='product_add'>" . $row['name'] . "&nbsp";

                                            echo "<a href='#modal-alert'data-toggle='modal' onclick='add_category_info(this)'  class='btn btn-info btn-icon btn-circle btn-xs'  id='" . $row['id'] . "'><i class='fa fa-plus'></i></a> <a  class='delete_menu btn btn-danger btn-icon btn-circle btn-xs' onclick='delete_category(this)' value='" . $row['id'] . "'><i class ='fa fa-times'></i></a> "
                                            . " <a  href='#modal-alert'data-toggle='modal' class='btn btn-warning btn-icon btn-circle btn-xs' onclick='updateMenuInfo(this)' parent='" . $row['parent'] . "' value='" . $row['id'] . "'  index='" . $row['index_menu'] . "'><i class ='fa fa fa-edit'></i></a></span>";
                                        }
                                        $cat[$row['id']] = $tt;


                                        echo "</li>";
                                    }
                                    echo "</ul>";
                                    return $cat;
                                }

                                $cat = parent_get('nfw_category', 'parent', '0');
                                ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
            <div class="modal-content" id="imagemodelcontent">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Category</h4>
                </div>
                <div class="modal-body panel-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Title</label>
                            <div class="col-md-9">
                                <input type="text" name="title" class="form-control" placeholder="Add category title">
                                <input type="hidden" name="parent" value="0">
                                <input type="hidden" name="operation" value="new">
                            </div>
                        </div>
                    </div> 
                </div>

                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <button type="submit" value="Upload" class="submit btn btn-success" name="upload">
                        <i id="loading" class="fa fa-upload"></i> Add Category
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$this->load->view('layout/layoutBottom');
?>
<script>
    function updateMenuInfo(obj) { 
        var parent = $(obj).attr('parent');
        var id = $(obj).attr('value');
        var title = $(obj).parent().text().trim();
     //   title = jquery.trim(title);
        $('input[name=title]').val(title);
        $('input[name=parent]').val(parent);
        $('input[name=operation]').val('edit_' + id);
        $('.modal-title').text('Edit Category');
    }
    function delete_category(obj) {
        var r = confirm("Do you want to delete!");
        if (r == true) {
            var delete_id = $(obj).attr('value');
            window.location.href = '<?php echo base_url(); ?>index.php/productHandler/delete_category_information/' + delete_id;
        }
    }
    function add_category_info(obj) {
        var id = obj.id;
        $('input[name=parent]').val(id);
    }

    $(document).ready(function (e) { 
        $("#uploadimage").on('submit', (function (e) {
            var parent = $('input[name=parent]').val();
            var title = $('input[name=title]').val();
            var operation = $('input[name=operation]').val();
            $.ajax({
                url: '<?php echo base_url() . 'index.php/ProductHandler/add_edit_category_info_ajax'; ?>', 
                data: {'title': title, 'parent': parent, 'operation': operation},
                type: 'GET',
                success: function (data) {
//                    console.log(data);
                    window.location.reload();
                }
            });
        }));
    });
</script>
<script src="<?php echo base_url(); ?>assets_main/plugins/jstree/dist/jstree.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/ui-tree.demo.min.js"></script>
<script src="<?php echo base_url(); ?>assets_main/js/apps.min.js"></script>   
<script>
    $(document).ready(function () {
        App.init();
        TableManageDefault.init();
        TreeView.init();
    });
    $(function () {
        $('.panel-body ul').addClass('forSort');
        $(".forSort").sortable();
        $(".panel-body ul").sortable({
            cursor: 'move',
            opacity: 0.65,
            stop: function (event, ui) {
                var data1 = $(this).sortable('toArray');
              //  console.log(data1)
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/ProductHandler/drag_n_drop_tree_menu", 
                    data: {'sr_data': data1, 'table_name': 'nfw_category', 'column_name': 'index_menu'},
                    success: function (data)
                    {
                        console.log(data);
                    }
                });
            }
        });
    });
</script>

<?php
$this->load->view('layout/layoutFooter');
?>  