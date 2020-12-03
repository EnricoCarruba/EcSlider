<?php
namespace EcSlider\Subscriber;

use Enlight\Event\SubscriberInterface;
use Shopware\Components\Plugin\ConfigReader;
use EcSlider\Components\EcSlider;

class RouteSubscriber implements SubscriberInterface
{
   private $pluginDirectory;
   private $ecSlider;
   private $config;

   public static function getSubscribedEvents()
   {
       return [
           'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatch'
       ];
   }

   public function __construct($pluginName, $pluginDirectory, EcSlider $ecSlider, ConfigReader $configReader)
   {
       $this->pluginDirectory = $pluginDirectory;
       $this->ecSlider = $ecSlider;

       $this->config = $configReader->getByPluginName($pluginName);
   }

   public function onPostDispatch(\Enlight_Controller_ActionEventArgs $args)
   {
       /** @var \Enlight_Controller_Action $controller */
       $controller = $args->get('subject');
       $view = $controller->View();

       $view->addTemplateDir($this->pluginDirectory . '/Resources/views');

       $view->assign('ecSliderFontSize', $this->config['ecSliderFontSize']);
       $view->assign('ecSliderItalic', $this->config['ecSliderItalic']);
       $view->assign('ecSliderContent', $this->config['ecSliderContent']);

       if (!$this->config['ecSliderContent']) {
           $view->assign('ecSliderContent', $this->ecSlider->getSlide());
       }
   }
}