<div class="col-md-12" style="margin-top: 15px;">
    <div class="panel panel-info">
        <div class="panel-heading">
            Add Images For Product. (1st Image will be primary image, you can arrange image sequence by drag and drop.)
            <button tyle="button" onclick="addNew()" class="pull-right btn btn-warning btn-xs">
                <i class="fa fa-plus"></i>
            </button>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3 fileUploadDiv animated template_image" style="display:none">
                    <div class="thumbnail">
                        <div class="delete_image" style="display: none;">
                            <span class="circle icon_wrap_size_1 d_inline_m m_right_8">x</span>
                        </div>
                        <img class="vfileTag" src="" alt="Choose a file from your device and upload it." style="height: 200px;">
                        <i class="votherFile fa fa-file" style="font-size: 184px;margin: 8px;display:none"></i>
                        <form class="vuploadFile" action="" method="post" enctype="multipart/form-data">
                            <div style="width:100%;height: 7px">
                                <div class='vdisplayprogress vprogress-bar' style="width:0%;height:5px;background:red;margin-bottom: 5px"></div>
                            </div>
                            <center><input type="file" name="file"  required class="vfilestyle vfile" style="width: 100%"></center>
                            <input type='hidden' name='image_name' value='<?php
                            echo ($category[0]['id']), ($imageId[0]['id']);
                            ?>'>
                            <input type="hidden" name="file_name">
                            <button type="submit" value="Upload" class="submit form-control btn btn-primary vuploadButton" value="upload" style="  margin-top: 12px;">
                                <i class="fa fa-upload vuploadIcon"></i> 
                                <span class="vuploadText">Upload</span>
                            </button>

                        </form>
                    </div>
                </div>
                <div class="row vfileContainer" style="padding: 10px;"></div>
            </div>
        </div>
    </div>
</div>