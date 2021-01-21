<?php

namespace angelokezimana\elephpant\middlewares;

use angelokezimana\elephpant\Application;
use angelokezimana\elephpant\exception\NotFoundException;

/**
 * Class GuestMiddleware
 * 
 * @author Kezimana Aimé Angelo <kezangelo@gmail.com>
 * @package angelokezimana\elephpant\middlewares
 */
class GuestMiddleware extends BaseMiddleware
{
    public array $actions = [];
    public ?string $url = null;

    public function __construct(array $actions = [], string $url = null)
    {
        if (!$url) {
            throw new NotFoundException();
        }

        $this->actions = $actions;
        $this->url = $url;
    }

    public function execute()
    {
        if (!Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                Application::$app->response->redirect($this->url);
            }
        }
    }
}
