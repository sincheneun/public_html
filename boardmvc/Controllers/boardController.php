<?php
require_once('conf/url_conf.php');
require_once(URL::Model);
require_once(URL::util);
require_once(URL::mainModule);
require_once(URL::processModule);
require_once(URL::authModule);

class boardController{
    use mainModule, processModule, authModule;

    //사용자 요청에 따른, 해당 모듈을 실행하고, view 반환
    public function run(){
        $this->route();
    }
    public function route(){
        $path = explode("/" , ltrim($_SERVER['REQUEST_URI'], "/"));
        if($path[2] == 'login'){
            $this->login(); 
        }else if($path[2] == 'logout'){
            $this->logout(); 
        }

        else if($path[2] == 'write_process'){
            $this->write_process(); 
        }else if($path[2] == 'modify_process'){
            $this->modify_process(); 
        }else if(substr( $path[2], 0, 15 ) == 'delete_process?'){
            $this->delete_process(); 
        }else if($path[2] == 'comment_process'){
            $this->comment_process(); 
        }
        
        else if(substr( $path[2], 0, 5 ) == 'list?' || $path[2] == 'list'){
            $this->list(); 
        }else if(substr( $path[2], 0, 5 ) == 'view?') {
            $this->view(); 
        }else if(substr( $path[2], 0, 6 ) == 'write?') {
            $this->write(); 
        }else if(substr( $path[2], 0, 7 ) == 'modify?') {
            $this->modify(); 
        }
        else 
            throw new Exception("<h1>Not found</h1>");
        
    }

}

?>