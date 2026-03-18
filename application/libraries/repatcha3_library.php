<?php

/**
 * Recaptcha 3 class
 *
 * This class contains the methods that you need to create a reCAPTCHA 3 box
 * And validate the response
 *
 * @category        Libraries
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @license         MIT License
 * @link            https://github.com/mehdibo/Codeigniter-recaptcha
 */

class repatcha3_library{
    /**
     * Site key provided by Google
     *
     * @var string
     */
    private $_site_key;

    /**
     * Secret key provided by Google
     *
     * @var string
     */
    private $_secret_key;

    /**
     * URL provided by Google
     *
     * @var string
     */
    private $_url;
    
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
                'site_key'	=> $this->_ci->config->item('google_key'),
                'secret_key'	=> $this->_ci->config->item('google_secret'),
                'url'           => $this->_ci->config->item('google_url')
        );
        
        if(is_array($options)){
                // Merge options with the config
                $config = array_merge($config, $options);
        }
                
        // Set keys
        $this->set_keys($config['site_key'], $config['secret_key'], $config['url']);
        
        log_message('info', 'CLASE RECAPTCHA INICIALIZADA');
    }
    
    /**
     * Set site and secret keys
     *
     * @param string $site   The reCAPTCHA site key
     * @param string $secret The reCAPTCHA secret key
     * 
     * @return void
     */
    public function set_keys($site, $secret,$url)
    {
            $this->_site_key    = $site;
            $this->_secret_key  = $secret;
            $this->_url         = $url;
            log_message('info', 'CLASE RECAPTCHA: SE ESTABLECIERON CLAVES');
    }    
    public function send_recaptcha($token = NULL, $action = NULL)
    {
        // Check if one of the keys is empty
        if(empty($this->_site_key) || empty($this->_secret_key))
        {
                // If it's a development environment
                if(ENVIRONMENT === 'development'){
                        show_error('ESTABLEZCA TANTO LA CLAVE DEL SITIO COMO LA CLAVE SECRETA PARA LA BIBLIOTECA RECAPTCHA.', 500, 'BIBLIOTECA RECAPTCHA: FALTAN CLAVES');
                }
                else
                {
                        log_message('error', 'CLASE RECAPTCHA: NO SE ESTABLECEN CLAVES');
                }
                return array('success' => FALSE);
        }

        log_message('info', 'CLASE RECAPTCHA: VALIDANDO LA RESPUESTA');

        $postfields = array('secret'=>$this->_secret_key,'response'=>$token);    

        // Start the request
        $curl = curl_init();
        
        // Set cURL options
        
        // Set the URL
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        
        // Return the response
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        // Send POST data
        curl_setopt($curl, CURLOPT_POST, true);
        
        // Set POST data
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postfields));
        
        // Force CURL to verify the host
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        
        // Stop if an error occurs
        curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
            
        // Force CURL to verify the certificate
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        
        // Initiate the request and return the response
        $response = curl_exec($curl);
        $status = json_decode($response, true); 
//        print_r($status);
        // Check if there were any errors
        if($response === FALSE){
            // Log the error
            log_message('error', "CURL FALLÓ, ERROR:". curl_error($curl));

            // Prepare data to return
                $return = array('error_message' => curl_error($curl));
                return json_encode($return);
        }else{
            // Parse the JSON response and prepare to return it
            if ($action!=$status['action']){ $return_err_1 = array('error_message' => 'FORMULARIO NO VALIDO, SE DETECTA QUE ERES UN ROBOT'); return json_encode($return_err_1, TRUE); }
            if ($status['success']==1 AND $status['score']>=0.5){ 
                // Close the cURL session
                curl_close($curl);
                return 1;
            } else { 
                $return_err_2 = array('error_message' => 'VALORACIÓN FUERA DE RANGO, SE DETECTA QUE ERES UN ROBOT');  return json_encode($return_err_2);                 
            }
        }
            
        // Close the cURL session
        curl_close($curl);
        
        return 1;
    }
}