<?php

  /*
  *   Class : Meta.php
  *   Autor : Hamza Emre - hamzaemre0@gmail.com
  *   Time  : 16.01.2017 23:00
  */

  class Meta
  {

    /*
     *
     * @params
     * Meta tags are read from this file.
     * Default value: 'metatags.json'
     * */
    private $meta_file;

    /*
     *
     * @params
     * Current Page
     * */
    private $current_page;

    /*
     *
     * @params
     * Getting json data from file.
     * */
    private $json_read;

    /*
     *
     * @params
     * Json data-> decode!
     * */
    private $json_decode;

    /*
     *
     * @params
     * Facebook meta prefix..
     * Default value: 'og:'
     * */
    private $facebook;

    /*
     *
     * @params
     * Twitter meta prefix..
     * Default value: 'twitter:'
     * */
    private $twitter;

    /*
     *
     * @params
     * Social list
     * Ex: 'facebook', 'twitter'
     * */
    private $social_list;

    /*
     *
     * @params
     * Main selection in data.
     * Default value: 'pages'
     * */
    private $main_selection;

    /*
     *
     * @params
     * Developer, offering...
     * Default value: 'Hamza Emre - hamzaemre0@gmail.com'
     * */
    private $default_author;


    /**
     * @return Meta
     */
    function __construct()
    {
      $this->meta_file = 'metatags.json';
      // Social - prefix's default values
      $this->facebook = 'og:';
      $this->twitter  = 'twitter:';

      $this->social_list = array('facebook', 'twitter');

      $this->main_selection = 'pages';
      $this->default_author = 'Hamza Emre - hamzaemre0@gmail.com';

    }


    /*
     *
     * @Param Start
     *
     * */
    public function Start()
    {
      if (file_exists($this->meta_file)) {
        $this->json_read = file_get_contents($this->meta_file);
        $this->json_decode = json_decode($this->json_read, true);

        $new_path = $_SERVER['REQUEST_URI'];
        $this->current_page = str_replace($this->json_decode['main_path'], "", $new_path);
        if (empty($this->current_page)) {
          $this->current_page = 'index.php';
        }

        $this->getTitle();
        $this->getMetaTags();
        $this->getSocialMetaTags($this->social_list);

      }else {
        die($this->meta_file . ' file not found! Please create the file first. Then add the required properties.');
        exit();
      }
    }

    /*
     *
     * @Param setTitle
     * Used to assign a new title.
     *
     * */
    public function setTitle($title)
    {
      if (!isset($this->json_decode[$this->main_selection][$this->current_page])) {
        echo '<title>'. $title .'</title>';
      }
    }

    /*
     *
     * @Param getTitle
     * Gets the title data from the file.
     *
     * */
    private function getTitle()
    {
      if (isset($this->json_decode[$this->main_selection][$this->current_page]['title'])) {
        echo '<title>'. $this->json_decode[$this->main_selection][$this->current_page]['title'] .'</title>';
      }
    }

    /*
     *
     * @Param setMetaTags
     * Used to assign a new meta tags.
     *
     * */
    public function setMetaTags($metatags)
    {
      if (!isset($this->json_decode[$this->main_selection][$this->current_page])) {
        foreach ($metatags as $name => $content) {
          echo '<meta name="'. $name .'" content="'. $content .'" />';
        }
      }
    }

    /*
     *
     * @Param getMetaTags
     * Gets the meta tags data from the file.
     *
     * */
    private function getMetaTags()
    {
      if (isset($this->json_decode[$this->main_selection][$this->current_page]['meta'])) {
        if (count($this->json_decode[$this->main_selection][$this->current_page]['meta']) > 0) {
          if (!isset($this->json_decode[$this->main_selection][$this->current_page]['meta']['author'])) {
            echo '<meta name="author" content="'. $this->default_author .'" />';
          }
          foreach ($this->json_decode[$this->main_selection][$this->current_page]['meta'] as $name => $content) {
            echo '<meta name="'. $name .'" content="'. $content .'" />';
          }
        }
      }
    }

    /*
     *
     * @Param getSocialMetaTags
     * Gets the social meta tags data from the file.
     *
     * */
    private function getSocialMetaTags($lists)
    {
      foreach ($lists as $s_id => $s_name) {
        if (isset($this->json_decode[$this->main_selection][$this->current_page][$s_name . '_meta'])) {
          if (count($this->json_decode[$this->main_selection][$this->current_page][$s_name . '_meta']) > 0) {
            foreach ($this->json_decode[$this->main_selection][$this->current_page][$s_name . '_meta'] as $name => $content) {
              echo '<meta name="'. $this->$s_name . $name .'" content="'. $content .'" />';
            }
          }
        }
      }
    }

    /*
     *
     * @Param _log
     * Console.log :)
     *
     * */
    private function _log($msg)
    {
      echo "<script>console.log('". $msg ."');</script>";
    }
  }

?>
