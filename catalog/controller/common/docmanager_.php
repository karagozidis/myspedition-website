<?php
class ControllerCommonDocManager extends Controller {
	private $error = array();
//	public $subfolder ='company_1/'; //'company_1/';       
        
	public function index() {
                   
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
               // if (isset($this->request->get['subf']))
               //  $this->subfolder = $this->request->get['subf'] . '/';
                   
               // $this->subfolder = 'company_1/';
               // echo $this->customer->getId();
		$this->language->load('common/filemanager');
		
		$this->data['title'] = $this->language->get('heading_title');
		
               // echo 'DIR_IMAGE' . DIR_IMAGE ; 
               // echo '<br>HTTP_SERVER ' . HTTP_SERVER;
               // echo '<br>HTTPS_SERVER ' . HTTPS_SERVER;
                
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {		
               // echo 'HTTPS_SERVER: ' . HTTPS_SERVER;	
               // echo '<br> HTTP_SERVER: ' . HTTP_SERVER;            
                    $this->data['base'] = HTTPS_SERVER;
		} else {
               // echo HTTP_SERVER;
			$this->data['base'] = HTTP_SERVER;
		}
		                
		$this->data['entry_folder'] = $this->language->get('entry_folder');
		$this->data['entry_move'] = $this->language->get('entry_move');
		$this->data['entry_copy'] = $this->language->get('entry_copy');
		$this->data['entry_rename'] = $this->language->get('entry_rename');
		
		$this->data['button_folder'] = $this->language->get('button_folder');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_move'] = $this->language->get('button_move');
		$this->data['button_copy'] = $this->language->get('button_copy');
		$this->data['button_rename'] = $this->language->get('button_rename');
		$this->data['button_upload'] = $this->language->get('button_upload');
		$this->data['button_refresh'] = $this->language->get('button_refresh');
		$this->data['button_submit'] = $this->language->get('button_submit'); 
		
		$this->data['error_select'] = $this->language->get('error_select');
		$this->data['error_directory'] = $this->language->get('error_directory');
		
		//$this->data['token'] = '' ;// $this->session->data['token'];
		//$this->data['directory'] = HTTP_CATALOG . 'image/data/';
                $this->data['directory'] = '';//'myspedition/image/data/';
                
				
		$this->load->model('tool/image');

		$this->data['no_image'] = $this->model_tool_image->resize('doc.png', 100, 100);
		
		if (isset($this->request->get['field'])) {
			$this->data['field'] = $this->request->get['field'];
		} else {
			$this->data['field'] = '';
		}
		
		if (isset($this->request->get['CKEditorFuncNum'])) {
			$this->data['fckeditor'] = $this->request->get['CKEditorFuncNum'];
		} else {
			$this->data['fckeditor'] = false;
		}
		
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/docmanager.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/docmanager.tpl';
		} else {
			$this->template = 'default/template/common/docmanager.tpl';
		}
		//$this->template = 'common/docmanager.tpl';
		$this->response->setOutput($this->render());
	}	
	
	public function image() {
            
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
		$this->load->model('tool/image');
		
		if (isset($this->request->get['image'])) {
			$this->response->setOutput(
                               $this->model_tool_image->resize('doc.png', 100, 100)
                               // $this->model_tool_image->resize(html_entity_decode($this->request->get['image'], ENT_QUOTES, 'UTF-8'), 100, 100)
                                );
		}
	}
	
	public function directory() {	
	
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
                $json = array();
 
                 if (isset($this->request->get['subf']))
                           $this->subfolder = $this->request->get['subf'] . '/';
                 
		if (isset($this->request->post['directory'])) {
			$directories = glob(rtrim(DIR_IMAGE . 'docs/' . 'company_'.$this->customer->getId().'/' . str_replace('../', '', $this->request->post['directory']), '/') . '/*', GLOB_ONLYDIR); 
			
			if ($directories) {
				$i = 0;
			
				foreach ($directories as $directory) {
					$json[$i]['data'] = basename($directory);
					$json[$i]['attributes']['directory'] = utf8_substr($directory, strlen(DIR_IMAGE . 'docs/'  . 'company_'.$this->customer->getId().'/'));
					
					$children = glob(rtrim($directory, '/') . '/*', GLOB_ONLYDIR);
					
					if ($children)  {
						$json[$i]['children'] = ' ';
					}
					
					$i++;
				}
			}		
		}
		
		$this->response->setOutput(json_encode($json));	
	}
	
	public function files() {
                
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
		 $json = array();
                 
                  if (isset($this->request->get['subf']))
                           $this->subfolder = $this->request->get['subf'] . '/';
                 
		if (!empty($this->request->post['directory'])) {
			$directory = DIR_IMAGE . 'docs/' . 'company_'.$this->customer->getId().'/'. str_replace('../', '', $this->request->post['directory']);
		} else {
			$directory = DIR_IMAGE . 'docs/'  . 'company_'.$this->customer->getId().'/' ;
		}
		
		$allowed = array(                
                        '.docm',
                        '.docx',
                        '.dotx',
                        '.xlam',
                        '.doc',

                        '.xlsx',
                        '.xlsm',
                        '.xltx',
                        '.xltm',
                        '.xlsb',
                        '.xlam',
                        '.xls',

                        '.pdf',

                        '.jpg',
                        '.jpeg',
                        '.gif',
                        '.png',
                        '.gif'
		);
		
		$files = glob(rtrim($directory, '/') . '/*');
		
		if ($files) {
			foreach ($files as $file) {
				if (is_file($file)) {
					$ext = strrchr($file, '.');
				} else {
					$ext = '';
				}	
				
				if (in_array(strtolower($ext), $allowed)) {
					$size = filesize($file);
		
					$i = 0;
		
					$suffix = array(
						'B',
						'KB',
						'MB',
						'GB',
						'TB',
						'PB',
						'EB',
						'ZB',
						'YB'
					);
		
					while (($size / 1024) > 1) {
						$size = $size / 1024;
						$i++;
					}
						
					$json[] = array(
						'filename' => basename($file),
						'file'     => utf8_substr($file, utf8_strlen(DIR_IMAGE . 'data/')),
						'size'     => round(utf8_substr($size, 0, utf8_strpos($size, '.') + 4), 2) . $suffix[$i]
					);
				}
			}
		}
		
		$this->response->setOutput(json_encode($json));	
	}	
	
	public function create() {
            
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
		/*$this->language->load('common/filemanager');
				
		$json = array();
		
		if (isset($this->request->post['directory'])) {
			if (isset($this->request->post['name']) || $this->request->post['name']) {
				$directory = rtrim(DIR_IMAGE . 'docs/' . 'company_'.$this->customer->getId().'/' . str_replace('../', '', $this->request->post['directory']), '/');							   
				
				if (!is_dir($directory)) {
					$json['error'] = $this->language->get('error_directory');
				}
				
				if (file_exists($directory . '/' . str_replace('../', '', $this->request->post['name']))) {
					$json['error'] = $this->language->get('error_exists');
				}
			} else {
				$json['error'] = $this->language->get('error_name');
			}
		} else {
			$json['error'] = $this->language->get('error_directory');
		}
		
		if (!isset($json['error'])) {	
			mkdir($directory . '/' . str_replace('../', '', $this->request->post['name']), 0777);
			
			$json['success'] = $this->language->get('text_create');
		}	
		
		$this->response->setOutput(json_encode($json)); */
	}
	
        
	public function delete() {
            
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
		$this->language->load('common/filemanager');
		
		$json = array();
		
		if (isset($this->request->post['path'])) {
                        $path = rtrim(DIR_IMAGE . 'data/'  . str_replace('../', '', html_entity_decode($this->request->post['path'], ENT_QUOTES, 'UTF-8')), '/');
	               
                        $usrPath = str_replace('../', '', html_entity_decode($this->request->post['path'], ENT_QUOTES, 'UTF-8')) ; 
                        $reqFolder =  'company_'.$this->customer->getId() . "/" ;
                        $reqFolderLength = strlen ( $reqFolder );
                        $usrFolder = substr($usrPath, 0 , $reqFolderLength );  
                       
                        if( $usrFolder != $reqFolder )  {
                                $json['error'] = $this->language->get('error_delete');
                        }
                        
                        
                        
			if (!file_exists($path)) {
				$json['error'] = $path; $this->language->get('error_select');
			}
			
			if ($path == rtrim(DIR_IMAGE . 'docs/'. 'company_'.$this->customer->getId().'/' , '/')) {
				$json['error'] =  $this->language->get('error_delete');
			}
		} else {
			$json['error'] =  $this->language->get('error_select');
		} 
		
		
		if (!isset($json['error'])) {
			if (is_file($path)) {
				unlink($path);
			} elseif (is_dir($path)) {
				$files = array();
				
				$path = array($path . '*');
				
				while(count($path) != 0) {
					$next = array_shift($path);
			
					foreach(glob($next) as $file) {
						if (is_dir($file)) {
							$path[] = $file . '/*';
						}
						
						$files[] = $file;
					}
				}
				
				rsort($files);
				
				foreach ($files as $file) {
					if (is_file($file)) {
						unlink($file);
					} elseif(is_dir($file)) {
						rmdir($file);	
					} 
				}				
			}
			
			$json['success'] = $this->language->get('text_delete');
		}				
		
		$this->response->setOutput(json_encode($json));
	}
     
	

	function recursiveCopy($source, $destination) { 
            
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
		$directory = opendir($source); 
		
		@mkdir($destination); 
		
		while (false !== ($file = readdir($directory))) {
			if (($file != '.') && ($file != '..')) { 
				if (is_dir($source . '/' . $file)) { 
					$this->recursiveCopy($source . '/' . $file, $destination . '/' . $file); 
				} else { 
					copy($source . '/' . $file, $destination . '/' . $file); 
				} 
			} 
		} 
		
		closedir($directory); 
	} 

	public function folders() {
		//$this->response->setOutput($this->recursiveFolders(DIR_IMAGE . 'data/'));	
	}
	
	protected function recursiveFolders($directory) {
            
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
		$output = '';
		
		$output .= '<option value="' . utf8_substr($directory, strlen(DIR_IMAGE . 'docs/' . 'company_'.$this->customer->getId().'/' )) . '">' . utf8_substr($directory, strlen(DIR_IMAGE . 'data/')) . '</option>';
		
		$directories = glob(rtrim(str_replace('../', '', $directory), '/') . '/*', GLOB_ONLYDIR);
		
		foreach ($directories  as $directory) {
			$output .= $this->recursiveFolders($directory);
		}
		
		return $output;
	}
	
	
	public function upload() {
            
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
		$this->language->load('common/filemanager');
                $json = array();
                
             //  $this->load->model('customer/customer_group');
              //  $customer_group = $this->model_customer_customer_group->getCustomerGroupByCustomerId( $this->customer->getId() );
                
                $dir = rtrim(DIR_IMAGE . 'data/'. 'company_docs_'.$this->customer->getId().'/'  . str_replace('../', '', $this->request->post['directory']), '/');
             
                $dir .="/";
                    if(is_dir($dir)) {
                        $images = glob($dir."*.*");
                        $total =  count($images) ;
                    }

                if ( $total >= $customer_group['photo_album_number'] ) {       
                     $json['error']  = "This account supports max  ".$customer_group['photo_album_number']. " photos.";
                     $this->response->setOutput(json_encode($json));
                    }         
  
		 if (isset($this->request->post['directory'])) {
			if (isset($this->request->files['image']) && $this->request->files['image']['tmp_name']) {
				$filename = basename(html_entity_decode($this->request->files['image']['name'], ENT_QUOTES, 'UTF-8'));
				
				if ((strlen($filename) < 3) || (strlen($filename) > 255)) {
					$json['error'] = $this->language->get('error_filename');
				}
					
				$directory = rtrim(DIR_IMAGE . 'docs/'. 'company_'.$this->customer->getId().'/'  . str_replace('../', '', $this->request->post['directory']), '/');
				
				if (!is_dir($directory)) {
					$json['error'] = $this->language->get('error_directory');
				}
				
				if ($this->request->files['image']['size'] > 300000) {
					$json['error'] = $this->language->get('error_file_size');
				}
                                
				/*
				$allowed = array(
					'image/docm', //word
					'image/dotx',
					'image/xlam',
                                        'image/doc',
                                    
                                        'image/xlsx', //excel
					'image/xlsm',
					'image/xltx',
					'image/xltm',
                                        'image/xlsb',
					'image/xlam',
                                        'image/xls',
                                    
					'image/pdf',
                                    
					'image/jpeg',
					'image/pjpeg',
					'image/png',
					'image/x-png',
					'image/gif'//,
					//'application/x-shockwave-flash'
				);
						
				if (!in_array($this->request->files['image']['type'], $allowed)) {
					$json['error'] = $this->request->files['image']['type'];// $this->language->get('error_file_type');
				}
                                */
				
				$allowed = array(
                                        '.docm',
                                        '.docx',
					'.dotx',
					'.xlam',
					'.doc',
                                    
                                        '.xlsx',
					'.xlsm',
					'.xltx',
					'.xltm',
                                        '.xlsb',
					'.xlam',
					'.xls',
                                    
					'.pdf',
                                    
					'.jpg',
					'.jpeg',
					'.gif',
					'.png',
                                        '.gif'
				); 
						
				if (!in_array(strtolower(strrchr($filename, '.')), $allowed)) {
					$json['error'] = $this->language->get('error_file_type');
				}

				if ($this->request->files['image']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = 'error_upload_' . $this->request->files['image']['error'];
				}			
			} else {
				$json['error'] = $this->language->get('error_file');
			}
		} else {
			$json['error'] = $this->language->get('error_directory');
		} 
		
		
		if (!isset($json['error'])) {	
			if (@move_uploaded_file($this->request->files['image']['tmp_name'], $directory . '/' . $filename)) {		
				$json['success'] = $this->language->get('text_uploaded');
			} else {
				$json['error'] = $this->language->get('error_uploaded');
			}
		}
		$this->response->setOutput(json_encode($json));
	}
        
        
        
        public function upload_docs() {
            
                if (!$this->customer->isLogged() || !is_numeric($this->customer->getId()) ) { 
                                $this->redirect($this->url->link('filemanager/upgrade', '', 'SSL')); 
                }
                
		$this->language->load('common/filemanager');
                
                $json = array();
                
                
                $this->load->model('customer/customer_group');
                $customer_group = $this->model_customer_customer_group->getCustomerGroupByCustomerId( $this->customer->getId() );
                
                $dir = rtrim(DIR_IMAGE . 'docs/'. 'company_'.$this->customer->getId().'/'  . str_replace('../', '', $this->request->post['directory']), '/');
             
                $dir .="/";
                    if(is_dir($dir)) {
                        $images = glob($dir."*.*");
                        $total =  count($images) ;
                    }

                if ( $total >= $customer_group['photo_album_number'] ) {        
                     $json['error']  = "This account supports max  ".$customer_group['photo_album_number']. " photos.";
                     $this->response->setOutput(json_encode($json));
                    }         
                  
               
                    
		 if (isset($this->request->post['directory'])) {
			if (isset($this->request->files['image']) && $this->request->files['image']['tmp_name']) {
				$filename = basename(html_entity_decode($this->request->files['image']['name'], ENT_QUOTES, 'UTF-8'));
				
				if ((strlen($filename) < 3) || (strlen($filename) > 255)) {
					$json['error'] = $this->language->get('error_filename');
				}
					
				$directory = rtrim(DIR_IMAGE . 'docs/'. 'company_'.$this->customer->getId().'/'  . str_replace('../', '', $this->request->post['directory']), '/');
				
				if (!is_dir($directory)) {
					$json['error'] = $this->language->get('error_directory');
				}
				
				if ($this->request->files['image']['size'] > 300000) {
					$json['error'] = $this->language->get('error_file_size');
				}
				
				$allowed = array(
					'image/jpeg',
					'image/pjpeg',
					'image/png',
					'image/x-png',
					'image/gif'//,
					//'application/x-shockwave-flash'
				);
						
				if (!in_array($this->request->files['image']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_file_type');
				}
				
				$allowed = array(
					'.jpg',
					'.jpeg',
					'.gif',
					'.png'//,
					//'.flv'
				);
						
				if (!in_array(strtolower(strrchr($filename, '.')), $allowed)) {
					$json['error'] = $this->language->get('error_file_type');
				}

				if ($this->request->files['image']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = 'error_upload_' . $this->request->files['image']['error'];
				}			
			} else {
				$json['error'] = $this->language->get('error_file');
			}
		} else {
			$json['error'] = $this->language->get('error_directory');
		} 
		
		
		if (!isset($json['error'])) {	
			if (@move_uploaded_file($this->request->files['image']['tmp_name'], $directory . '/' . $filename)) {		
				$json['success'] = $this->language->get('text_uploaded');
			} else {
				$json['error'] = $this->language->get('error_uploaded');
			}
		}
		$this->response->setOutput(json_encode($json));
	}
        
        
} 
?>