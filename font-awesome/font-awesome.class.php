<?php
/*
 * SMK Font Awesome
 *
 * Get font awesome class names in an array or json format.
 *
 * -------------------------------------------------------------------------------------
 * @Author: Smartik
 * @Author URI: http://smartik.ws/
 * @Copyright: (c) 2014 Smartik. All rights reserved
 * -------------------------------------------------------------------------------------
 *
 * @Date:   2014-05-17 12:29:17
 * @Last Modified by:   Smartik
 * @Last Modified time: 2014-05-19 14:38:44
 *
 */
if( ! class_exists('Smk_FontAwesome') ){
    class Smk_FontAwesome{

        /**
         * Font Awesome
         *
         * @param string $path font awesome css file path
         * @param string $class_prefix change this if the class names does not start with `fa-`
         * @return array
         */
        public static function getArray($path, $class_prefix = 'fa-'){

            if( ! file_exists($path) )
                return false;//if path is incorect or file does not exist, stop.

            $css = file_get_contents($path);
            $pattern = '/\.('. $class_prefix .'(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';

            preg_match_all($pattern, $css, $matches, PREG_SET_ORDER);

            $icons = array();
            foreach ($matches as $match) {
                $icons[$match[1]] = substr($match[1], 3);
            }
            return $icons;

        }

        ################################################################################

        /**
         * Sort array by key name
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @return array
         */
        public function sortByName($array){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array

            ksort( $array );
            return $array;

        }

        ################################################################################

        /**
         * Get only HTML class key(class) => value(class)
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @return array
         */
        public function onlyClass($array){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array

            $temp = array();
            foreach ($array as $class => $unicode) {
                $temp[$class] = $class;
            }
            return $temp;

        }

        ################################################################################

        /**
         * Get only the unicode key
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @return array
         */
        public function onlyUnicode($array){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array

            $temp = array();
            foreach ($array as $class => $unicode) {
                $temp[$unicode] = $unicode;
            }
            return $temp;

        }

        ################################################################################

        /**
         * Readable class name. Ex: fa-video-camera => Video Camera
         *
         * @param array $array font awesome array. Create it using `getArray` method
         * @param string $class_prefix change this if the class names does not start with `fa-`
         * @return array
         */
        public function readableName($array, $class_prefix = 'fa-'){

            if( ! is_array($array) )
                return false;//Do not proceed if is not array

            $temp = array();
            foreach ($array as $class => $unicode) {
                $temp[$class] = ucfirst( str_ireplace(array($class_prefix, '-'), array('', ' '), $class) );
            }
            return $temp;

        }

        /**
         * Font Awesome
         *
         * @param string $path font awesome css file path
         * @param string $class_prefix change this if the class names does not start with `fa-`
         * @return array
         */
        public static function getFullArray($path, $class_prefix = 'fa-'){

            if( ! file_exists($path) )
                return false;//if path is incorect or file does not exist, stop.

            $css = file_get_contents($path);
            $pattern = '/\.('. $class_prefix .'(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';

            preg_match_all($pattern, $css, $matches, PREG_SET_ORDER);

            $icons = array();
            $count = 0;

            foreach ($matches as $match) {
                //var_export( $matches );

                $icons[$count]['id'] = substr($match[1], 3);
                $icons[$count]['name'] = ucfirst( str_ireplace( array($class_prefix, '-'), array('', ' '), substr($match[1], 3) ) );
                $icons[$count]['unicode'] = $match[2];
                $icons[$count]['created'] = 1;

                $count++;

            }
            return array( 'icons' => $icons );
        }

    }//class
}//class_exists

//Init font awesome class
//$fa = new Smk_FontAwesome;

//Get array
//$icons = $fa->getArray(dirname(__FILE__) . '/font-awesome.css');

//var_export( json_encode($icons) );
