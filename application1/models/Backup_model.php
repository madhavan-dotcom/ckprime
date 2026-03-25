<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup_model extends CI_Model {

			function create_backup($type)
	{
		
			$this->load->dbutil();

           $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'backup.sql'
              );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'.date('Y-m-d').'.zip';
		 

		$this->load->helper('download');
        force_download($db_name, $backup);
	}

	function create_Yearbackup($type)
	{
		
		$this->load->dbutil();

           $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'backup_'.date('Y-m-d H_i_s').'.sql'
              );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'.date('Y-m-d').'.zip';
		 

		$this->load->helper('download');
        //force_download($db_name, $backup);
		write_file(FCPATH.'db_backup/mybackup_'.date('Y-m-d H_i_s').'.sql', $backup); 
	}
	function saveuser_url($type)
	{
		
		$this->load->dbutil();

           $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'backup_'.date('Y-m-d H_i_s').'.sql'
              );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'.date('Y-m-d').'.zip';
		 

		$this->load->helper('download');
        //force_download($db_name, $backup);
		write_file($type.'/mybackup_'.date('Y-m-d H_i_s').'.zip', $backup); 
	}
	      
}