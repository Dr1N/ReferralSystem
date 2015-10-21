<?php

class ChangeAreaBehavior extends CBehavior 
{
    /**
     * The site area name
     */
    private $_areaName;
    
    /**
     * Get the site area name
     */
    public function getAreaName()
    {
        return $this->_areaName;
    }
    
    /**
     * Run the particular site area
     */
    public function runSiteArea($areaName)
    {
        $this->_areaName = $areaName;
        
        /**
         * Handling the create a module event
         */                 
        $this->onModuleCreate = array($this, 'changeModulePaths');
        $this->onModuleCreate(new CEvent($this->owner));
        
        $this->owner->run();		
    }
    
    /**
     * The onModuleCreate event handler
     */
    public function onModuleCreate($event)
    {
        $this->raiseEvent('onModuleCreate', $event);		
    }
    
    /**
     * Change the file paths for the particular site area
     */
    protected function changeModulePaths($event)
    {
        /**
         * Adding the site area name (frontend or backend) to the views and controllers paths
         */
        $event->sender->controllerPath .= DIRECTORY_SEPARATOR . $this->_areaName;
        $event->sender->viewPath .= DIRECTORY_SEPARATOR . $this->_areaName;
    }	
}