<!DOCTYPE html>
<html lang="en">

<head>
   <title>Sarabun System </title>
 <?php $this->load->view('include/headHTML') ?>
</head>

<body>
    <div id="wrapper">
<?php if($this->session->userdata('logged_in')["access"]=="u1")
        {$this->load->view('include/menuMain');}
        else{$this->load->view('include/menu');}?>
 <?php $attributes1 = array('id' => 'myform');
 echo form_open('mainPage/rexCopy', $attributes1);?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                            <br />
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-fw fa-arrows-v"></i>  รับหนังสือ
                            </li>
                            <li class="active">
                                  <a href="unit"><i class="fa fa-search"></i> ภายนอก:เรื่องเดิม (ค้นหาหนังสือภายนอกเรื่องเดิม)</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                    <div class="col-lg-8 col-md-offset-2">
                        <div class="table-responsive">
                            <div class="col-lg-10">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-edit"></i> ค้นหาหนังสือภายนอกเรื่องเดิม</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a  class="list-group-item">
                                        <span class="badge"><input class="form-control" placeholder="" name="mess18"  id="mess18" style="height:20px;width: 250px;"></span>
                                        ที่ภายใน
                                    </a>
                                    <a  class="list-group-item" >
                                        <span class="badge" ><select class="form-control" style="height:20px;width: 250px;" name="mess19"  id="mess19">
                                    <option></option>
                                    <option style="color:blue;" value ="N">รับ</option>
                                    <option style="color:red;" value ="Y">ส่ง</option>
                                </select></span>
                                        รับ / ส่ง
                                    </a>

                                    <a  class="list-group-item">
                                        <span class="badge" ><select class="form-control" style="height:20px;width: 250px;"  name="mess20"  id="mess20">
                                    <option></option>      
                                    <option style="color:blue;" value ="ปกติ">ปกติ</option>
                                    <option style="color:blue;"  value ="ปกปิด">ปกปิด</option>
                                    <option style="color:red;" value ="ลับ">ลับ</option>
                                    <option style="color:red;" value ="ลับมาก">ลับมาก</option>
                                    <option style="color:red;" value ="ลับที่สุด">ลับที่สุด</option>
                                </select></span>
                                        ชั้นความลับ
                                    </a>
                                    
                                </div>
									<div class="text-right">
                                    <a onclick="document.getElementById('myform').submit()" href="#">ค้นหาหนังสือ <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php $this->load->view('include/jQfooter'); ?>
</body>

</html>
