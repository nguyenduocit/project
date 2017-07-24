<?php
	/**
	 * { debug }
     * @param  array  $data
     * @return 
	 */
    function pre($data, $exit = true)
    {
        echo"<pre>";
        print_r($data);

        if($exit)
        {
            die;
        }
    }


    /**
     * chuyenh dinh dang text 
     *
     * @param      string  $str    The string
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    
    function safe_title($str = '')
    {
        $str = html_entity_decode($str, ENT_QUOTES, "UTF-8");
        $filter_in = array('#(a|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#', '#(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#', '#(e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#', '#(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#', '#(i|ì|í|ị|ỉ)#', '#(I|ĩ|Ì|Í|Ị|Ỉ|Ĩ)#', '#(o|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#', '#(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#', '#(u|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#', '#(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#', '#(y|ỳ|ý|ỵ|ỷ|ỹ)#', '#(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)#', '#(d|đ)#', '#(D|Đ)#');
        $filter_out = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'y', 'Y', 'd', 'D');
        $text = preg_replace($filter_in, $filter_out, $str);
        $text = preg_replace('/[^a-zA-Z0-9]/', ' ', $text);
        $text = trim(preg_replace('/ /', '-', trim(strtolower($text))));
        $text = preg_replace('/--/', '-', $text);
        $text = preg_replace('/--/', '-', $text);
        return preg_replace('/--/', '-', $text);
    }


    /**
     * function cat chuoi 
     *
     * @param    string $text 
     * @return     <type>  ( description_of_the_return_value )
     */
    function the_excerpt($text ,$num)
    {
       
        if(strlen($text)> $num)
        {
            $cutstring = substr($text,0,$num);
            $word = substr($text,0,strrpos($cutstring,' '));
            return $word ;
        }
        else
        {
            return $text;
        }

    }

    /**
     * random string
     *
     * @param      integer  $length  The length
     *
     * @return     string   ( description_of_the_return_value )
     */

    function rand_string($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        $str = '';
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[rand(0,$size - 1)];
         }
        return $str;
    }



    
?>
