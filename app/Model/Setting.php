<?php
    class Setting extends AppModel {

        var $name = 'Setting';
        var $key = 'AppSettings';

        //retrieve configuration data from the DB
        function getcfg(){
                $key=$this->key;
                $cfgs = $this->find('first',array('fields'=>array('id','key','value')));
                if (count($cfgs)) {
                    $this->checksum=$cfgs['Setting']['value'];
                    $cfgVal = unserialize($cfgs['Setting']['value']);
                }
                Configure::write($key,$cfgVal);
        }

        //write configuration data back to the DB
        function writecfg(){
            $key = $this->key;

            $rev = Configure::read($key);

            $value=serialize($rev);

            //if the configs haven't changed, no need to save them
            if ($value==$this->checksum) return;

            //otherwise the configs have changed, so

            $this->data = array('key'=>$key,'value'=>$value);

            if ($setting = $this->findByKey($key)) {
                $this->data['id'] = $setting['Setting']['id'];
            }

            $this->save($this->data);
        }
    }
?>