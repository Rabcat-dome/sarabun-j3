        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <? $this->load->view('include/headerNav'); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div id="sidebar-wrapper" class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li >
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> รับหนังสือ <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="main"><i class="fa fa-fw fa-table"></i>ภายในระบบ</a>
                            </li>
                            <li>
                                <a href="newexbook"><i class="fa fa-fw fa-edit"></i>ภายนอก:เรื่องใหม่</a>
                            </li>
                            <li>
                                <a href="oldexbook"><i class="fa fa-search"></i> ภายนอก:เรื่องเดิม</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-search"></i> ภายนอก:ตอบกลับ</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-arrows-v"></i> ออกหนังสือ <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-edit"></i>ภายใน:ระดับกอง</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-edit"></i>ภายนอก:ระดับกรม</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-table"></i> อยู่ระหว่างดำเนินการ</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-desktop"></i> เอกสารจบขั้นตอน</a>
                    </li>
                    <li>.</li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-table"></i> อยู่ระหว่างดำเนินการ:ทั้งกรม</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-desktop"></i> เอกสารจบขั้นตอน:ทั้งกรม</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav> 