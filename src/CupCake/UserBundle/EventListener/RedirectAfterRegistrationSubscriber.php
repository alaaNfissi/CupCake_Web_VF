<?php
/**
 * Created by PhpStorm.
 * User: Alaa
 * Date: 06/04/2018
 * Time: 15:32
 */

namespace CupCake\UserBundle\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class RedirectAfterRegistrationSubscriber implements EventSubscriberInterface
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router=$router;
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $url=$this->router->generate('user_homepage');
        $response=new RedirectResponse($url);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }

}