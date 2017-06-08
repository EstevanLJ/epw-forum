<?php

/**
* Format the date to a readable sentence
*
* @return string
*/
function parseDate($date) {
    
    /*
    Retornar coisas como:
	agora mesmo,
	há 15 minutos
    há 4 horas,
	ontem,
	há 3 dias,
	semana passada,
	há 3 mêses,
	ano passado
    */
    
    return 'em '.$date;
}

function get_adorable($email, $pixels = 200) {

	return 'https://api.adorable.io/avatars/'.$pixels.'/'.$email.'.png';

}


/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 200, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}