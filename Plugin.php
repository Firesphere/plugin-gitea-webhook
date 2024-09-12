<?php

namespace Kanboard\Plugin\GiteaWebhook;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Security\Role;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_COMMIT_REF);
        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_COMMIT_CLOSE);
        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_PR_CREATE);
        $this->actionManager->getAction('\Kanboard\Action\CommentCreation')->addEvent(WebhookHandler::EVENT_PR_CLOSE);
        $this->actionManager->getAction('\Kanboard\Action\TaskClose')->addEvent(WebhookHandler::EVENT_COMMIT_CLOSE);
        $this->actionManager->getAction('\Kanboard\Action\TaskClose')->addEvent(WebhookHandler::EVENT_PR_CLOSE);
        $this->actionManager->getAction('\Kanboard\Action\TaskMoveColumnAssigned')->addEvent(WebhookHandler::EVENT_COMMIT_CLOSE);
        $this->actionManager->getAction('\Kanboard\Action\TaskMoveColumnAssigned')->addEvent(WebhookHandler::EVENT_PR_CLOSE);

        $this->template->hook->attach('template:project:integrations', 'GiteaWebhook:project/integrations');

        $this->route->addRoute('/webhook/gitea/:project_id/:token', 'WebhookController', 'handler', 'GiteaWebhook');

        $this->applicationAccessMap->add('WebhookController', 'handler', Role::APP_PUBLIC);
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__ . '/Locale');
        $this->eventManager->register(WebhookHandler::EVENT_COMMIT_REF, t('Gitea commit reference received'));
        $this->eventManager->register(WebhookHandler::EVENT_COMMIT_CLOSE, t('Gitea commit close received'));
        $this->eventManager->register(WebhookHandler::EVENT_PR_CREATE, t('Gitea PR create received'));
        $this->eventManager->register(WebhookHandler::EVENT_PR_CLOSE, t('Gitea PR close received'));
    }

    public function getPluginName()
    {
        return 'Gitea Webhook';
    }

    public function getPluginDescription()
    {
        return t('Bind Gitea webhook events to Kanboard automatic actions');
    }

    public function getPluginAuthor()
    {
        return 'Chris Metz; Simon `Firesphere` Erkelens';
    }

    public function getPluginVersion()
    {
        return '2.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/firesphere/plugin-gitea-webhook';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.37';
    }
}
