<?php

/* 
 * Sistema Web Responsivo Club Del Pintor Axalta Guatemala	* 
 * @author	Strategic Solutions S.A. de C.V                 * 
 * @programmer  Luis Felipe Rangel                              * 
 * @CreateDate 7 nov. 2022 12:04:13                             * 
 */

class infobip_library{
    
    /**
     * Site key provided by Infobip
     *
     * @var string
    */
    
    private $_site_key;
    /**
     * URL sms provided by Infobip
     *
     * @var string
    */
    
    private $_url_sms;
    /**
     * URL whatsapp provided by Infobip
     *
     * @var string
    */
    
    private $_url_whatsapp;
    /**
     * Phone whatsapp provided by Infobip
     *
     * @var string
    */
    
    private $_phone_whatsapp;    
    /**
     * CI instance
     *
     * @var object
    */    
    private $_ci;
    
    public function __construct($options = NULL) {
        // Get CodeIgniter instance
        $this->_ci =& get_instance();

        // Load the config file
        $this->_ci->config->load('config', FALSE, TRUE);
        
        // Get configs from the config file
        $config = array(
            'site_key'      => $this->_ci->config->item('infobip_key'),
            'url_sms'       => $this->_ci->config->item('infobip_url_sms'),
            'url_whatsapp'  => $this->_ci->config->item('infobip_url_whatsapp'),
            'phone_whatsapp'       => $this->_ci->config->item('infobip_phone_whatsapp')
        );
        
        if(is_array($options)){
                // Merge options with the config
                $config = array_merge($config, $options);
        }
                
        // Set keys
        $this->infobip_library_set_keys($config['site_key'],$config['url_sms'],$config['url_whatsapp'],$config['phone_whatsapp']);
        
        log_message('info', 'CLASE INFOBIP INICIALIZADA');
    }
    
    /**
     * Set site and secret keys -> infobip_library_set_keys
     *
     * @param string $site_key   The INFOBIP APP key
     * @param string $url_sms The INFOBIP url for sms
     * @param string $url_whatsapp   The INFOBIP url for whatsapp
     * @param string $phone_whatsapp The INFOBIP phone for whatsapp
     * 
     * @return void
    */
    public function infobip_library_set_keys($site_key, $url_sms, $url_whatsapp, $phone_whatsapp){
        $this->_site_key        = $site_key;
        $this->_url_sms         = $url_sms;
        $this->_url_whatsapp    = $url_whatsapp;
        $this->_phone_whatsapp  = $phone_whatsapp;
        log_message('info', 'CLASE INFOBIP: SE ESTABLECIERON CLAVES');
    }
    /**
     * Send WhatsApp -> infobip_library_send_whatsapp
     *
     * @param int $template_id el tipo de template que tendra el envio del whatsapp
     * @param string $phone_to telefono al que se le enviara el whatsapp
     * @param string $temeplate_name nonbre del template crerado en la plataforma infobip
     * @param string $body_texto variables array en tipo string del template
     * @param string $lang lenguaje del template
     * @param string $body_url url que incluira el whatsapp
     * 
     * @return array
    */    
    public function infobip_library_send_whatsapp($template_id, $phone_to, $temeplate_name, $body_texto, $lang, $body_url){
        // Check if one of the keys is empty
        if(empty($this->_site_key) || empty($this->_url_whatsapp) || empty($this->_phone_whatsapp)){
            // If it's a development environment
            if(ENVIRONMENT === 'development'){
                show_error('ESTABLEZCA _site_key , _url_whatsapp y _phone_whatsapp DEL SITIO PARA LA BIBLIOTECA INFOBIP.', 500, 'BIBLIOTECA INFOBIP: FALTAN CLAVES');
            } else {
                log_message('error', 'CLASE INFOBIP: NO SE ESTABLECEN CLAVES');
            }
            return array('success' => FALSE);
        }
        $data_json      = $this->infobip_library_send_whatsapp_body($template_id, $phone_to, $temeplate_name, $body_texto, $lang, $body_url);

        log_message('info', 'CLASE INFOBIP: VALIDANDO LA RESPUESTA');
        $Authorization  = "Authorization: ".$this->_site_key;
        $html_headers   = [$Authorization,'Content-Type: application/json','Accept: application/json'];
        $ch             = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url_whatsapp);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $html_headers);    
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response  = curl_exec($ch);
        if($response === false){ echo 'Curl error: ' . curl_error($ch); } else { echo 'Operación completada sin errores res: '.$response; }
        echo "<br>curl_getinfo: ";
        print_r(curl_getinfo($ch));    
        echo "<br><br>Response: ";
        var_dump($response);
        curl_close($ch);   
        return $response;
    }    
    /**
     * Cretae body of whatsapp -> infobip_library_send_whatsapp_body
     *
     * @param int $id el tipo de template que tendra el envio del whatsapp
     * @param string $to telefono al que se le enviara el whatsapp
     * @param string $temeplate_name nonbre del template crerado en la plataforma infobip
     * @param string $texto variables array en tipo string del template
     * @param string $lang lenguaje del template
     * @param string $url url que incluira el whatsapp
     * @param string $from telefono del proveedor "programa" de infobip
     * 
     * @return array
    */
    public function infobip_library_send_whatsapp_body($id,$to,$temeplate_name,$texto,$lang,$url){
        switch ($id) {
            case 1: //Body template message 
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":["Placeholder Value 1","Placeholder Value 2"]}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
            case 2: //Text header template message
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":["'.$url.'"]},"header":{"type":"TEXT","placeholder":"'.$texto.'"}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
            case 3: //Document header template message
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":['.$texto.']},"header":{"type":"DOCUMENT","mediaUrl":"http://example.com/document","filename":"document.pdf"}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
            case 4: //Image header template message
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":['.$texto.']},"header":{"type":"IMAGE","mediaUrl":"http://example.com/image"}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
            case 5: //Video header template message
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":['.$texto.']},"header":{"type":"VIDEO","mediaUrl":"http://example.com/video"}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
            case 6: //Location header template message
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":['.$texto.']},"header":{"type":"LOCATION","latitude":45.79359,"longitude":15.94613}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
            case 7: //Quick reply button template message ***si funciona **** con ganadores_bim
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":['.$texto.']},"buttons":[{"type":"QUICK_REPLY","parameter":"Yes"},{"type":"QUICK_REPLY","parameter":"No"}]},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';  
                break;
            case 8: //Url button template message
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":['.$texto.']},"buttons":[{"type":"URL","parameter":"'.$url.'"}]},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
            case 9: //Template message with SMS failover
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":['.$texto.']}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp","smsFailover":{"from":"InfoSMS","text":"SMS message to be sent if WhatsApp template message could not be delivered."}}]}';
                break;
            case 10: //Bulk template messages
                $data_json      = '{"messages":[{"from":"'.$this->_phone_whatsapp.'","to":"'.$to.'","messageId":"a28dd97c-1ffb-4fcf-99f1-0b557ed381da","content":{"templateName":"'.$temeplate_name.'","templateData":{"body":{"placeholders":["Placeholder Value 1","Placeholder Value 2"]}},"language":"'.$lang.'"},"callbackData":"Callback data","notifyUrl":"https://www.example.com/whatsapp"}]}';
                break;
        }    
        return $data_json;
    }
    /**
     * Send SMS -> infobip_library_send_sms
     *
     * @param string $phone_to telefono al que se le enviara el sms
     * @param string $texto texto del sms
     * 
     * @return array
    */    
    public function infobip_library_send_sms($phone_to,$texto) {
        //$texto          = "¡Participa en la promoción Pinta Sobre Ruedas que Axalta Club del Pintor tiene para ti en marzo! $URL ".$fecha;
        $data_json      = '{ "bulkId":"BULK-ID-123-xyz","messages":[{"from":"Promociones AXALTA","destinations":[{"to":"'.$phone_to.'"}],"text":"'.$texto.'","flash":false,"callbackdata":"DLR callback data","validityPeriod":720}],"tracking":{"track":"URL"}}';
        $Authorization  = "'Authorization: ".$this->_site_key."'";
        $html_headers   = [$Authorization,'Content-Type: application/json','Accept: application/json'];           
        $ch             = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url_sms);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $html_headers);    
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response  = curl_exec($ch);
//        if($response === false)
//        {
//            echo 'Curl error: ' . curl_error($ch);
//        }
//        else
//        {
//            //var_dump($response);
//            echo 'Operación completada sin errores res: '.$response;
//        }    
//        echo "<br>curl_getinfo: ";
//        print_r(curl_getinfo($ch));    
//        echo "<br><br>Response: ";
//        var_dump($response);
        curl_close($ch);
    }
}