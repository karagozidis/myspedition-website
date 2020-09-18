<?php
class User {
	private $user_id;
	private $username;
  	private $permission = array();

  	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');
		
    	if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");
			
			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->username = $user_query->row['username'];
				
      			$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

      			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
				
	  			$permissions = unserialize($user_group_query->row['permission']);

				if (is_array($permissions)) {
	  				foreach ($permissions as $key => $value) {
	    				$this->permission[$key] = $value;
	  				}
				}
			} else {
				$this->logout();
			}
    	}
  	}
		
  	public function login($username, $password) {
    	$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

    	if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];
			
			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['username'];			

      		$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

	  		$permissions = unserialize($user_group_query->row['permission']);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}
		
      		return true;
    	} else {
      		return false;
    	}
  	}

  	public function logout() {
		unset($this->session->data['user_id']);
	
		$this->user_id = '';
		$this->username = '';
		
		session_destroy();
  	}

  	public function hasPermission($key, $value) {
    	if (isset($this->permission[$key])) {
	  		return in_array($value, $this->permission[$key]);
		} else {
	  		return false;
		}
  	}
  
  	public function isLogged() {
    	return $this->user_id;
  	}
  
  	public function getId() {
    	return $this->user_id;
  	}
	
  	public function getUserName() {
    	return $this->username;
  	}	
        
        
        public function viewOriginalData()
            {
             $query = $this->db->query(
                    " SELECT view_original_data FROM " . DB_PREFIX . "user_group ".
                    " INNER JOIN ". DB_PREFIX . "user ".
                    " ON " . DB_PREFIX . "user_group.user_group_id = ". DB_PREFIX . "user.user_group_id ".
                    " WHERE user_id = '" . (int) $this->user_id . "'"
                     );  

             return $query->row['view_original_data'];
            }
        
        public function generateMail()
            {
            $word = "";
            $abc = "abcdefghijklmnopqrstuvwxyz";
            $abcC= "aehiouy"; //7
            $abcV= "bcdfgjklmnpqrstvwxz"; // 19

            $mail_abc[0] = "@mail.ru";
            $mail_abc[1] = "@hotmail.com";
            $mail_abc[2] = "akballojistik.com.tr";
            $mail_abc[3] = "@access-transport.com";
            $mail_abc[4] = "@adif-transport.it";
            $mail_abc[5] = "@orionlogistics.ro";
            $mail_abc[6] = "@frigo-transport.com";
            $mail_abc[7] = "@agromilk.by";
            $mail_abc[8] = "@ttm-tunisia.com";
            $mail_abc[9] = "@artgroup.com.pk";
            $mail_abc[10] = "@fatihnakliyat.com.tr";
            $mail_abc[11] = "@yilmaztransport.net";
            $mail_abc[12] = "@urenakliyat.com";
            $mail_abc[13] = "@asguler.com.tr";
            $mail_abc[14] = "@kitex.lv";
            $mail_abc[15] = "@inbox.lv";
            $mail_abc[16] = "@yahoo.com";
            $mail_abc[17] = "@emex-energy.de";
            $mail_abc[18] = "@yandex.ru";
            $mail_abc[19] = "@abv.bg";
            $mail_abc[20] = "@techtrans-gmbh.eu";
            $mail_abc[21] = "@abcshipping-bg.com";
            $mail_abc[22] = "@grlight.ru";
            $mail_abc[23] = "@intelstride.by";
            $mail_abc[24] = "@interzag.com";
            $mail_abc[25] = "@mail.ru";
            $mail_abc[26] = "@akgulnakliyat.org";
            $mail_abc[27] = "@onemlojistik.com";
            $mail_abc[28] = "@hotmail.com";
            $mail_abc[29] = "@mail.ru";
            $mail_abc[30] = "@rokelshipping.co.uk";
            $mail_abc[31] = "@vatlojistik.com";
            $mail_abc[32] = "@aol.com";
            $mail_abc[33] = "@nashedelo.by";
            $mail_abc[34] = "@mt.net.mk";
            $mail_abc[35] = "@tradelogbrazil.com";
            $mail_abc[36] = "@perrakis.eu";
            $mail_abc[37] = "@gmail.com";
            $mail_abc[38] = "@tsschmidt.de";
            $mail_abc[39] = "@garanta.kz";


            $randomWordLength = rand(4, 10);

            $cv = 0 ;

            for($i =0 ; $i < $randomWordLength; $i++ )
                {

                if( $cv == 0)
                    {
                    $randomNumberForChar = rand(0, 6);
                    $randomChar = substr($abcC,$randomNumberForChar,1 );
                    $cv = 1;
                    }
                else 
                    {
                    $randomNumberForChar = rand(0, 18);
                    $randomChar = substr($abcV,$randomNumberForChar,1 );
                    $cv = 0;
                    }
                $word .=$randomChar;
                }


                $randomNumberForMailPrefix = rand(0, 39);
                $randomMailPrefix = $mail_abc[$randomNumberForMailPrefix]; 
                $word .= $randomMailPrefix;
                //echo $word;
                return $word;
            } 
        
        
          public function generateTelephone()
            {
            $word = "+";

            $randomWordLength = rand(4, 10);

            $randomNumberForChar = rand(2, 9);
            $word .=$randomNumberForChar;

            for($i =0 ; $i < 3; $i++ )
                {
                $randomNumberForChar = rand(0, 9);
                $word .=$randomNumberForChar;
                }

                $word .= " ";

                $randomNumberForChar = rand(2, 9);
                $word .=$randomNumberForChar;
            for($i =0 ; $i < 5; $i++ )
                {
                $randomNumberForChar = rand(1, 9);
                $word .=$randomNumberForChar;
                }
                //echo $word;
                return $word;
            } 
            
}
?>