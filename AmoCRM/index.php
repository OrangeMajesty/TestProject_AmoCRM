<?php

define('subdomain', 'dmitrikulakov000');

class AmoCRM {
    
    /***
     * Авторизовываемся и получаем cookie.
     */
    function __construct() {
        
        /// Прользовательские данные.
        $auth = array(
                'USER_LOGIN' => 'dmitri.kulakov.000@gmail.com',
                'USER_HASH' => 'c85653c1876c6c52622a3257de482d0fcd2a711c'
            );
            
        /// Проверка на успешную авторизацию.
        try {
            if(!$this->auth($auth))
                throw new Exception('Failed authorization.');
        } catch(Exception $E) {
            die('Fatal error: Failed authorization.');
        }
        
    }
    
    /** 
     * Авторизация.
     * 
     * Возвращает cookie со временем жизни в 15 мин.
     * Каждыйй запрос сопровождается полученным cookie.
     * 
     */
    public function auth($auth) {
        $url = 'https://'.subdomain.'.amocrm.ru/private/api/auth.php?type=json';
        
        $curl = $this->cURL_init($url);
        
        /// Устанавливаем кастомные настройки
        curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($auth));
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
        
        $resp = $this->cURL_exec($curl);
      
        /// Проверяем флаг авторизации.
        if(!empty($resp['response']['auth']))
            return true;
        
        return false;
        
    }
    
    /***
     * Получение сделок с фильтром.
     */
    public function getLeadsFilterTasks() {
        $url = 'https://'.subdomain.'.amocrm.ru/api/v2/leads?filter[tasks]=1';

        $curl = $this->cURL_init($url);
        
        $result = $this->cURL_exec($curl);

        return $result['_embedded']['items'];
    }
    
    /***
     * Добавление задач.
     * Принимает массив данных сделки.
     */
    public function insertTask($tasks) {
        $url = 'https://'.subdomain.'.amocrm.ru/api/v2/tasks';
        
        /// $tasks['add'] = array();
        
        $curl = $this->cURL_init($url);
        
        /// Настраиваем запрос.
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($tasks));
        curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
        
        $result = $this->cURL_exec($curl);
        
        return $result;
    }
    
    
    /**
     * cURL Инициализация.
     * 
     * Возвращает объект cURL.
     */
    public function cURL_init($url) {
        
        $curl = curl_init();
        
        /// Настраиваем запрос.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
        curl_setopt($curl, CURLOPT_URL,$url);
        curl_setopt($curl, CURLOPT_HEADER,false);
        
        /// PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
        
        /// PHP>5.3.6 dirname(__FILE__) -> __DIR__
        curl_setopt($curl, CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
        
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
        
        return $curl;
        
    }
    
    /**
     * Выполнение запроса.
     * 
     * Возвращает ответ от сервера в json.
     */
    public function cURL_exec($curl) {
        
        /// Инициируем запрос к API и сохраняем ответ в переменную.
        $out = curl_exec($curl);
        
        /// Получим HTTP-код ответа сервера.
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
        /// Завершаем сеанс.
        curl_close($curl);
        
        /// Читаем код ответа.
        try {
            if($code != 200 && $code != 204)
                throw new Exception('Fatal Error. Code:'.$code);
        } catch(Exception $E) {
            die('Fatal Error. '.$E->getMessage().PHP_EOL);            
        }
        
        /// Переводим ответ в json.
        $resp = json_decode($out, true);
        
        return $resp;
    }
    

}

/// Запуск 
$amo = new AmoCRM();

/// Получаем массив сделок без задач.
$tasks = $amo->getLeadsFilterTasks();

/// Проверка на пустой массив.
if(!empty($tasks)) {
    $insert_task['add'] = array();
    
    /// Ставим задачу на завтра.
    $date = date('Y-m-d');
    $date = date('Y-m-d', strtotime($date . ' + 1 days'));
    $next_day = strtotime($date);
    
    foreach($tasks as $task) {
        $tmpTask = array(
            'element_id' => $task['id'],
            'element_type' => 2,    /// Привязываем к сделке.
            'task_type' => 3,       /// Тип письмо
            'text' => 'Сделка без задачи',
            'responsible_user_id' => $task['responsible_user_id'],
            'complete_till_at' => $next_day
        );
        array_push($insert_task['add'], $tmpTask);
    }
    
    /// Проверка успешного добавления задач.
    if($amo->insertTask($insert_task))
        echo 'Success';
    else
        echo 'Error';
        
} else {
    echo 'Leads without tasks not found.';
}