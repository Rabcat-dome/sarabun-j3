<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class MainPage extends CI_Controller {

	public function __construct()
     {
          parent::__construct();
          $this->load->library('session');
          $this->load->helper('form');
          $this->load->helper('url');
          $this->load->helper('date');
          $this->load->helper('html');
          $this->load->database();
          $this->load->library('form_validation');
          //load the login model
          $this->load->model('book');
          $this->load->model('user');
     }

	public function index()
	{
  		  $username = $this->input->post("txt_username");
        $password = $this->input->post("txt_password");

          //set validations
          $this->form_validation->set_rules("txt_username", "Username", "trim|required");
          $this->form_validation->set_rules("txt_password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
               $this->load->view('index');
          }
          else
          {
               //validation succeeds
               if ($this->input->post('btn_login') == "Login")
               {
                    //check if username and password is correct
                    $usr_result = $this->user->get_user($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
                         $usr_row = $this->user->get_row($username, $password);
                         //set the session variables
                         $sessiondata = array(
                              'id' => $usr_row->id,
                              'username' => $usr_row->username,
                              'password' => $usr_row->password,
                              'access' => $usr_row->access,
                              'name' => $usr_row->name,
                              'acroname' => $usr_row->acroname,
                              'nameID' => $usr_row->nameID,
                              'section' => $usr_row->section
                         );
                         $this->session->set_userdata('logged_in',$sessiondata);
                         redirect("mainPage/main");
                    }
                    else
                    {
                         $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username or password!</div>');
                         redirect('mainPage/index');
                    }
               }
               else
               {
                    redirect('mainPage/index');
               }
          }

		
	}
		public function reunitAc()
	{
          if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_book();
				$data['bookin'] = $this->book->get_detailbook();
                $this->load->view('reunitAc',$data);
               
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

		
	}

	public function main()
	{
          if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_book();
                $this->load->view('home',$data);
               
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

		
	}
	public function reCopy()
	{
          if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_book();
                $this->load->view('reCopy',$data);
               
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

		
	}
	
	public function reNew()
	{
          if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_book();
                $this->load->view('reNew',$data);
               
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

		
	}

	public function makenew()
	{
          if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_book();
                $this->load->view('makenew',$data);
               
            }
            else
            {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
            }

		
	}


  public function unit()
  {
          if($this->session->userdata('logged_in'))
            {

                $data = $this->session->userdata('logged_in');
                $data['rs'] = $this->user->unit_table();
                $this->load->view('unit',$data);
                
            }
            else
            {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
            }

    
  }
   public function bookmain()
  {  

    /*
	     if($this->session->userdata('logged_in'))
            {

                $data = $this->session->userdata('logged_in');
                $data['rs'] = $this->user->unit_table();
                $this->load->view('unit',$data);
                
            }
            else
            {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
            }
		*/

         if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
				//$data['bookin'] = $this->book->get_detailbook();
				$data['bookin'] = $this->book->get_detailbook();
			    $data['bookin_user'] = $this->book->get_user();
                $this->load->view('bookmain',$data);
               
            }
            else
             {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
             }

			
    

    
  }
     public function transaction()
  {
         if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_detailbook();
				$data['bookin_transaction'] = $this->book->get_transaction();
                $this->load->view('transaction',$data);
               
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

    
  }


  public function editPass()
  {
          if($this->session->userdata('logged_in'))
            {
                if($this->input->post('btsave')!=null)
                { 
                  $ar = array(
                    "name"=>$this->input->post("tname"),
                    "acroname"=>$this->input->post("tacroname"),
                    "nameID"=>$this->input->post("tnameid"),
                    "section"=>$this->input->post("tsection"),
                    "password"=>$this->input->post("tpassword")
                    );
                  $this->user->unit_editTable($ar);
                  redirect("mainPage","refresh");
                }else{
                $data = $this->session->userdata('logged_in');
                $data['rs'] = $this->user->get_row($this->session->userdata('logged_in')["username"],$this->session->userdata('logged_in')["password"]);
                $this->load->view('editPass',$data);}
            }
            else
            {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
            }


     }
     public function bookinfo($bid){  //หน้าแสดงข้อมูลหนังสือ  ยังทำไม่เสร็จ
               if($this->session->userdata('logged_in'))
           {
                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
                $this->load->view('viewInfo',$data);

            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
     }
	 public function bookinfo_new(){  
               if($this->session->userdata('logged_in'))
            {
				$data = $this->session->userdata('logged_in');
			    $data['bookin'] = $this->book->get_info();
                $this->load->view('bookinfo',$data);
            }
            else
               {
               
                redirect('mainPage', 'refresh');
               }
     }
     public function rexCopy()
     {


		
				 $data = $this->session->userdata('logged_in');
				 $data['bookin'] = $this->book->get_rexCopy();
			     $this->load->view('home',$data);
				  
	 }


     public function rexCome()
     {


				 $data = $this->session->userdata('logged_in');
				 $data['bookin'] = $this->book->get_reCome();
			     $this->load->view('home',$data);
				  
	 }
	    public function rexCome_send()
     {


				 $data = $this->session->userdata('logged_in');
				 $data['bookin'] = $this->book->get_reCome_send();
			     $this->load->view('home',$data);
				  
	 }

	 public function upbook()
     {
		    if($this->session->userdata('logged_in'))
           {
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_upbook();
                $this->load->view('upbook',$data);
            }
            else
            {
           redirect('mainPage', 'refresh');
            }	  
	 }
	
	 public function ResendPro()
     {
         if($this->session->userdata('logged_in'))
           {
			  
                $data = $this->session->userdata('logged_in');
				$data['bookin_user'] = $this->book->get_ResendPro();
                $data['bookin'] = $this->book->get_detailbook();
				
                $this->load->view('ResendPro',$data);
               
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

    
      }

	  public function send()
      {
       $array= $this->input->post("nameID");

	  foreach ($array as $row)
            {


				$ActionTB_del_user  = $this->session->userdata('logged_in')["username"];
				$ActionTB_del= $row."".$ActionTB_del_user ;
			    $this->db->where('ActionTB.bookid', $ActionTB_del );
			    $this->db->delete('ActionTB');

	           
				$send = "ส่ง";
				$ar_TransactionTB=array(
                "bookID"=>$this->input->post("mess0"),
                "unit"=>$this->input->post("mess1"),
				"Actions"=>$send,
				"trandate"=>date('Y-m-d', now()),
                 );
			    $this->db->insert('TransactionTB',$ar_TransactionTB);
			}
    
     }
	  public function co_upbook()
     {
		    if($this->session->userdata('logged_in'))
           {
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_co_upbook();
                $this->load->view('co_upbook',$data);
            }
            else
            {
           redirect('mainPage', 'refresh');
            }	  
	 }
	  public function upload_form()
     {
		    if($this->session->userdata('logged_in'))
           {
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_co_upbook();
                $this->load->view('upload_form',$data);
            }
            else
            {
           redirect('mainPage', 'refresh');
            }	  
	 }
	  public function editbook()
     {
		    if($this->session->userdata('logged_in'))
           {
                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_editbook();
                $data['str'] = $this->input->post("mess0");
                $this->load->view('editbook',$data);
            }
            else
            {
           redirect('mainPage', 'refresh');
            }	  
	 }
	   public function updatebook()
     {
		   
		   if($this->session->userdata('logged_in'))
           {
	        $Booktb_id_update= $this->input->post("mess0");

			$Booktb_update=array(
                      "send"=>"",
                      "inid"=>"",
                      "speed"=>$this->input->post("mess1"),
                      "bookType"=>$this->input->post("mess2"),
                      "secret"=>$this->input->post("mess3"),
                      "id"=>$this->input->post("mess5"),
                      "author"=>$this->input->post("mess6"),
                      "days"=>$this->input->post("example1"),
                      "subject"=>$this->input->post("mess8"),
                      "beginword"=>$this->input->post("mess9")
                      );
			$this->db->where('bookID', $Booktb_id_update);
			$this->db->update('Booktb', $Booktb_update); 
            $data = $this->session->userdata('logged_in');
            $data['bookin'] = $this->book->get_book();
            $this->load->view('home',$data);
            }
            else
            {
           redirect('mainPage', 'refresh');
            }	  
		
	 }
	  public function savebook()
     {

     
       if($this->session->userdata('logged_in'))
           {
	

                
			    $ar_Booktb=array(
                "bookID"=>$this->input->post("mess0"),
                "unit"=>$this->input->post("mess1"),
                 );
			    $this->db->insert('ReUnit',$ar_Booktb);

				$ar_TransactionTB=array(
                "bookID"=>$this->input->post("mess0"),
                "unit"=>$this->input->post("mess1"),
				"Actions"=>$this->input->post("mess2"),
				"trandate"=>date('Y-m-d', now()),
                 );
			    $this->db->insert('TransactionTB',$ar_TransactionTB);

				$ActionTB_del_book  = $this->input->post("mess0");
				$ActionTB_del_user  = $this->session->userdata('logged_in')["username"];
				$ActionTB_del= $ActionTB_del_book."".$ActionTB_del_user ;
			    $this->db->where('ActionTB.actionID', $ActionTB_del );
			    $this->db->delete('ActionTB');

               	$data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_book();
                $this->load->view('home',$data);
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

            
		
	 }

	  public function save1book()
     {

     
       if($this->session->userdata('logged_in'))
           {
//---------------------------------------  insert reunit

			    $ar_Booktb=array(
                "bookID"=>$this->input->post("mess0"),
                "unit"=>$this->input->post("mess1"),
                 );
			    $this->db->insert('ReUnit',$ar_Booktb);
//---------------------------------------  delete actiontb
			    $ActionTB_del_book  = $this->input->post("mess0");
				$ActionTB_del_user  = $this->session->userdata('logged_in')["username"];
				$ActionTB_del= $ActionTB_del_book."".$ActionTB_del_user ;
			    $this->db->where('ActionTB.actionID', $ActionTB_del );
			    $this->db->delete('ActionTB');
//---------------------------------------   insert TransactionTB
				$Actions_save= "จัดเก็บเพื่อทราบ";
				$ar_TransactionTB=array(
                "bookID"=>$this->input->post("mess0"),
                "unit"=>$this->input->post("mess1"),
				"Actions"=>$Actions_save,
				"trandate"=>date('Y-m-d', now()),
                 );
			    $this->db->insert('TransactionTB',$ar_TransactionTB);
//-------------------------------------------  update booktb
                $Booktb_id_update = $this->input->post("mess0");
			    $Booktb_update=array("Info"=>"Y",);
			    $this->db->where('bookID', $Booktb_id_update);
			    $this->db->update('Booktb', $Booktb_update); 



                $data = $this->session->userdata('logged_in');
				$data['bookin'] = $this->book->get_detailbook();
                $this->load->view('bookmain',$data);
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }

            
		
	 }
	public function do_upload()
	 {
		$bookid= $_POST['bookid'];
		$config['file_name'] = "Up".$bookid.$this->session->userdata('logged_in')["username"];
		$config['upload_path'] = './application/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|xls|doc|doc|docx|xlsx';
		$config['max_size']	= '100000';

		

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			 
           
		}
		else
		{

			  $arr_image = array('upload_data' => $this->upload->data());
                print_r($arr_image);

			

               echo $arr_image['file_name'];
			   	$this->db->where('bookID', $bookid);
			$status_bookFile = $config['file_name'];
			//$this->db->where('status', $status_actionTB);
            $data_bookFile=array( "bookFile"=>$status_bookFile,);
			$this->db->update('booktb', $data_bookFile); 
		
               
		}

	
          


	}
     public function receive()
     {
	  $bookID  = $this->input->post("bookID");
	
      $receive = "รับ";
	  $status_actionTB = $this->session->userdata('logged_in')["username"];
	  $data_actionTB = array( "Status"=>$status_actionTB,);
	  $acroname =  $this->session->userdata('logged_in')["acroname"];
	  $trandate =  time();

      $datestring = "%Y-%m-%d";
      $time    = time();
      $time1   = mdate($datestring, $time);

		
             //------------------------------At Update table actionTB status ---------

            
								$this->db->where('bookID', $bookID);
								$this->db->where('status', $status_actionTB);
								$this->db->update('actionTB', $data_actionTB); 

		     //-------------------------At Update table bookTB Locals ------------
			         $query = $this->db->query("SELECT * FROM bookTB where BookID='".$row."'");
                                  $unit =$row_unit->unit;
								  $Locals_bookTB=array( "Locals"=>$acroname,);
								  $this->db->where('bookID',  $bookID);
								  $this->db->update('bookTB', $Locals_bookTB); 
             //------------------------------At insert table ReUnit --------------------
								  $this->db->distinct();
								  $bookID  = $this->input->post("bookID");
								  $arBooktb=array(
								
								  "bookID"=>$bookID,
							      "unit"=>$acroname,
								  "redate"=>$time1,
									  
                                   );
				                 $this->db->insert('reunit',$arBooktb);
		    //------------------------------At insert table ReUnit --------------------
								  $this->db->distinct();
								  $arBooktb=array(
								  "bookID"=>$bookID,
							      "actions"=>$receive,
							      "unit"=>$acroname,
								  "trandate"=>$time1,
                                   );
				                 $this->db->insert('TransactionTB',$arBooktb);

              
                                  
					 
          
			      
       
					 redirect("mainPage/main","refresh");
		
							
				

	           }


 public function newexbook_newid()
     {

                $Booktb_id_update = $this->input->post("bookID");

               if($this->session->userdata('logged_in')!=null)
                 {
                   if($this->input->post("mess1")!=null)
                  {

$this->db->distinct();
$this->db->select('*');
$this->db->order_by("inid","ASC");
$temp = $this->db->get_where('booktb', array('send'=>'N','secret'=>$this->input->post("mess3"),'years'=>mdate("%Y",now()),'unit'=>$this->session->userdata('logged_in')["username"]));
                  
                    $arBooktb=array(
                      "send"=>"N",
                      "inid"=>"",
                      "speed"=>$this->input->post("mess1"),
                      "bookType"=>$this->input->post("mess2"),
                      "secret"=>$this->input->post("mess3"),
                      "id"=>$this->input->post("mess5"),
                      "author"=>$this->input->post("mess6"),
                      "days"=>$this->input->post("example1"),
                      "subject"=>$this->input->post("mess8"),
                      "beginword"=>$this->input->post("mess9")
                      );
                      $this->db->where('bookID', $Booktb_id_update);
					  $this->db->update('booktb',$arBooktb);


					 

	//------------------------------------ insert ActionTB------------------------------------------

					 
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arActionTB=array(
                      "actionID"=>$Booktb_id_update."".$logged_in,
                      "bookID"=>$Booktb_id_update,
                      "Status"=>$this->session->userdata('logged_in')['username'],
                        );
					  $this->db->where('bookID', $Booktb_id_update);
				      $this->db->update('ActionTB',$arActionTB);

					

//------------------------------------ insert ReUnit------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arReUnit=array(
                      "bookID"=>$arbookID,
                      "unit"=>$this->input->post("mess4"),
                        );
					  $this->db->where('bookID', $Booktb_id_update);
				      $this->db->update('ReUnit',$arReUnit);


  //-------------------------------------  insert TransactionTB--------------------------------


                      $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
								//  $arUnit =$row_unit->unit;
                                 }

					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arTransactionTB=array(
                      "bookID"=>$arbookID,
                      "Actions"=>"รับ",
					  "acUnit"=>$this->input->post("mess4"),
					  "trandate"=>now(),
                        );
					  $this->db->where('bookID', $Booktb_id_update);
				      $this->db->update('TransactionTB',$arTransactionTB);


                   

                    $arReunit=array(
                      );

                   
                  

                    redirect("mainPage/main","refresh");
                    exit();
                  
				  }
                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
                $data['rs'] = $this->book->get_division();
			
			
			

				$data['bookmain_bookID'] = $_POST["bookmain_bookID"];
				$data['bookmain_secret'] = $_POST["bookmain_secret"];
				$data['bookmain_speed'] = $_POST["bookmain_speed"];
				$data['bookmain_bookType'] = $_POST["bookmain_bookType"];
				$data['bookmain_id'] = $_POST["bookmain_id"];
				$data['bookmain_author'] = $_POST["bookmain_author"];
				$data['bookmain_days'] = $_POST["bookmain_days"];
				$data['bookmain_subject'] = $_POST["bookmain_subject"];
				$data['bookmain_beginword'] = $_POST["bookmain_beginword"];
                $this->load->view('reNew',$data);
				
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }
     public function newexbook()
     {

         
               if($this->session->userdata('logged_in')!=null)
           {
                   if($this->input->post("mess1")!=null)
                  {

$this->db->distinct();
$this->db->select('*');
$this->db->order_by("inid","ASC");
$temp = $this->db->get_where('booktb', array('send'=>'N','secret'=>$this->input->post("mess3"),'years'=>mdate("%Y",now()),'unit'=>$this->session->userdata('logged_in')["username"]));



                    
				
                      $days_yesr = $this->input->post("example1");
					  $day=substr($days_yesr,0,2);
					  $month=substr($days_yesr,3,2);
					  $year=substr($days_yesr,6,8);
					  $days= $year."-".$month."-".$day;
                   

                    $arBooktb=array(
                      "send"=>"N",
                      "inid"=>"",
                      "speed"=>$this->input->post("mess1"),
                      "bookType"=>$this->input->post("mess2"),
                      "secret"=>$this->input->post("mess3"),
                      "id"=>$this->input->post("mess5"),
                      "author"=>$this->input->post("mess6"),
                      "days"=> $days,
                      "subject"=>$this->input->post("mess8"),
                      "beginword"=>$this->input->post("mess9")
                      );

					  $this->db->insert('booktb',$arBooktb);

	//------------------------------------ insert ActionTB------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arActionTB=array(
                      "actionID"=>$arbookID."".$logged_in,
                      "bookID"=>$arbookID,
                      "Status"=>$this->session->userdata('logged_in')['username'],
                        );										
				      $this->db->insert('ActionTB',$arActionTB);


//------------------------------------ insert ReUnit------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arReUnit=array(
                      "bookID"=>$arbookID,
                      "unit"=>$this->input->post("mess4"),
                        );										
				      $this->db->insert('ReUnit',$arReUnit);


  //-------------------------------------  insert TransactionTB--------------------------------


                      $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
								//  $arUnit =$row_unit->unit;
                                 }

					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arTransactionTB=array(
                      "bookID"=>$arbookID,
                      "Actions"=>"รับ",
					  "acUnit"=>$this->input->post("mess4"),
					  "trandate"=>now(),
                        );										
				      $this->db->insert('TransactionTB',$arTransactionTB);


                   

                    $arReunit=array(
                      );

                   
                  

                    redirect("mainPage/main","refresh");
                    exit();
                  
				  }
                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
                $data['rs'] = $this->book->get_division();
			    $data['bookmain_bookID']   = "";
				$data['bookmain_secret']   = "";
				$data['bookmain_speed']    = "";
				$data['bookmain_bookType'] = "";
				$data['bookmain_id']       = "";
				$data['bookmain_author']   = "";
				$data['bookmain_days']     = "";
				$data['bookmain_subject']  = "";
				$data['bookmain_beginword']= "";
			
			  
                $this->load->view('reNew',$data);
				
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }

     public function oldexbook()
     {
               if($this->session->userdata('logged_in'))
           {

                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
                $this->load->view('reCopy',$data);
                
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }

     public function unitAction()
     {
               if($this->session->userdata('logged_in'))
           {

                $data = $this->session->userdata('logged_in');
                $data['bookin'] = $this->book->get_unitaction();
                $this->load->view('unitAction',$data);
                
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }

     public function backexbook()
     {
               if($this->session->userdata('logged_in'))
           {

                $data = $this->session->userdata('logged_in');
                $data['reCome_sen'] = "";
                $this->load->view('reCome',$data);
                
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }
	   public function backexbook_send()
     {
               if($this->session->userdata('logged_in'))
           {
                $data = $this->session->userdata('logged_in');
                $data['reCome_sen'] = $this->book->get_reCome_send();
                $this->load->view('reCome',$data);
                
            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }


	   public function relist3()
     {
               if($this->session->userdata('logged_in'))
               {
				
                $data = $this->session->userdata('logged_in');
                $data['relist3_bookTB_null'] = $this->book->get_relist3_null();
				$data['relist3_bookTB'] = $this->book->get_relist3();
                $this->load->view('relist3',$data);
                
               }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }
	  
	   public function search()
     {

		    
               if($this->session->userdata('logged_in'))
               {
				
                $data = $this->session->userdata('logged_in');
         
                $this->load->view('search',$data);
                
               }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }

	      public function send_search()
     {


				 $data = $this->session->userdata('logged_in');
				 $data['bookin'] = $this->book->get_search();
			     $this->load->view('searchPro',$data);
				  
	 }
	


   
    public function outinbook_in_newid()
     {


               if($this->session->userdata('logged_in'))
           {

                   if($this->input->post("mess1")!=null)
                  {

$this->db->distinct();
$this->db->select('inid');
$this->db->order_by("inid","ASC");
$temp = $this->db->get_where('booktb', array('send'=>'N','secret'=>$this->input->post("mess3"),'years'=>mdate("%Y",now()),'unit'=>$this->session->userdata('logged_in')["username"]));
                    $Booktb_id_update = $this->input->post("bookID");
				    $arBooktb=array(
                      "send"=>"N",
                      "inid"=>"",
                      "speed"=>$this->input->post("mess1"),
                      "bookType"=>$this->input->post("mess2"),
                      "secret"=>$this->input->post("mess3"),
                      "id"=>$this->input->post("mess5"),
                      "author"=>$this->input->post("mess6"),
                      "days"=>$this->input->post("example1"),
                      "subject"=>$this->input->post("mess8"),
                      "beginword"=>$this->input->post("mess9")
                      );
                      
				      $this->db->where('bookID', $Booktb_id_update);
				      $this->db->update('booktb',$arBooktb);
				

					  	//------------------------------------ insert ActionTB------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arActionTB=array(
                      "bookID"=>$arbookID,
                      "Status"=>$this->session->userdata('logged_in')['username'],
                                       );
					  $this->db->where('actionID', $Booktb_id_update."".$logged_in);
				      $this->db->update('ActionTB',$arActionTB);
					 
				   


                      //------------------------------------ insert ReUnit------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arReUnit=array(
                      "bookID"=>$arbookID,
                      "unit"=>$this->input->post("mess4"),
                        );
					  $this->db->where('bookID', $Booktb_id_update);
				      $this->db->update('ReUnit',$arReUnit);


  //-------------------------------------  insert TransactionTB--------------------------------


                      $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
								//  $arUnit =$row_unit->unit;
                                 }

					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arTransactionTB=array(
                      "bookID"=>$arbookID,
                      "Actions"=>"ออกหนังสือ",
					  "acUnit"=>$this->input->post("mess4"),
					  "trandate"=>now(),
                        );
					  $this->db->where('bookID', $Booktb_id_update);
				      $this->db->update('TransactionTB',$arTransactionTB);

                      $arActiontb=array();
                      $arTransactiontb=array(
                      "acUnit"=>$this->input->post("mess4")
                      );
                    $arReunit=array(
                      );

                    
                   

                   redirect("mainPage/main","refresh");
                    exit();
                  }

                
				

                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
                $data['rs'] = $this->book->get_division();
				$data['inout'] = "in";
				$data['bookmain_bookID'] = $_POST["bookmain_bookID"];
				$data['bookmain_secret'] = $_POST["bookmain_secret"];
				$data['bookmain_speed'] = $_POST["bookmain_speed"];
				$data['bookmain_bookType'] = $_POST["bookmain_bookType"];
				$data['bookmain_id'] = $_POST["bookmain_id"];
				$data['bookmain_author'] = $_POST["bookmain_author"];
				$data['bookmain_days'] = $_POST["bookmain_days"];
				$data['bookmain_subject'] = $_POST["bookmain_subject"];
				$data['bookmain_beginword'] = $_POST["bookmain_beginword"];
                $this->load->view('makenew',$data);

            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }

     public function outinbook_in()
     {


               if($this->session->userdata('logged_in'))
           {

                   if($this->input->post("mess1")!=null)
                  {

$this->db->distinct();
$this->db->select('inid');
$this->db->order_by("inid","ASC");
$temp = $this->db->get_where('booktb', array('send'=>'N','secret'=>$this->input->post("mess3"),'years'=>mdate("%Y",now()),'unit'=>$this->session->userdata('logged_in')["username"]));
                    

					  $days_yesr = $this->input->post("example1");
					  $day=substr($days_yesr,0,2);
					  $month=substr($days_yesr,3,2);
					  $year=substr($days_yesr,6,8);
					  $days= $year."-".$month."-".$day;

				    $arBooktb=array(
                      "send"=>"N",
                      "inid"=>"",
                      "speed"=>$this->input->post("mess1"),
                      "bookType"=>$this->input->post("mess2"),
                      "secret"=>$this->input->post("mess3"),
                      "id"=>$this->input->post("mess5"),
                      "author"=>$this->input->post("mess6"),
                      "days"=>$days,
                      "subject"=>$this->input->post("mess8"),
                      "beginword"=>$this->input->post("mess9")
                      );

					  $this->db->insert('booktb',$arBooktb);

					  	//------------------------------------ insert ActionTB------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arActionTB=array(
                      "actionID"=>$arbookID."".$logged_in,
                      "bookID"=>$arbookID,
                      "Status"=>$this->session->userdata('logged_in')['username'],
                        );										
				      $this->db->insert('ActionTB',$arActionTB);


                       //------------------------------------ insert ReUnit------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arReUnit=array(
                      "bookID"=>$arbookID,
                      "unit"=>$this->input->post("mess4"),
                        );										
				      $this->db->insert('ReUnit',$arReUnit);


                      //-------------------------------------  insert TransactionTB--------------------------------


                      $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
								//  $arUnit =$row_unit->unit;
                                 }

					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arTransactionTB=array(
                      "bookID"=>$arbookID,
                      "Actions"=>"ออกหนังสือ",
					  "acUnit"=>$this->input->post("mess4"),
					  "trandate"=>now(),
                        );										
				      $this->db->insert('TransactionTB',$arTransactionTB);


                    $arActiontb=array();
                    $arTransactiontb=array(
                      "acUnit"=>$this->input->post("mess4")
                      );
                    $arReunit=array(
                      );

                    
                   

                   redirect("mainPage/main","refresh");
                    exit();
                  }
				


                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
                $data['rs'] = $this->book->get_division();
				$data['inout'] = "in";
				$data['bookmain_bookID']    = "";
				$data['bookmain_secret']    = "";
				$data['bookmain_speed']     = "";
				$data['bookmain_bookType']  = "";
				$data['bookmain_id']        = "";
				$data['bookmain_author']    = "";
				$data['bookmain_days']      = "";
				$data['bookmain_subject']   = "";
				$data['bookmain_beginword'] = ""; 
               
                $this->load->view('makenew',$data);

            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }


     public function outinbook_out()
     {


               if($this->session->userdata('logged_in'))
           {

                   if($this->input->post("mess1")!=null)
                  {

$this->db->distinct();
$this->db->select('inid');
$this->db->order_by("inid","ASC");
$temp = $this->db->get_where('booktb', array('send'=>'N','secret'=>$this->input->post("mess3"),'years'=>mdate("%Y",now()),'unit'=>$this->session->userdata('logged_in')["username"]));
                   
				    $arBooktb=array(
                      "send"=>"N",
                      "inid"=>"",
                      "speed"=>$this->input->post("mess1"),
                      "bookType"=>$this->input->post("mess2"),
                      "secret"=>$this->input->post("mess3"),
                      "id"=>$this->input->post("mess5"),
                      "author"=>$this->input->post("mess6"),
                      "days"=>$this->input->post("example1"),
                      "subject"=>$this->input->post("mess8"),
                      "beginword"=>$this->input->post("mess9")
                      );

					  $this->db->insert('booktb',$arBooktb);

					  	//------------------------------------ insert ActionTB------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arActionTB=array(
                      "actionID"=>$arbookID."".$logged_in,
                      "bookID"=>$arbookID,
                      "Status"=>$this->session->userdata('logged_in')['username'],
                        );										
				      $this->db->insert('ActionTB',$arActionTB);


//------------------------------------ insert ReUnit------------------------------------------

					  $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
                                 }
					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arReUnit=array(
                      "bookID"=>$arbookID,
                      "unit"=>$this->input->post("mess4"),
                        );										
				      $this->db->insert('ReUnit',$arReUnit);


  //-------------------------------------  insert TransactionTB--------------------------------


                      $query = $this->db->query("SELECT * FROM bookTB");
                      foreach ($query->result() as $row_unit)
                                 {
                                  $arbookID =$row_unit->bookID;
								//  $arUnit =$row_unit->unit;
                                 }

					  $logged_in	= $this->session->userdata('logged_in')['username'];
					  $arTransactionTB=array(
                      "bookID"=>$arbookID,
                      "Actions"=>"ออกหนังสือ",
					  "acUnit"=>$this->input->post("mess4"),
					  "trandate"=>now(),
                        );										
				      $this->db->insert('TransactionTB',$arTransactionTB);


                    $arActiontb=array();
                    $arTransactiontb=array(
                      "acUnit"=>$this->input->post("mess4")
                      );
                    $arReunit=array(
                      );

                    
                   

                   redirect("mainPage/main","refresh");
                    exit();
                  }

                $data = $this->session->userdata('logged_in');
                //$data['bookin'] = $this->book->get_book();
				$data['bookmain_bookID']    = "";
				$data['bookmain_secret']    = "";
				$data['bookmain_speed']     = "";
				$data['bookmain_bookType']  = "";
				$data['bookmain_id']        = "";
				$data['bookmain_author']    = "";
				$data['bookmain_days']      = "";
				$data['bookmain_subject']   = "";
				$data['bookmain_beginword'] = ""; 
                $data['rs'] = $this->book->get_division();
				$data['inout'] = "out";
                $this->load->view('makenew',$data);

            }
            else
               {
                //If no session, redirect to login page
                redirect('mainPage', 'refresh');
               }
      }


     public function logout()
     {
     $this->session->unset_userdata('logged_in');
     session_destroy();
     redirect('mainPage', 'refresh');
     }


}


