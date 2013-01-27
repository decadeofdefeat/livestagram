<?php
/**
 * Menu model
 * @author Anton Zekeriev Rodin
 */
class Menu_model extends CI_Model {
    
    public function  __construct() {
        parent::__construct();
        $this->mainmenu = array(
            'Moderate Images' => 'admin/main'
            
        );

        $this->submenu = array(
            'Users' => 'admin/user'
        );
    }

    /**
     * Get main menu
     * @return <Array> return an array where key is anchor text and value is the url 
     */
    public function get_mainmenu() {
        return $this->mainmenu;
    }

    /**
     * Get submenu
     * @return <Array> return an array where key is anchor text and value is the url
     */
    public function get_submenu() {
        return $this->submenu;
    }

    /**
     * Set new sub menu
     * @param <Array> $submenu Set an array where key is anchor text and value is the url
     */
    public function set_submenu($submenu) {
        $this->submenu = $submenu;
    }

    /**
     * Set new main menu
     * @param <Array> $mainmenu Set an array where key is anchor text and value is the url
     */
    public function set_mainmenu($mainmenu) {
        $this->mainmenu = $mainmenu;
    }

    /**
     * Add option to the submenu
     * @param <String> $anchor Anchor text for link for the submenu
     * @param <String> $url URL for link for the submenu
     */
    public function add_to_submenu($anchor, $url) {
        $this->submenu[$anchor][$url];
    }

    /**
     * Add option to the submenu
     * @param <String> $anchor Anchor text for link for the submenu
     * @param <String> $url URL for link for the submenu
     */
    public function add_to_mainmenu($anchor, $url) {
        $this->mainmenu[$anchor][$url];
    }

    private $mainmenu;
    private $submenu;

}