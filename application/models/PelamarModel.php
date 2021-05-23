<?php
class PelamarModel extends CI_Model {

    public function KelengkapanData()
    {
      	$sesi = $this->session->userdata('sesi');
    		$cek_datadiri = $this->db->select('nama, nik, tgl_lahir, tmp_lahir, no_hp, gender, alamat')
                        ->from('pelamar')
                        ->where('id_user', $sesi['id_user'])
                        ->get()->row_array();
        $val_datadiri = array_values($cek_datadiri);
        $lenght_datadiri = count(array_values($cek_datadiri));
       	$datadiri = 1;
       	for($i = 0; $i<$lenght_datadiri; $i++)
       	{	

       		if($val_datadiri[$i]==NULL || $val_datadiri[$i]=="")
       		{
       			$datadiri = 0;
       		}
       	}

       	$w_pendFormal = ['id_user'=>$sesi['id_user'], 'jenis_pend'=>'Formal'];
       	// $w_pendNonFormal = ['id_user'=>$sesi['id_user'], 'jenis_pend'=>'Non'];
       	$pend = 1;
       	$cek_pendidikan = $this->db->get_where('pendidikan',$w_pendFormal);
       	if($cek_pendidikan->num_rows()==1)
       	{
       		
       		$val_pend = array_values($cek_pendidikan->row_array());

       		for($i = 0; $i< count($val_pend); $i++)
	       	{	

	       		if($val_pend[$i]==NULL || $val_pend[$i]=="")
	       		{
	       			$pend = 0;
	       		}
	       	}

       	}
       	if($cek_pendidikan->num_rows()==0)
       	{
       		$pend = 0;
       	}
       	if($cek_pendidikan->num_rows()>1)
       	{
       		$pend = 1;
       	}
       	// =======================
       	$pekerjaan = 1;
       	$w_pekerjaan = ['id_user'=>$sesi['id_user']];
       	$cek_pekerjaan = $this->db->get_where('riwayat_kerja', $w_pekerjaan);
       	if($cek_pekerjaan->num_rows()==1)
       	{
       		$val_peker = array_values($cek_pekerjaan->row_array());
       		for($i = 0; $i< count($val_peker); $i++)
	       	{	

	       		if($val_peker[$i]==NULL || $val_peker[$i]=="")
	       		{
	       			$pekerjaan = 0;
	       		}
	       	}
       	}
       	if($cek_pekerjaan->num_rows()==0)
       	{
       		$pekerjaan = 0;
       	}
       	if($cek_pekerjaan->num_rows()>1)
       	{
       		$pekerjaan = 1;
       	}

        // cek upload
        // $sesi = $this->session->userdata('sesi');
        $cek_upload = $this->db->select('img_ijasah, img_ktp, img_cv')
                        ->from('pelamar')
                        ->where('id_user', $sesi['id_user'])
                        ->get()->row_array();
        $val_upload = array_values($cek_upload);
        $lenght_upload = count(array_values($cek_upload));
        $upload = 1;
        for($i = 0; $i<$lenght_upload; $i++)
        { 

          if($val_upload[$i]==NULL || $val_upload[$i]=="")
          {
            $upload = 0;
          }
        }

       	return [
       		'datadiri' 		=> $datadiri,
       		'pendidikan'	=> $pend,
       		'pekerjaan'		=> $pekerjaan,
          'upload'      => $upload
       	];
    }


    public function KelengkapanDataAdmin($id)
    {
        $sesi['id_user'] = $id;
        $cek_datadiri = $this->db->select('nama, nik, tgl_lahir, tmp_lahir, no_hp, gender, alamat')
                        ->from('pelamar')
                        ->where('id_user', $sesi['id_user'])
                        ->get()->row_array();
        $val_datadiri = array_values($cek_datadiri);
        $lenght_datadiri = count(array_values($cek_datadiri));
        $datadiri = 1;
        for($i = 0; $i<$lenght_datadiri; $i++)
        { 

          if($val_datadiri[$i]==NULL || $val_datadiri[$i]=="")
          {
            $datadiri = 0;
          }
        }

        $w_pendFormal = ['id_user'=>$sesi['id_user'], 'jenis_pend'=>'Formal'];
        // $w_pendNonFormal = ['id_user'=>$sesi['id_user'], 'jenis_pend'=>'Non'];
        $pend = 1;
        $cek_pendidikan = $this->db->get_where('pendidikan',$w_pendFormal);
        if($cek_pendidikan->num_rows()==1)
        {
          
          $val_pend = array_values($cek_pendidikan->row_array());

          for($i = 0; $i< count($val_pend); $i++)
          { 

            if($val_pend[$i]==NULL || $val_pend[$i]=="")
            {
              $pend = 0;
            }
          }

        }
        if($cek_pendidikan->num_rows()==0)
        {
          $pend = 0;
        }
        if($cek_pendidikan->num_rows()>1)
        {
          $pend = 1;
        }
        // =======================
        $pekerjaan = 1;
        $w_pekerjaan = ['id_user'=>$sesi['id_user']];
        $cek_pekerjaan = $this->db->get_where('riwayat_kerja', $w_pekerjaan);
        if($cek_pekerjaan->num_rows()==1)
        {
          $val_peker = array_values($cek_pekerjaan->row_array());
          for($i = 0; $i< count($val_peker); $i++)
          { 

            if($val_peker[$i]==NULL || $val_peker[$i]=="")
            {
              $pekerjaan = 0;
            }
          }
        }
        if($cek_pekerjaan->num_rows()==0)
        {
          $pekerjaan = 0;
        }
        if($cek_pekerjaan->num_rows()>1)
        {
          $pekerjaan = 1;
        }

        // cek upload
        // $sesi = $this->session->userdata('sesi');
        $cek_upload = $this->db->select('img_ijasah, img_ktp, img_cv')
                        ->from('pelamar')
                        ->where('id_user', $sesi['id_user'])
                        ->get()->row_array();
        $val_upload = array_values($cek_upload);
        $lenght_upload = count(array_values($cek_upload));
        $upload = 1;
        for($i = 0; $i<$lenght_upload; $i++)
        { 

          if($val_upload[$i]==NULL || $val_upload[$i]=="")
          {
            $upload = 0;
          }
        }

        return [
          'datadiri'    => $datadiri,
          'pendidikan'  => $pend,
          'pekerjaan'   => $pekerjaan,
          'upload'      => $upload
        ];
    }

    public function insertID($id)
    {
    	$data = [ 'id_user'=>$id ];
    	$cek = $this->db->insert('pelamar',$data);
    	$cek = $this->db->insert('riwayat_kerja',$data);
    	$cek = $this->db->insert('pendidikan',$data);
    	return $cek;
    }

}